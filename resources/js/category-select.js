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

const load_categories = (categories) => {
  categories.forEach((category) => {
    $(".js-category-select").append(
      $("<option>", {
        value: category.id,
        text: category.name,
      })
    )
  })
  $(".js-category-select")
    .find("option")
    .each(function () {
      if ($(this).val() === getQueryParams().category_id) {
        $(this).prop("selected", true)
        return false
      }
    })
}

//onload
$(function () {
  get_categories().then((categories) => {
    load_categories(categories)
  })
})

$(".js-category-select").on("change", function () {
  $(this).val() != 0 ? $(".js_sub_cat_filter_field").show() : $(".js_sub_cat_filter_field").hide()
  let selected_cat_id = $(this).val()
  axios
    .post(route("api.getUserSubCategoriesJson"), {
      category_id: selected_cat_id,
    })
    .then((sub_cats_json) => {
      sub_cats_json && $(".js-sub-cat-list").empty()
      sub_cats_json.data.forEach((sub_cat) => {
        let sub_cat_element = $("<label>", {
          class: "flex items-center gap-2",
        })
        sub_cat_element.append(
          $("<input>", {
            type: "checkbox",
            class: "js-checkbox-filter checkbox checkbox-xs rounded",
            value: sub_cat.id,
            checked: true,
            click: function (e) {
              filterChanged(e)
            },
          })
        )
        sub_cat_element.append(
          $("<div>", {
            text: sub_cat.name,
          })
        )
        $(".js-sub-cat-list").append(sub_cat_element)
      })
    })
})

function filterChanged(e) {
  let selected_checkbox = $(e.target)
  let related_card = $(".js-certificate-requests").find(`.js-card-template[sub-cat-id="${selected_checkbox.val()}"]`)
  if (!selected_checkbox.prop("checked")) {
    related_card.hide()
  } else {
    related_card.show()
  }
}
