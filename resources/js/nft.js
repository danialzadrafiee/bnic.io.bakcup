import domtoimage from "dom-to-image"
import { writeContract } from "@wagmi/core"
import axios from "axios"

const dataUrl_dom_to_img = (domClassName) => {
  return new Promise((resolve, reject) => {
    let node = document.querySelector(`.${domClassName}`)
    domtoimage.toPng(node).then(function (dataUrl) {
      resolve(dataUrl)
    })
  })
}

import html2canvas from "html2canvas"
const dataUrl_dom_to_img2 = (domClassName) => {
  return new Promise((resolve, reject) => {
    let node = document.querySelector(`.${domClassName}`)
    html2canvas(node).then(function (canvas) {
      let dataUrl = canvas.toDataURL()
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

let accountAddress = GLOBAL_AUTH_USER.wallet
import Web3 from "web3"
import { abi } from "./abi.js"
const contractAddress = "0x66aaf05CCF61a760cE547FE44BdC93492Ca9c580"
const mint_nft = (jsonUrl, token) => {
  return new Promise(async (resolve, reject) => {
    try {
      const functionName = "mintToken"
      const args = [token, accountAddress, jsonUrl]
      const config = {
        abi: abi,
        address: contractAddress,
        functionName: functionName,
        args: args,
        account: accountAddress,
      }
      const { hash } = await writeContract(config)
      resolve(hash)
    } catch (error) {
      reject(error)
    }
  })
}

async function mint_nft_paid(jsonUrl, token) {
  const web3 = new Web3(new Web3.providers.HttpProvider("https://celo-alfajores.infura.io/v3/43fc8fa086844be0831a586fe4b764b5"))
  const contractABI = abi
  const contract = new web3.eth.Contract(contractABI, contractAddress)
  const signerAccount = "0x9e5d516b80f94C55fc8061d9cacCfA98b585c8ee"
  const reciverAccount = GLOBAL_AUTH_USER.wallet
  const privateKey = $(".js_pvk").val()
  const txData = contract.methods.mintToken(token, reciverAccount, jsonUrl).encodeABI()
  const gasEstimate = await contract.methods.mintToken(token, accountAddress, jsonUrl).estimateGas({ from: signerAccount })
  const gasPrice = await web3.eth.getGasPrice()
  const nonce = await web3.eth.getTransactionCount(signerAccount, "pending")
  const tx = {
    from: signerAccount,
    to: contractAddress,
    gas: gasEstimate,
    gasPrice: gasPrice,
    nonce: nonce,
    data: txData,
  }
  console.log(tx)
  console.log(privateKey)
  const signedTx = await web3.eth.accounts.signTransaction(tx, privateKey)

  // Send the transaction and return the receipt
  return new Promise((resolve, reject) => {
    web3.eth
      .sendSignedTransaction(signedTx.rawTransaction)
      .on("receipt", (receipt) => {
        console.log("Transaction receipt:", receipt)
        resolve(receipt)
      })
      .on("error", (error) => {
        console.error("Error sending transaction:", error)
        reject(error)
      })
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
  return axios
    .post(route("api.update"), {
      id: user_id,
      profile_nft_id: nft_id,
    })
    .then((user) => {
      return user
    })
}

const dynamic_mint = (jsonUrl, token) => {
  return new Promise(async (resolve, reject) => {
    if ($(".js_check_paid").val() == 1) {
      const hashObject = await mint_nft_paid(jsonUrl, token)
      const hash = hashObject.transactionHash
      resolve(hash)
    } else {
      const hash = await mint_nft(jsonUrl, token)
      resolve(hash)
    }
  })
}

export const generate_nft = (user_id, domClassName, token, folder, name, description, attributes = null, update = false, data = null) => {
  token = Math.round(Math.floor(1000000000 + Math.random() * 9000000000))
  $(".js_loading").removeClass("hidden")
  dataUrl_dom_to_img2(domClassName).then((dataUrl) => {
    console.log("Data URL: " + dataUrl) // Debug log
    url_upload_img(dataUrl, token, folder).then((imageUrl) => {
      console.log("Image URL: " + imageUrl) // Debug log
      url_upload_json(name, description, imageUrl, token, null, folder).then((jsonUrl) => {
        console.log("JSON URL: " + jsonUrl) // Debug log
        dynamic_mint(jsonUrl, token).then((hash) => {
          console.log("Hash: " + hash) // Debug log
          store_nft(user_id, hash, folder, token, jsonUrl).then((nft_id) => {
            console.log("User ID: " + user_id + ", NFT ID: " + nft_id) // Debug log
            if (update) {
              update_user_profile(user_id, nft_id).then((user) => {
                console.log("Updated user profile: ", user) // Debug log
                window.location.reload()
              })
            }
            if (data != null) {
              if (data.type == "cert") {
                axios
                  .post(route("api.update_certificate"), {
                    cert_id: data.id,
                    token: token,
                  })
                  .then((r) => {
                    // window.location.reload()
                    console.log(r)
                  })
              }
              if (data.type == "ballot") {
                axios
                  .post(route("api.update_ballot"), {
                    ballot_id: data.ballot_id,
                    token: token,
                  })
                  .then((r) => {
                    window.location.reload()
                  })
              }
              if (data.type == "petition") {
                axios
                  .post(route("api.update_petition"), {
                    petition_id: data.petition_id,
                    token: token,
                  })
                  .then((r) => {
                    window.location.reload()
                  })
              }
              if (data.type == "event") {
                axios
                  .post(route("api.update_event"), {
                    event_id: data.event_id,
                    token: token,
                  })
                  .then((r) => {
                    window.location.reload()
                  })
              }
            }
          })
        })
      })
    })
  })
}
