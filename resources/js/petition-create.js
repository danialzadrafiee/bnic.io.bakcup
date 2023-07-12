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
  var validator = $("#petitionForm").validate({
    rules: {
      title: {
        required: true,
        minlength: 5,
      },
      hashtag: {
        required: true,
        minlength: 5,
      },
      content: {
        required: true,
        minlength: 20,
      },
    },
    messages: {
      title: {
        required: "Title must be at least 5 characters long",
        minlength: "Title must be at least 5 characters long",
      },
      hashtag: {
        required: "Describe must be at least 5 characters long",
        minlength: "Describe must be at least 5 characters long",
      },
      content: {
        required: "Content must be at least 20 characters long",
        minlength: "Content must be at least 20 characters long",
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

  $("input , textarea").on("keyup change", function () {
    $(this).valid() // validate this field only
  })

  $("input , textarea").on("keyup change", function () {
    if ($("#petitionForm").find(".JS_INVALID").length === 0) {
      $(".js_btn_submit").prop("disabled", false)
    } else {
      $(".js_btn_submit").prop("disabled", "disabled")
    }
  })
})
