//#region long code & consts
const contractAddress = "0x9aE6956C0B503ed5d29c420cD7322d8347640325"
let originalConsoleLog = console.log
console.log = function (message) {
    if (typeof message !== "string" || !message.startsWith("Error while reading CSS rules")) {
        originalConsoleLog.apply(console, arguments)
    }
}
const abi = [
    {
        inputs: [],
        stateMutability: "nonpayable",
        type: "constructor",
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
        anonymous: false,
        inputs: [
            {
                indexed: false,
                internalType: "uint256",
                name: "_fromTokenId",
                type: "uint256",
            },
            {
                indexed: false,
                internalType: "uint256",
                name: "_toTokenId",
                type: "uint256",
            },
        ],
        name: "BatchMetadataUpdate",
        type: "event",
    },
    {
        anonymous: false,
        inputs: [
            {
                indexed: false,
                internalType: "uint256",
                name: "_tokenId",
                type: "uint256",
            },
        ],
        name: "MetadataUpdate",
        type: "event",
    },
    {
        inputs: [
            {
                internalType: "address",
                name: "recipient",
                type: "address",
            },
            {
                internalType: "uint256",
                name: "tokenId",
                type: "uint256",
            },
            {
                internalType: "string",
                name: "tokenURI",
                type: "string",
            },
        ],
        name: "mintNFT",
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
                internalType: "uint256",
                name: "tokenId",
                type: "uint256",
            },
            {
                internalType: "string",
                name: "newTokenURI",
                type: "string",
            },
        ],
        name: "updateTokenURI",
        outputs: [],
        stateMutability: "nonpayable",
        type: "function",
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
]
const accountAdddress = getAccount().address //todo async
//#endregion

import domtoimage from "dom-to-image"
import { writeContract } from "@wagmi/core"
import { data } from "jquery"
import axios from "axios"

const dataUrl_dom_to_img = (domClassName) => {
    return new Promise((resolve, reject) => {
        let node = document.querySelector(`.${domClassName}`)
        domtoimage.toPng(node).then(function (dataUrl) {
            resolve(dataUrl)
        })
    })
}
const url_upload_img = (dataUrl, token, folder) => {
    return axios
        .post(route("nft.upload_nft_image"), {
            image: dataUrl,
            token: token,
            folder: folder,
        })
        .then((r) => {
            let imageUrl = r.data.url
            return imageUrl
        })
}

const url_upload_json = (name, description, image, token, attributes = null, folder) => {
    const jsonObject = {
        name: name,
        description: description,
        image: image,
        attributes: attributes,
    }
    return axios
        .post(route("nft.create_json_nft"), {
            json: jsonObject,
            token: token,
            folder: folder,
        })
        .then((r) => {
            let jsonUrl = r.data
            return jsonUrl
        })
}
const minf_nft = (json, token) => {
    return new Promise(async (resolve, reject) => {
        try {
            const functionName = "mintNFT"
            const args = [accountAdddress, token, json]
            const config = {
                abi: abi,
                address: contractAddress,
                functionName: functionName,
                args: args,
                account: accountAdddress,
            }
            const { hash } = await writeContract(config)
            resolve(hash)
        } catch (error) {
            reject(error)
        }
    })
}

const store_nft = (user_id, hash, type = "profile", token, json) => {
    return axios
        .post(route("nft.store"), {
            id: user_id,
            type: type,
            token: token,
            url: json,
            hash: hash,
        })
        .then((stored_nft) => {
            let nft_id = stored_nft.data.id
            return nft_id
        })
}

const update_user_profile = (user_id, nft_id) => {
    axios
        .post(route("api.update"), {
            id: user_id,
            profile_nft_id: nft_id,
        })
        .then((user) => {
            console.log(user)
        })
}

export const generate_nft = (user_id, domClassName, token, folder, name, description, attributes = null, update = false) => {
    dataUrl_dom_to_img(domClassName).then((dataUrl) => {
        url_upload_img(dataUrl, token, folder).then((imageUrl) => {
            url_upload_json(name, description, imageUrl, token, null, folder).then((jsonUrl) => {
                minf_nft(jsonUrl, token).then((hash) => {
                    store_nft(user_id, hash, folder, token, jsonUrl).then((nft_id) => {
                        if (update) {
                            update_user_profile(user_id, nft_id)
                        }
                        window.location.reload()
                    })
                })
            })
        })
    })
}
