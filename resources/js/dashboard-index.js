$(".js-btn-signchain").on("click", () => {
    sign_wallet_modal.showModal()
})
const rootColors = [
    "--lemon-chiffon",
    "--champagne-pink",
    "--tea-rose-red",
    "--pink-lavender",
    "--mauve",
    "--jordy-blue",
    "--non-photo-blue",
    "--electric-blue",
    "--aquamarine",
    "--celadon",
    "--thistle",
    "--powder-blue",
    "--peach-puff",
    "--honeydew",
    "--misty-rose",
    "--light-sky-blue",
    "--light-salmon",
    "--cornsilk",
    "--lavender-blush",
    "--linen",
]

const rootTextColors = [
    "--lemon-chiffon-dark",
    "--champagne-pink-dark",
    "--tea-rose-red-dark",
    "--pink-lavender-dark",
    "--mauve-dark",
    "--jordy-blue-dark",
    "--non-photo-blue-dark",
    "--electric-blue-dark",
    "--aquamarine-dark",
    "--celadon-dark",
    "--thistle-dark",
    "--powder-blue-dark",
    "--peach-puff-dark",
    "--honeydew-dark",
    "--misty-rose-dark",
    "--light-sky-blue-dark",
    "--light-salmon-dark",
    "--cornsilk-dark",
    "--lavender-blush-dark",
    "--linen-dark",
]
const categoryEditElements = document.querySelectorAll(".js-cat-color")

categoryEditElements.forEach((element, index) => {
    const color = rootColors[index % rootColors.length]
    const textColor = rootTextColors[index % rootColors.length]
    element.style.backgroundColor = `var(${color})`
    element.style.setProperty("--hover-color", `var(${textColor})`)
    element.style.setProperty("--hover-text-color", `var(${color})`)
    const iconElement = element.querySelector(".js-cat-i")
    if (iconElement) {
        iconElement.style.color = `var(${textColor})`
    }
})
