// libs
import QRCode from "qrcode";
import html2canvas from "html2canvas";
import axios from "axios";
import qr from "qr-image";
// variables
let randomToken = 0;
let qrcode_allready_generated = false;
let jsonUri = "";
let nftImageUri = "";
// consts
const user_id = $(".js-user_id").val();

// utils begin
const removeNullsFromObject = (obj) => {
  for (var prop in obj) {
    if (obj[prop] === null) {
      delete obj[prop];
    } else if (typeof obj[prop] === "object") {
      removeNullsFromObject(obj[prop]);
    }
  }
  return obj;
};
const base64ToBlob = (base64Data, mimeType) => {
  const byteCharacters = atob(base64Data);
  const byteArrays = [];
  for (let offset = 0; offset < byteCharacters.length; offset += 512) {
    const slice = byteCharacters.slice(offset, offset + 512);
    const byteNumbers = new Array(slice.length);
    for (let i = 0; i < slice.length; i++) {
      byteNumbers[i] = slice.charCodeAt(i);
    }
    const byteArray = new Uint8Array(byteNumbers);
    byteArrays.push(byteArray);
  }
  return new Blob(byteArrays, { type: mimeType });
};

const getUserJson = async () => {
  try {
    const response = await axios.get(route("api.getUserJson"), {
      params: {
        id: user_id,
      },
    });
    return removeNullsFromObject(response.data);
  } catch (error) {
    // Handle error if necessary
    console.error(error);
  }
};
function convertObjectToTraits(obj) {
  const traits = [];

  for (const key in obj) {
    if (obj.hasOwnProperty(key)) {
      traits.push({
        trait_type: key,
        value: obj[key],
      });
    }
  }

  return traits;
}
// utils end

//functions begin
const generateQRCode = (e) => {
  if (qrcode_allready_generated) {
    return;
  }
  randomToken = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;
  $(".js-span-token").text(randomToken);
  QRCode.toDataURL(
    route("public_invidual_dashboard", { id: user_id }),
    {
      width: 210,
      height: 210,
      errorCorrectionLevel: "H",
      margin: 0,
    },
    function (err, url) {
      if (err) {
        console.error(err);
        return;
      }
      const img = $("<img>").attr("src", url);
      $(".js-nft-qrcode").append(img);
      qrcode_allready_generated = true;
    }
  );
};
$(".js-btn-signchain").on("click", function (e) {
  generateQRCode();
});

const createAndUploadNftImage = () => {
  const divElement = $(".js-nft-box");
  html2canvas(divElement[0]).then(function (canvas) {
    const imageBase64 = canvas.toDataURL("image/png");
    const imageData = imageBase64.split(",").pop();
    const blob = base64ToBlob(imageData, "image/png");
    const file = new File([blob], "image.png", { type: "image/png" });
    const formData = new FormData();

    formData.append("image", file);
    formData.append("filename", randomToken);
    formData.append("id", user_id);

    //axios begin
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;
    axios
      .post(route("api.upload"), formData)
      .then(function (response) {
        const imageUrl = response.data;
        nftImageUri = imageUrl;
        console.log("Image uploaded successfully. URL:", imageUrl);
        createAndUploadJson();
      })
      .catch(function (error) {
        console.error("Image upload failed:", error);
      });
  });
};

const createAndUploadJson = () => {
  getUserJson().then((userJson) => {
    let attributes = convertObjectToTraits(userJson);
    let nftJson = {};

    attributes.push({
      trait_type: "token",
      value: randomToken,
    });

    nftJson.name = userJson.first_name + userJson.lastname;
    nftJson.description = "Bnic invudial profile";
    nftJson.image = nftImageUri;
    nftJson.attributes = attributes;

    console.log(nftJson);
    axios
      .post(route("nft.create_json_nft"), {
        id: user_id,
        json: nftJson,
        type: "profile_invidual",
        token: randomToken,
      })
      .then((result) => {
        jsonUri = result.data;
        storeNft(jsonUri);
      });
  });
};

const storeNft = async (jsonUri) => {
  try {
    const response = await axios.post(route("nft.store"), {
      url: jsonUri,
      token: randomToken,
      type: "profile_invidual",
      id: user_id,
    });

    const nft_id = response.data.id;
    await publishContract().then((hash) => {
      updateProfile(jsonUri).then((user) => {
        console.log(user);
        window.location.reload();
      });
    });
  } catch (error) {
    console.error("Error in storeNft function:", error);
  }
};

// DOING alan bayad ghable update profile bebarim roo blockchain json ro
const updateProfile = (nft_id) => {
  return axios
    .post(route("api.update"), {
      id: user_id,
      profile_nft_id: nft_id,
    })
    .then((result) => {
      console.log(result.data);
    });
};

$(".js-btn-signchain-submit").on("click", function () {
  createAndUploadNftImage();
});

const publishContract = async () => {
  const BnicNFTABI = [
    {
      anonymous: false,
      inputs: [
        {
          indexed: true,
          internalType: "address",
          name: "owner",
          type: "address",
        },
        {
          indexed: true,
          internalType: "address",
          name: "approved",
          type: "address",
        },
        {
          indexed: true,
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "Approval",
      type: "event",
    },
    {
      anonymous: false,
      inputs: [
        {
          indexed: true,
          internalType: "address",
          name: "owner",
          type: "address",
        },
        {
          indexed: true,
          internalType: "address",
          name: "operator",
          type: "address",
        },
        {
          indexed: false,
          internalType: "bool",
          name: "approved",
          type: "bool",
        },
      ],
      name: "ApprovalForAll",
      type: "event",
    },
    {
      anonymous: false,
      inputs: [
        {
          indexed: true,
          internalType: "address",
          name: "previousOwner",
          type: "address",
        },
        {
          indexed: true,
          internalType: "address",
          name: "newOwner",
          type: "address",
        },
      ],
      name: "OwnershipTransferred",
      type: "event",
    },
    {
      anonymous: false,
      inputs: [
        {
          indexed: true,
          internalType: "address",
          name: "from",
          type: "address",
        },
        {
          indexed: true,
          internalType: "address",
          name: "to",
          type: "address",
        },
        {
          indexed: true,
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "Transfer",
      type: "event",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "to",
          type: "address",
        },
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "approve",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
        {
          internalType: "string",
          name: "imageURI",
          type: "string",
        },
        {
          internalType: "string",
          name: "externalURI",
          type: "string",
        },
        {
          internalType: "string",
          name: "attributes",
          type: "string",
        },
      ],
      name: "editNFT",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "to",
          type: "address",
        },
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
        {
          internalType: "string",
          name: "imageURI",
          type: "string",
        },
        {
          internalType: "string",
          name: "externalURI",
          type: "string",
        },
        {
          internalType: "string",
          name: "attributes",
          type: "string",
        },
      ],
      name: "mintNFTWithId",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [],
      name: "renounceOwnership",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "from",
          type: "address",
        },
        {
          internalType: "address",
          name: "to",
          type: "address",
        },
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "safeTransferFrom",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "from",
          type: "address",
        },
        {
          internalType: "address",
          name: "to",
          type: "address",
        },
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
        {
          internalType: "bytes",
          name: "data",
          type: "bytes",
        },
      ],
      name: "safeTransferFrom",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "operator",
          type: "address",
        },
        {
          internalType: "bool",
          name: "approved",
          type: "bool",
        },
      ],
      name: "setApprovalForAll",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "from",
          type: "address",
        },
        {
          internalType: "address",
          name: "to",
          type: "address",
        },
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "transferFrom",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "newOwner",
          type: "address",
        },
      ],
      name: "transferOwnership",
      outputs: [],
      stateMutability: "nonpayable",
      type: "function",
    },
    {
      inputs: [],
      stateMutability: "nonpayable",
      type: "constructor",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "owner",
          type: "address",
        },
      ],
      name: "balanceOf",
      outputs: [
        {
          internalType: "uint256",
          name: "",
          type: "uint256",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "getApproved",
      outputs: [
        {
          internalType: "address",
          name: "",
          type: "address",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "getNFTData",
      outputs: [
        {
          components: [
            {
              internalType: "string",
              name: "imageURI",
              type: "string",
            },
            {
              internalType: "string",
              name: "externalURI",
              type: "string",
            },
            {
              internalType: "string",
              name: "attributes",
              type: "string",
            },
          ],
          internalType: "struct BnicNFT.NFTData[]",
          name: "",
          type: "tuple[]",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "address",
          name: "owner",
          type: "address",
        },
        {
          internalType: "address",
          name: "operator",
          type: "address",
        },
      ],
      name: "isApprovedForAll",
      outputs: [
        {
          internalType: "bool",
          name: "",
          type: "bool",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [],
      name: "name",
      outputs: [
        {
          internalType: "string",
          name: "",
          type: "string",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "uint256",
          name: "",
          type: "uint256",
        },
        {
          internalType: "uint256",
          name: "",
          type: "uint256",
        },
      ],
      name: "nftHistory",
      outputs: [
        {
          internalType: "string",
          name: "imageURI",
          type: "string",
        },
        {
          internalType: "string",
          name: "externalURI",
          type: "string",
        },
        {
          internalType: "string",
          name: "attributes",
          type: "string",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [],
      name: "owner",
      outputs: [
        {
          internalType: "address",
          name: "",
          type: "address",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "ownerOf",
      outputs: [
        {
          internalType: "address",
          name: "",
          type: "address",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "bytes4",
          name: "interfaceId",
          type: "bytes4",
        },
      ],
      name: "supportsInterface",
      outputs: [
        {
          internalType: "bool",
          name: "",
          type: "bool",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [],
      name: "symbol",
      outputs: [
        {
          internalType: "string",
          name: "",
          type: "string",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
    {
      inputs: [
        {
          internalType: "uint256",
          name: "tokenId",
          type: "uint256",
        },
      ],
      name: "tokenURI",
      outputs: [
        {
          internalType: "string",
          name: "",
          type: "string",
        },
      ],
      stateMutability: "view",
      type: "function",
    },
  ];
  const account = getAccount().address;
  console.log(account);
  const { hash } = await writeContract({
    address: "0xA741e0109BDf593bbe0388b619507F88A39bEF94",
    abi: BnicNFTABI,
    functionName: "mintNFTWithId",
    args: [account, randomToken, jsonUri, "https://bnic.io", "null"],
  });
  return hash;
};

