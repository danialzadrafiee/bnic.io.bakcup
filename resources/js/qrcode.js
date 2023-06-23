import QRCode from "qrcode";

document.addEventListener("DOMContentLoaded", (event) => {
    let qrDataElements = document.querySelectorAll(".js-qr-data");
    let qrImageElements = document.querySelectorAll(".js-qr-image");

    qrDataElements.forEach((qrDataElement, index) => {
        let qrImageElement = qrImageElements[index];
        if (qrImageElement) {
            let qrData = qrDataElement.value;
            QRCode.toDataURL(qrData, { errorCorrectionLevel: "H", margin: 0, width: 500 }, function (err, url) {
                if (err) console.error("Unable to generate QR code:", err);
                else qrImageElement.src = url;
            });
        }
    });
});
