$(".js-btn-signchain").on("click", function () {
    sign_wallet_modal.showModal();
}); // bayad bere too dashboard

import domtoimage from "dom-to-image";
$(() => {
    $(".js-btn-signchain-submit").on("click", function () {
        let node = document.querySelector(".js-nft-box");

        domtoimage
            .toPng(node)
            .then(function (dataUrl) {
                axios
                    .post(route("nft.upload_nft_image"), {
                        image: dataUrl,
                    })
                    .then((r) => console.log(r))
                    .catch((error) => console.error("Axios request failed", error));
            })
            .catch(function (error) {
                console.error("oops, something went wrong!", error);
            });
    });
});
