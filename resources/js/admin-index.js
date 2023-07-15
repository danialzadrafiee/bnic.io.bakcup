$(".js_is_admin").on("change", function () {
  let isAdmin = $(this).prop("checked") ? 1 : 0
  axios
    .post(route("admin.userUpdate"), {
      user_id: $(this).attr("user_id"),
      isAdmin,
    })
    .then((r) => {
      console.log(r.status, r.data)
    })
})
$(".is_fee_paid").on("change", function () {
  let isAdmin = $(this).prop("checked") ? 1 : 0
  axios
    .post(route("admin.userUpdate"), {
      user_id: $(this).attr("user_id"),
      isAdmin,
      inviter_email: "info@bnic.io",
    })
    .then((r) => {
      console.log(r.data)
    })
})
$("tbody td").on("click", function () {
  if ($(this).text() == "*****") return false

  let button = $("<button>", {
    class: "btn btn-xs block btn-success",
    text: "Save",
    contentEditable: false,
    user_id: $(this).attr("user_id"),
    click: function () {
      let user_id = $(this).closest("tr").attr("user_id")
      let td_for = $(this).parent("td").attr("for")
      let td_text = $(this).parent("td").text().replace("Save", "")
      let data = {}
      data["user_id"] = user_id
      data[td_for] = td_text
      console.log(data)
      axios.post(route("admin.userUpdate"), data).then((r) => console.log(r))
    },
  })

  if ($(this).attr("data_readonly") != "1") {
    $(this).attr("contentEditable", true)

    if ($(this).find("button").length == 0) {
      $("td").find("button").remove()
      $(this).append(button)
    }
  }
})
