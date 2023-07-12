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
        "js-selected-user-item btn btn-sm btn-neutral border bg-transparent hover:text-white capitilize text-base-content cursor-pointer border-neutral-300 h-max  p-3.5  rounded-lg flex items-center justify-center",
      html: user.data.user_type == "invidual" ? user.data.first_name + " " + user.data.last_name : user.data.corp_name,
      click: function () {
        selected_users = selected_users.filter((value) => parseInt(value) !== parseInt(selected_user))
        console.log(selected_users)
        $(this).closest(".js-selected-user-item").remove()
      },
    })
    $(".js-selected-users").append(selected_user_box)
  })
}

$(function () {
  $(".js-searched-users")
    .find(".js-select-user")
    .on("click", function () {
      select_user($(this).val())
      $(this).closest("card").remove()
    })
})

function ballot_users_to_input() {
  $(".js-ballot-user-inputs").empty()
  $(document)
    .find(".js-selected-user-item")
    .each(function () {
      console.log($(this).val())
      let ballot_user_input = $("<input>", {
        class: "ballot_user_input",
        value: $(this).val(),
        name: "candidates[]",
      })
      $(".js-ballot-user-inputs").append(ballot_user_input)
    })
}
$(".js-btn-submit").on("click", function (e) {
  e.preventDefault()
  ballot_users_to_input()
  $("#ballotForm").trigger("submit")
})

import flatpickr from "flatpickr"
var now = new Date()
now.setDate(now.getDate() + 1)
var formattedNow = now.toISOString().slice(0, 16)
flatpickr('input[type="datetime-local"]', {
  enableTime: true,
  dateFormat: "Y-m-d H:i",
  minDate: formattedNow,
  defaultDate: formattedNow,
})

import validate from "jquery-validation"

$(function () {
  var validator = $("#ballotForm").validate({
    rules: {
      title: {
        required: true,
        minlength: 5,
      },
      description: {
        required: true,
        minlength: 20,
      },
      options: {
        required: true,
      },
      ending_date: {
        required: true,
      },
    },
    messages: {
      title: {
        required: "ballot title must be at least 5 characters long",
        minlength: "ballot username must be at least 5 characters long",
      },
      description: {
        required: "ballot description must be at least 20 characters long",
        minlength: "ballot username must be at least 20 characters long",
      },
      options: {
        required: "ballot options is required",
      },
      ending_date: {
        required: "ballot ending date is required",
      },
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
      error.addClass("text-sm text-red-500")
      $(element).after(error)
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("border-red-500 JS_INVALID")
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("border-red-500 JS_INVALID")
    },
    submitHandler: function (form) {
      form.submit()
    },
  })

  $("input , textarea, select").on("keyup change", function () {
    $(this).valid() // validate this field only
  })

  $("input , textarea, select").on("keyup change", function () {
    if ($("#ballotForm").find(".JS_INVALID").length === 0) {
      $(".js-btn-submit").prop("disabled", false)
    } else {
      $(".js-btn-submit").prop("disabled", "disabled")
    }
  })
})
