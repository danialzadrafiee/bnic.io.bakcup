import $ from "jquery"
import axios from "axios"
window.$ = $
window.axios = axios

import "./vite-shims"
import { EthereumClient, w3mConnectors, w3mProvider } from "@web3modal/ethereum"
import { Web3Modal } from "@web3modal/html"
import { configureChains, createConfig } from "@wagmi/core"
import { polygonMumbai, celoAlfajores } from "@wagmi/core/chains"
import { disconnect } from "@wagmi/core"
import { getContract } from "@wagmi/core"
import { getAccount } from "@wagmi/core"
import { writeContract } from "@wagmi/core"
window.chains = [polygonMumbai, celoAlfajores]
window.projectId = "798d24edeab92235f15f62fdd6a9985f"

// Assign the imports to the window object
window.EthereumClient = EthereumClient
window.w3mConnectors = w3mConnectors
window.w3mProvider = w3mProvider
window.Web3Modal = Web3Modal
window.configureChains = configureChains
window.createConfig = createConfig
window.polygonMumbai = polygonMumbai
window.disconnect = disconnect
window.getContract = getContract
window.getAccount = getAccount
window.writeContract = writeContract
const { publicClient } = configureChains(chains, [w3mProvider({ projectId })])
window.publicClient = publicClient
window.wagmiConfig = createConfig({
  autoConnect: true,
  connectors: w3mConnectors({ projectId, version: 1, chains }),
  publicClient,
})

$(function () {
  $(".js_tooltip").mouseover(function (e) {
    $(this).addClass("relative")
    let height = $(this).height()
    $(this).append(
      $("<p>", {
        class: `tooltipText absolute right-0 mx-auto rounded w-max p-3 rounded bg-base-content text-white  text-xs`,
        text: $(this).attr("data-tip"),
        style: ` bottom : ${height + 12}px`,
      })
    )
  })

  $(".js_tooltip").on('mouseleave',function () {
    $(".tooltipText").remove()
  })
})
