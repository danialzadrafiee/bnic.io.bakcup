import "./vite-shims"

import { Web3Modal } from "@web3modal/html"

const ethereumClient = new EthereumClient(wagmiConfig, chains)
const web3modal = new Web3Modal({ projectId }, ethereumClient)

ethereumClient.watchAccount((userAccount) => {
    if (userAccount.address) {
        window.location.href = route("walletconnect.showRegistrationForm", { wallet_address: userAccount.address })
    }
})

if (localStorage.getItem("js_inviter_email") == "" || localStorage.getItem("js_inviter_email") == null) {
    localStorage.setItem("js_inviter_email", $(".js_inviter_email").val())
}
if (localStorage.getItem("js_is_fee_paid") == null || localStorage.getItem("js_is_fee_paid") == 0) {
    localStorage.setItem("js_is_fee_paid", $(".js_is_fee_paid").val())
}
console.log(localStorage.getItem("js_inviter_email"))
console.log(localStorage.getItem("js_is_fee_paid"))
