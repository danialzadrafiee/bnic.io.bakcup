// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

import "@openzeppelin/contracts/token/ERC721/extensions/ERC721URIStorage.sol";
import "@openzeppelin/contracts/access/Ownable.sol";

contract BnicNFT is ERC721URIStorage, Ownable {
    constructor() ERC721("BnicNFT", "BNIC") {}

    function mintToken(uint256 tokenId, address receiver, string memory tokenURI) public {
        _mint(receiver, tokenId);
        _setTokenURI(tokenId, tokenURI);
    }

    function updateTokenURI(uint256 tokenId, string memory newURI) public {
        _setTokenURI(tokenId, newURI);
    }

    function transferToken(address from, address to, uint256 tokenId) public {
        _transfer(from, to, tokenId);
    }
}
