import { generate_nft } from "./nft"
$(() => {
  $(".js_btn_submit_nft").on("click", function () {
    let random = Math.floor(Math.random() * (9e12 - 1e12) + 1e12)
    $(".js_btn_submit_nft").hide()
    generate_nft(GLOBAL_AUTH_USER.id, "js_ballot_nft_dom", random, "ballot", "NFT ballot", "Generated by Bnic.io", null, false, {
      type: "ballot",
      ballot_id: $(".js_ballot_id").val(),
    })
  })
})