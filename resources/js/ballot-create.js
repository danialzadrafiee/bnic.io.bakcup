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
            src: `https://api.dicebear.com/6.x/shapes/svg?seed=${user.email}`,
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
