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
function addCatValid() {
    if (icon != "" && $(".js-category-name").val() != "") {
        $(".js-category-submit").prop("disabled", false)
    } else {
        $(".js-category-submit").prop("disabled", true)
    }
}
let icon = ""
$(".js-category-name").on("keyup", function () {
    addCatValid()
})
$(".js-category-submit").on("click", function () {
    axios
        .post(route("api.add_category_to_user"), {
            user_id: GLOBAL_AUTH_USER.id,
            icon: icon,
            name: $(".js-category-name").val(),
            publicity: 1,
        })
        .then(() => {
            window.location.reload()
        })
})
$(".js_category_icon").on("click", function () {
    icon = $(this).find("i").attr("class").replace("fas", "").trim()
    $(".js_category_icon").removeClass("js_active bg-primary text-white")
    $(this).addClass("js_active bg-primary text-white")
    addCatValid()
})

// public function add_category_to_user(Request $request)
// {

//     $user = User::where('id', $request->user_id)->first();
//     $category = $user->categories()->create($request->all());
//     return $category;
// }
