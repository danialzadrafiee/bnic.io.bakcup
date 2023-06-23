#!/bin/bash

# Define the file
file='nft.js'

# Add console.log debug statements
sed -i '/const contractAddress/a console.log("DEBUG: contractAddress =", contractAddress);' $file
sed -i '/let originalConsoleLog/a console.log("DEBUG: originalConsoleLog =", originalConsoleLog);' $file
sed -i '/const abi/a console.log("DEBUG: abi =", JSON.stringify(abi, null, 2));' $file
sed -i '/const accountAdddress/a console.log("DEBUG: accountAdddress =", accountAdddress);' $file
sed -i '/import domtoimage/a console.log("DEBUG: domtoimage imported successfully");' $file
sed -i '/import { writeContract }/a console.log("DEBUG: writeContract imported successfully");' $file
sed -i '/import { data }/a console.log("DEBUG: data imported successfully");' $file
sed -i '/import axios/a console.log("DEBUG: axios imported successfully");' $file
sed -i '/const dataUrl_dom_to_img/a console.log("DEBUG: dataUrl_dom_to_img =", dataUrl_dom_to_img);' $file
sed -i '/const url_upload_img/a console.log("DEBUG: url_upload_img =", url_upload_img);' $file
sed -i '/const url_upload_json/a console.log("DEBUG: url_upload_json =", url_upload_json);' $file
sed -i '/const minf_nft/a console.log("DEBUG: minf_nft =", minf_nft);' $file
sed -i '/const store_nft/a console.log("DEBUG: store_nft =", store_nft);' $file
sed -i '/const update_user_profile/a console.log("DEBUG: update_user_profile =", update_user_profile);' $file
sed -i '/export const generate_nft/a console.log("DEBUG: generate_nft =", generate_nft);' $file

echo "All console.log debug statements have been added successfully."
