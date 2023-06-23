$(".js-xaside-logout").on("click", async () => {
    disconnect().then((result) => {
        localStorage.removeItem("walletconnect")
        window.location.href = route("logout")
    })
})


if (localStorage.getItem("aside") == "close") {
    openMenu()
}else{
    closeMenu()
}

function toggleStorate() {
    const menuState = localStorage.getItem("aside")
    localStorage.setItem("aside", menuState === "open" ? "close" : "open")
console.log(localStorage.getItem("aside"));

}

function openMenu() {
    $("action").hide()
    $("padding_bug").css("width", "96px")
    $(".js-xaside-maximize-menu").show()
    $(".xjs-main-aside-span").hide()
    $("xaside").css("width", "96px")
    $(".js-xaside-logo").hide()
    $(".x-aside-link-inside").css("width", "48px")
    $(".x-aside-link-inside").addClass("justify-center")
}
function closeMenu() {
    $("xaside").css("width", "320px")
    $(".js-xaside-logo").show()
    $("padding_bug").css("width", "320px")
    $(".js-xaside-maximize-menu").hide()
    $(".xjs-main-aside-span").show()
    $("action").show()
    $(".x-aside-link-inside").css("width", "100%")
    $(".x-aside-link-inside").removeClass("justify-center")
}
$("action").on("click", function () {
    openMenu()
    toggleStorate()

})
$(".js-xaside-maximize-menu").on("click", function () {
    closeMenu()
    toggleStorate()

})
