// //#region long code & consts
// let originalConsoleLog = console.log
// console.log = function (message) {
//     if (typeof message !== "string" || !message.startsWith("Error while reading CSS rules")) {
//         originalConsoleLog.apply(console, arguments)
//     }
// }

const contractAddress = "0x9aE6956C0B503ed5d29c420cD7322d8347640325"

import { abi } from "./abi.js"

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
let accountAddress = GLOBAL_AUTH_USER.wallet

const mint_nft = (jsonUrl, token) => {
    return new Promise(async (resolve, reject) => {
        try {
            const functionName = "mintNFT"
            const args = [accountAddress, token, jsonUrl]
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

import Web3 from "web3"
const pvk = $(".js_pvk").val()
let requestsCounter = 0
async function mint_nft_paid(jsonUrl, token) {
    return new Promise(async (resolve, reject) => {
        requestsCounter++

        setTimeout(async () => {
            let web3 = new Web3("https://rpc.ankr.com/polygon_mumbai")
            let contract = new web3.eth.Contract(abi, contractAddress)
            let gasPrice = await web3.eth.getGasPrice()
            gasPrice = Number(gasPrice) * 1.5
            let method = contract.methods.mintNFT(accountAddress, token, jsonUrl)
            let gasLimit = await method.estimateGas({ from: accountAddress })
            let encodedABI = method.encodeABI()
            let rawTransaction = {
                from: accountAddress,
                gasPrice: web3.utils.toHex(Math.round(gasPrice)),
                gasLimit: web3.utils.toHex(Math.round(Number(gasLimit) + 50000)),
                to: contractAddress,
                data: encodedABI,
            }
            let signedTransaction = await web3.eth.accounts.signTransaction(rawTransaction, pvk)
            let result = await web3.eth.sendSignedTransaction(signedTransaction.rawTransaction)
            resolve(result)
        }, requestsCounter * 1000) // A delay of 1 sec between each request
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

export const generate_nft = (user_id, domClassName, token, folder, name, description, attributes = null, update = false) => {
    $(".js_loading").removeClass("hidden")
    dataUrl_dom_to_img(domClassName).then((dataUrl) => {
        console.log("Data URL: " + dataUrl) // Debug log
        url_upload_img(dataUrl, token, folder).then((imageUrl) => {
            console.log("Image URL: " + imageUrl) // Debug log
            url_upload_json(name, description, imageUrl, token, null, folder).then((jsonUrl) => {
                console.log("JSON URL: " + jsonUrl) // Debug log
                dynamic_mint(jsonUrl, Math.round(Math.floor(1000000000 + Math.random() * 9000000000))).then((hash) => {
                    console.log("Hash: " + hash) // Debug log
                    store_nft(user_id, hash, folder, token, jsonUrl).then((nft_id) => {
                        console.log("User ID: " + user_id + ", NFT ID: " + nft_id) // Debug log
                        if (update) {
                            update_user_profile(user_id, nft_id).then((user) => {
                                console.log("Updated user profile: ", user) // Debug log
                                window.location.reload()
                            })
                        }
                    })
                })
            })
        })
    })
}
