import moment from "moment"
let container = $(".js-certificate-requests")
const getQueryParams = () => {
    let queryParams = {}
    let queryString = window.location.search.slice(1)
    if (queryString) {
        let pairs = queryString.split("&")
        for (let i = 0; i < pairs.length; i++) {
            let pair = pairs[i].split("=")
            let key = decodeURIComponent(pair[0])
            let value = decodeURIComponent(pair[1] || "")
            if (queryParams[key]) {
                if (Array.isArray(queryParams[key])) {
                    queryParams[key].push(value)
                } else {
                    queryParams[key] = [queryParams[key], value]
                }
            } else {
                queryParams[key] = value
            }
        }
    }
    return queryParams
}
$(function () {
    let params = getQueryParams()
    let category = params.hasOwnProperty("category_id") ? params.category_id : $(".js-category-select").val()
    getCertificates(category).then((certificates) => {
        container.empty()
        listCertificates(certificates)
    })
})

$(".js-category-select").on("change", function () {
    let category_id = $(this).val()
    getCertificates(category_id).then((certificates) => {
        container.empty()
        listCertificates(certificates)
    })
    category_id != 0 && $(".js-category-setting").show()
})
const getCertificates = (category_id) => {
    return axios.get(route("cert.list", { user_id: GLOBAL_AUTH_USER.id, category_id: category_id })).then((response) => {
        let certificates = response.data

        return certificates
    })
}
const listCertificates = (certificates) => {
    let template = $(".js-card-template")
    certificates.forEach((certificate) => {
        let templateClone = template.clone()

        // Fill in the certificate details
        templateClone.find(".js-card-subject").html(certificate.name)
        templateClone.find(".js-card-description").html(certificate.description)
        templateClone.find("figure img").attr("src", certificate.image)
        templateClone.find(".js-card-creator").html(certificate.corporation_id)
        templateClone.find(".js-card-requester").html(certificate.user_id)
        templateClone.find(".js-card-reciver").html(certificate.reciver)
        //link
        templateClone.find(".js-card-action").attr("href", route("cert.pub_show", { id: certificate.id }))
        // Parse the date and time
        let createdAt = moment(certificate.created_at, "YYYY-MM-DD HH:mm:ss")
        templateClone.find(".js-card-date").html(createdAt.format("YYYY-MM-DD"))
        templateClone.find(".js-card-time").html(createdAt.format("HH:mm:ss"))
        //badges
        certificate.creator_verify == 1 && templateClone.find(".js-badge-creator").removeClass("badge-warning").addClass("badge-accent")
        certificate.reciver_verify == 1 && templateClone.find(".js-badge-reciver").removeClass("badge-warning").addClass("badge-accent")
        // Append to the parent container
        $(".js-certificate-requests").append(templateClone)
    })
}

$(".js_open_request_certificate_modal").on("click", function () {
    js_modal_categories.showModal()
})
$(".js-btn-search").on("click", function () {
    get_search_result()
})

function truncateString(str) {
    if (str.length > 140) {
        return str.substring(0, 140) + "..."
    } else {
        return str
    }
}
get_search_result()
function get_search_result() {
    $(".js-section-corp-data").empty()
    let template = $(".corporation-template")
    axios
        .post(route("api.search_corporation"), {
            term: $(".js-input-search").val(),
        })
        .then((corporations) => {
            corporations.data.forEach((corporation) => {
                let template_clone = template.clone()
                template_clone.find("img").attr("src", `https://api.dicebear.com/6.x/initials/svg?seed=${corporation.corp_name.replace(/[^a-zA-Z0-9]/g, "")}`)
                template_clone.find("name").html(corporation.corp_name)
                template_clone.find("detail").html(truncateString(corporation.corp_cv))
                template_clone.find("type").html(corporation.user_type)
                template_clone.find("cat_pri").html(corporation.corp_cat_pri)
                template_clone.find("a").attr("href", route("dashboard.public_index", { user_id: corporation.id }))
                $(".js-section-corp-data").append(template_clone)
            })
        })
}
