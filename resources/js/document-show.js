$(".js-btn-sign").on("click", function (event) {
    event.preventDefault()
    let clonedForm = $(".js-form-data").clone()

    $(".js-form-data")
        .find("input, textarea, select")
        .each(function (index, element) {
            var tagName = element.tagName.toLowerCase()
            var type = $(element).attr("type")

            if (tagName === "input" && (type === "checkbox" || type === "radio")) {
                if ($(element).prop("checked")) {
                    clonedForm.find(`[name="${element.name}"]`).prop("checked", true)
                }
            } else if (tagName === "input") {
                clonedForm.find(`[name="${element.name}"]`).attr("value", $(element).val())
            } else if (tagName === "textarea") {
                clonedForm.find(`[name="${element.name}"]`).html($(element).val())
            } else if (tagName === "select") {
                var selectedIndex = $(element).find("option:selected").index()
                clonedForm.find(`[name="${element.name}"] option`).removeAttr("selected")
                clonedForm.find(`[name="${element.name}"] option:eq(${selectedIndex})`).attr("selected", "selected")
            }
        })

    var formContent = clonedForm.html()
    $(".js-hidden-real-content").val(formContent)
    console.log($(".js-form-real").serializeArray())

    $(".js-form-real").trigger("submit")
})

$("body").on("click", ".js-add-additional-row", function () {
    let CloneRow = $(".js-row-additional").last().clone()
    CloneRow.find("input").val("")
    let thisRow = $(this).closest(".js-row-additional")
    thisRow.find(".js-add-additional-row").hide()
    thisRow.find(".js-rem-additional-row").show()
    thisRow.after(CloneRow)
})
$("body").on("click", ".js-rem-additional-row", function () {
    let thisRow = $(this).closest(".js-row-additional")
    thisRow.remove()
})

//searchUser begin
let template = $(".js-row-user").first()
$(".js-btn-search").on("click", function () {
    let query = $(".js-input-search").val()
    $(".js-section-search-result").empty()

    function getEmailHash(email, callback) {
        const encoder = new TextEncoder()
        const data = encoder.encode(email)
        crypto.subtle.digest("SHA-256", data).then((hashBuffer) => {
            const hashArray = Array.from(new Uint8Array(hashBuffer))
            const hashHex = hashArray.map((b) => b.toString(16).padStart(2, "0")).join("")
            callback(hashHex)
        })
    }

    axios
        .get(`${route("actions.search_invi_by_name")}?query=${query}`)
        .then(function (response) {
            let data = response.data
            console.log(data)
            if (data.length > 0) {
                data.forEach((element) => {
                    getEmailHash(element.email, function (emailHash) {
                        let clone = template.clone() // Create a new clone for each element
                        clone.find(".js-search-user-first-name").text(element.first_name)
                        clone.find(".js-search-user-last-name").text(element.last_name)
                        clone.find(".js-search-user-email").text(element.email)
                        clone.find(".js-search-user-wallet").val(element.wallet)
                        clone.find(".js-search-user-image").attr("src", `https://api.dicebear.com/6.x/identicon/svg?seed=${element.email}`)
                        clone.find(".js-search-user-code").html(`${element.gender[0]}-${emailHash.substr(0, 8)}-${element.id}`)
                        clone.find(".js-search-user-cv").html(element.cv.replace(/<\/?[^>]+(>|$)/g, "").length > 90 ? element.cv.replace(/<\/?[^>]+(>|$)/g, "").substring(0, 90) + ".." : element.cv.replace(/<\/?[^>]+(>|$)/g, ""))
                        $(".js-section-search-result").append(clone)
                    })
                })
            } else {
                $(".js-section-search-result").append('<p class="text-center">No se encontraron resultados</p>')
            }
        })
        .catch(function (error) {
            console.log(error)
        })
})
$(".js-modal-select-user").on("click", function (event) {
    if (event.target.tagName === "MODAL") {
        $(this).hide()
    }
})

let selected_email = null
$("body").on("click", ".js-input-email", function () {
    selected_email = $(this)
    $(".js-modal-select-user").show()
})
$("body").on("click", ".js-btn-select-user", function () {
    selected_email.val($(this).data("email"))
    $(".js-modal-select-user").hide()
})
//searchUser end

const is_owner = JSON.parse($(".js-is-owner").val())
console.log(is_owner ? 'you are owner' : 'you are not owner')

$(function () {
    $("field.js-element").each(function () {

        let creator_publicity = JSON.parse($(this).attr("data-publicity-creator").split(" ").join(""))
        let reciver_publicity = JSON.parse($(this).attr("data-publicity-reciver").split(" ").join(""))
        let checkboxes = $(this)
            .find('input[type="checkbox"]')
            .each(function () {
                let checkbox = $(this)
                if (checkbox.val() == "creator") {
                    checkbox.prop("checked", creator_publicity)
                }
                if (checkbox.val() == "reciver") {
                    checkbox.prop("checked", reciver_publicity)
                }
            })

        if (!is_owner) {
            $(this).find("publicity").addClass("hidden")
        }
    })
})
