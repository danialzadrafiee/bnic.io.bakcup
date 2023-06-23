import "./vite-shims";

import { Web3Modal } from "@web3modal/html";

const ethereumClient = new EthereumClient(wagmiConfig, chains);
const web3modal = new Web3Modal({ projectId }, ethereumClient);

ethereumClient.watchAccount((userAccount) => {
  console.log(userAccount);
  if (userAccount.address) {
    window.location.href = route("walletconnect.showRegistrationForm", { wallet_address: userAccount.address });
  }
});

