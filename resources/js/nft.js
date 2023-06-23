//#region long code & consts
const contractAddress = "0x9aE6956C0B503ed5d29c420cD7322d8347640325"
console.log("DEBUG: contractAddress =", contractAddress)
let originalConsoleLog = console.log
console.log("DEBUG: originalConsoleLog =", originalConsoleLog)
console.log = function (message) {
    if (typeof message !== "string" || !message.startsWith("Error while reading CSS rules")) {
        originalConsoleLog.apply(console, arguments)
    }
}
import { abi } from "./abi.js"

const accountAdddress = getAccount().address //todo async
console.log("DEBUG: accountAdddress =", accountAdddress)
//#endregion

import domtoimage from "dom-to-image"
console.log("DEBUG: domtoimage imported successfully")
import { writeContract } from "@wagmi/core"
console.log("DEBUG: writeContract imported successfully")
import { data } from "jquery"
console.log("DEBUG: data imported successfully")
import axios from "axios"
console.log("DEBUG: axios imported successfully")

const dataUrl_dom_to_img = (domClassName) => {
    console.log("DEBUG: dataUrl_dom_to_img =", dataUrl_dom_to_img)
    return new Promise((resolve, reject) => {
        let node = document.querySelector(`.${domClassName}`)
        domtoimage.toPng(node).then(function (dataUrl) {
            resolve(dataUrl)
        })
    })
}
const url_upload_img = (dataUrl, token, folder) => {
    console.log("DEBUG: url_upload_img =", url_upload_img)
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
    console.log("DEBUG: url_upload_json =", url_upload_json)
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
    console.log("DEBUG: minf_nft =", minf_nft)
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
    console.log("DEBUG: store_nft =", store_nft)
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
    console.log("DEBUG: update_user_profile =", update_user_profile)
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
    console.log("DEBUG: generate_nft =", generate_nft)
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
