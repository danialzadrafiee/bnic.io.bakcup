import * as FilePond from "filepond"
import FilePondPluginFilePoster from "filepond-plugin-file-poster"
import FilePondPluginImageEditor from "@pqina/filepond-plugin-image-editor"
import FilePondPluginImagePreview from "filepond-plugin-image-preview"
import FilePondPluginPdfPreview from "filepond-plugin-pdf-preview"
import { openEditor, createDefaultImageReader, createDefaultImageWriter, processImage, getEditorDefaults } from "@pqina/pintura"
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"

// Register the plugins with FilePond
FilePond.registerPlugin(FilePondPluginImageEditor, FilePondPluginFilePoster, FilePondPluginImagePreview, FilePondPluginPdfPreview)

const inputElement = document.querySelector('input[type="file"]')

const pond = FilePond.create(inputElement, {
  allowReorder: true,
  filePosterMaxHeight: 256,

  imageEditor: {
    createEditor: openEditor,
    imageReader: [createDefaultImageReader],
    imageWriter: [
      createDefaultImageWriter,
      {
        targetSize: {
          width: 384,
        },
      },
    ],
    imageProcessor: processImage,
    editorOptions: {
      ...getEditorDefaults(),
      imageCropAspectRatio: 1,
    },
  },

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
  $(".js-event-image").val(response.id)
  console.log(response.id)
})

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

    let selected_user_box = $("<button>", {
      value: selected_user,
      class:
        "js-selected-user-item btn btn-sm btn-neutral border bg-transparent hover:text-white capitilize text-base-content cursor-pointer border-neutral-300 h-max rounded-lg p-3.5 flex items-center justify-center",
      html: user.data.user_type == "invidual" ? user.data.first_name + " " + user.data.last_name : user.data.corp_name,
      click: function () {
        selected_users = selected_users.filter((value) => parseInt(value) !== parseInt(selected_user))
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
let publicity = "public"
$(".js_event_publicity").on("click", function () {
  if (this.value == "public") {
    $(".js-invite-list-section").hide()
    publicity = "public"
    $(".js-main-col").toggleClass(["col-span-6", "col-span-8"])
  } else {
    publicity = "privite"
    $(".js-invite-list-section").show()
    $(".js-main-col").toggleClass(["col-span-6", "col-span-8"])
  }
})

let selectors = [".js-event-title", ".js-event-image", ".js-accurate-location", ".js-end-date", "js-event-description", ".js-accurate-location"]

let title = $(".js-event-title").val()
let image = $(".js-event-image").val()
let accurate_location = $(".js-accurate-location").val()
let invited_users = selected_users
let end_date = $(".js-end-date").val()

selectors.forEach((selector) => {
  $(selector).on("change", function () {
    console.log(selector + ":" + $(selector).val().length)
  })
})

$(".js-create-invite").prop("disabled", true)
$(".js-create-invite").on("click", function () {})
$("*").on("keyup keydown keypress change", function () {
  title = $(".js-event-title").val()
  image = $(".js-event-image").val()
  accurate_location = $(".js-accurate-location").val()
  invited_users = selected_users
  end_date = $(".js-end-date").val()
  //   console.log(end_date.length > 0)
  //   console.log(invited_users.length > 0)
  //   console.log(accurate_location.length > 0)
  //   console.log(title.length > 0)
  //   console.log(image.length > 0)
  //   console.log(map_lng.length > 0)
  //  && invited_users.length
  if (end_date.length > 0 && accurate_location.length > 0 && title.length > 0 && image.length > 0 && accurate_location.length > 0 && map_lng.length > 0) {
    $(".js-create-invite").prop("disabled", false)
  } else {
    $(".js-create-invite").prop("disabled", true)
  }
})
