import * as FilePond from "filepond"
import FilePondPluginImagePreview from "filepond-plugin-image-preview"

$(function () {
  FilePond.registerPlugin(FilePondPluginImagePreview)
  const inputElement = document.querySelector('.js_event_image')
  const pond = FilePond.create(inputElement, {
    server: {
      url: "/api/filepond",
      process: "/process",
      revert: "/revert",
      restore: "/restore",
      load: "/load",
    },
  })
  pond.on("processfile", (error, file) => {
    if (error) {
      console.error("File processing failed:", error)
      return
    }
    const response = JSON.parse(file.serverId)
    $(".js-event-image").val(response.id).trigger("change")
    console.log(response.id)
  })
  // #END-FILEPOND
})

//USER SEARCH
let selected_users = []

const searchUsers = () => {
  return axios
    .post(route("walletconnect.search_invidual"), {
      term: $(".js-search-input.input").val(),
    })
    .then((users) => {
      return users.data
    })
}
const listUsers = (users) => {
  $(".js-searched-users").empty()
  users.forEach((user) => {
    if (!selected_users.includes(user.id)) {
      let card = $("<card>", {
        class: "card bg-base-100 shadow",
        html: $("<div>", {
          class: "card-body py-6 flex gap-4 flex-row items-center",
          html: $("<img>", {
            src: `https://api.dicebear.com/6.x/initials/svg?seed=${user.email}`,
            class: "w-10 h-10 rounded",
          })
            .add(
              $("<div>", {
                class: "flex flex-col",
                html: $("<div>", {
                  class: "font-semibold",
                  text: `${user.first_name} ${user.last_name}`,
                }).add(
                  $("<p>", {
                    class: "text-sm",
                    text: `${user.email}`,
                  })
                ),
              })
            )
            .add(
              $("<button>", {
                job: "add",
                value: `${user.id}`,
                type: "button",
                class: "js-select-user !w-20 btn btn-sm btn-neutral ml-auto",
                text: "Select",
                click: function () {
                  select_user(user.id)
                  $(this).closest("card").remove()
                },
              })
            ),
        }),
      }) //end card
      $(".js-searched-users").append(card)
    }
  }) //end foreach
}

$(".js_show_user_select_modal").on("click", () => {
  searchUsers().then((users) => {
    listUsers(users)
    user_select.showModal()
  })
})

$(".js-search-btn").on("click", () => {
  searchUsers().then((users) => {
    listUsers(users)
  })
})

const select_user = (selected_user) => {
  axios.post(route("api.getUserJson"), { id: selected_user }).then((user) => {
    selected_users.push(parseInt(selected_user))
    console.log(selected_users)
    let selected_user_box = $("<button>", {
      value: selected_user,
      class:
        "js-selected-user-item btn btn-sm btn-neutral border bg-transparent hover:text-white capitilize text-base-content cursor-pointer border-neutral-300 h-max rounded-lg p-3.5 flex items-center justify-center",
      html: user.data.user_type == "invidual" ? user.data.first_name + " " + user.data.last_name : user.data.corp_name,
      click: function () {
        selected_users = selected_users.filter((value) => parseInt(value) !== parseInt(selected_user))
        console.log(selected_users)
        $(this).closest(".js-selected-user-item").remove()
        everyValidationThings()
      },
    })
    $(".js-selected-users").append(selected_user_box)
    everyValidationThings()
  })
  everyValidationThings()
}

$(function () {
  $(".js-searched-users")
    .find(".js-select-user")
    .on("click", function () {
      select_user($(this).val())
      $(this).closest("card").remove()
    })
})
//USER SEARCH END

let publicity = "public"
$(".js_event_publicity").on("click", function () {
  if ($(this).val() == "public") {
    $(".js-invite-list-section").hide()
    publicity = "public"
    $(".js-main-col").addClass("col-span-8")
    $(".js-main-col").removeClass("col-span-6")
  } else {
    publicity = "privite"
    $(".js-invite-list-section").show()
    $(".js-main-col").addClass("col-span-6")
    $(".js-main-col").removeClass("col-span-8")
  }
  everyValidationThings()
})

//[selector,!isempty]
let selectors = [
  [".js-event-title", 0],
  // [".js-event-image", 0],
  [".js-accurate-location", 0],
  [".js-event-date", 0],
  [".js-event-description", 0],
  [".js-accurate-location", 0],
  [".js_map_lng", 0],
]

selectors.forEach((selector) => {
  $(selector[0]).on("change click", function () {
    $(selector[0]).val().length == 0 ? (selector[1] = 0) : (selector[1] = 1)
    everyValidationThings()
  })
})

let is0there = true
function setIs0there() {
  for (let i = 0; i < selectors.length; i++) {
    if (selectors[i][1] == 0) {
      is0there = true
      break
    } else {
      is0there = false
    }
  }
}
let pvValidation = true
function setPvValidation() {
  if (publicity == "public") {
    pvValidation = true
  }
  if (publicity == "privite") {
    if (selected_users.length == 0) {
      pvValidation = false
    } else {
      pvValidation = true
    }
  }
}
const everyValidationThings = () => {
  setPvValidation()
  setIs0there()
  let btn_submit = $(".js-create-invite")
  let btn_submit_toolip = $(".js-create-invite-tooltip")

  if (!is0there && pvValidation) {
    btn_submit_toolip.removeClass("tooltip")
    btn_submit.prop("disabled", 0)
  } else {
    btn_submit.prop("disabled", 1)
    btn_submit_toolip.addClass("tooltip")
  }
}
everyValidationThings()

//submit event
//submit event
$(".js-create-invite-tooltip").on("click", function () {
  // create a form
  var $form = $("<form>", {
    id: "hiddenForm",
    name: "hiddenForm",
    action: route("event.store"), // ensure route function returns a valid url
    method: "post",
    style: "display: none;",
  })

  // create inputs and append them to the form
  $("<input>")
    .attr({
      type: "hidden",
      id: "_token",
      name: "_token",
      value: $('meta[name="csrf-token"]').attr("content"), // get CSRF token from meta tag
    })
    .appendTo($form)

  // create inputs and append them to the form
  $("<input>")
    .attr({
      type: "hidden",
      id: "type",
      name: "type",
      value: publicity, // ensure this variable is defined somewhere
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "title",
      name: "title",
      value: $(".js-event-title").val(),
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "image",
      name: "image",
      value: $(".js-event-image").val(),
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "content",
      name: "content",
      value: $(".js-event-description").val(),
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "time",
      name: "time",
      value: $(".js-event-date").val(),
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "lng_location",
      name: "lng_location",
      value: $(".js_map_lng").val(),
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "accurate_location",
      name: "accurate_location",
      value: $(".js-accurate-location").val(),
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "token",
      name: "token",
      value: Math.floor(Math.random() * 9e16) + 1e16,
    })
    .appendTo($form)

  $("<input>")
    .attr({
      type: "hidden",
      id: "users",
      name: "users",
      value: selected_users, // ensure this variable is defined somewhere
    })
    .appendTo($form)

  // append the form to the body
  $form.appendTo("body")

  // submit the form
  $form.trigger("submit")
})

import flatpickr from "flatpickr"
$(function () {
  var now = new Date()
  var formattedNow = now.toISOString().slice(0, 16)
  flatpickr(".js-event-date", {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: formattedNow,
    defaultDate: formattedNow,
  })
  $(".js-event-date").trigger("change")
})
