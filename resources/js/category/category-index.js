import moment from "moment"
import modal from "jquery-modal"
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
    // Categories id
    templateClone.attr("cat-id", certificate.category_id)
    templateClone.attr("sub-cat-id", certificate.sub_cat_id)
    // Categories name
    axios
      .post(route("category.select"), { category_id: certificate.category_id })
      .then((r) => (r.data.name ? templateClone.find(".js_card_cat").text(r.data.name) : templateClone.find(".js_card_cat").hide))
    axios
      .post(route("sub_cat.select", { sub_cat_id: certificate.sub_cat_id }))
      .then((r) => (r.data.name ? templateClone.find(".js_card_sub_cat").text(r.data.name) : templateClone.find(".js_card_sub_cat").hide))
    templateClone.find(".js-card-subject").html(certificate.name)
    templateClone.find(".js-card-description").html(certificate.description)
    templateClone.find("figure img").attr("src", certificate.image)
    //creator
    axios.post(route("api.getUserJson"), { id: certificate.corporation_id }).then((r) => {
      templateClone.find(".js-card-creator").html(r.data.corp_name)
    })
    //requester
    axios.post(route("api.getUserJson"), { id: certificate.user_id }).then((r) => {
      templateClone.find(".js-card-requester").html(r.data.first_name + " " + r.data.last_name)
    })
    //reciver

    certificate.reciver.length > 0 ? templateClone.find(".js-card-reciver").html(certificate.reciver) : templateClone.find(".js-card-reciver").addClass("hidden")
    console.log(certificate.reciver)

    //link
    templateClone.find(".js-card-action").attr("href", route("cert.pub_show", { id: certificate.id }))
    // Parse the date and time
    let createdAt = moment(certificate.created_at, "YYYY-MM-DD HH:mm:ss")
    templateClone.find(".js-card-date").html(createdAt.format("YYYY-MM-DD"))
    templateClone.find(".js-card-time").html(createdAt.format("HH:mm:ss"))
    //badges
    certificate.creator_verify == 1 && templateClone.find(".js-badge-creator").removeClass("badge-warning").addClass("badge-accent")
    certificate.reciver_verify == 1 && templateClone.find(".js-badge-reciver").removeClass("badge-warning").addClass("badge-accent")
    // edit
    templateClone.find(".js_edit_card").attr("data-id", `${certificate.id}`)
    templateClone.find(".js_edit_card").on("click", function () {
      editCertCategory($(this).attr("data-id"))
    })
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

function editCertCategory(cert_id) {
  axios.post(route("api.get_certificate"), { cert_id: cert_id }).then((certificate) => {
    $(".js_cert_name").html(certificate.data.name)
    $("#modal_edit").show()
    $(".js_cetificate_id").val(certificate.data.id)

    $(".js_categories")
      .find("option")
      .each(function () {
        if (this.value == certificate.data.category_id) {
          $(this).prop("selected", "ture")
        }
      })
    setSubCategories(certificate.data.category_id).then(() => {
      $(".js_categories_sub")
        .find("option")
        .each(function () {
          if (this.value == certificate.data.sub_cat_id) {
            $(this).prop("selected", "ture")
          }
        })
    })
  })
}

function truncateString(str) {
  if (str.length > 140) {
    return str.substring(0, 140) + "..."
  } else {
    return str
  }
}

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
get_search_result()

// modal

const get_categories = () => {
  return axios
    .get(route("api.getUserCategoriesJson"), {
      params: {
        user_id: GLOBAL_AUTH_USER.id,
      },
    })
    .then((json) => {
      return json.data
    })
}
get_categories().then((categories) => {
  $(".js_categories").append(
    $("<option>", {
      text: "All",
      value: 0,
    })
  )
  categories.forEach((element) => {
    $(".js_categories").append(
      $("<option>", {
        text: element.name,
        value: element.id,
      })
    )
  })
  resetSubCategories()
})

// Add this function
const get_sub_categories = (category_id) => {
  return axios
    .get(route("api.getUserSubCategoriesJson"), {
      params: {
        category_id: category_id,
      },
    })
    .then((json) => {
      return json.data
    })
}

// Call the function when a category is selected
function resetSubCategories() {
  $(".js_categories_sub").empty()
  $(".js_categories_sub").append(
    $("<option>", {
      text: "Other",
      value: 0,
    })
  )
}
function setSubCategories(category_id) {
  return new Promise((resolve, reject) => {
    get_sub_categories(category_id).then((sub_categories) => {
      if (category_id == 0) {
        resetSubCategories()
      }
      sub_categories.forEach((element) => {
        $(".js_categories_sub").append(
          $("<option>", {
            text: element.name,
            value: element.id,
          })
        )
      })
      resolve(sub_categories)
    })
  })
}
$(".js_categories").on("change", function () {
  resetSubCategories()
  $(this).val() != 0 ? setSubCategories($(this).val()) : resetSubCategories()
})

$(".JSX_MODAL").on("click", function (e) {
  $(e.target).hasClass("JSX_MODAL") && $(this).hide()
})

$(".JSX_MODAL_CLOSE").on("click", function (e) {
  $(".JSX_MODAL").hide()
})
