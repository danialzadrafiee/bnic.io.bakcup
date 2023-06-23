console.log(GLOBAL_AUTH_USER.id)
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
