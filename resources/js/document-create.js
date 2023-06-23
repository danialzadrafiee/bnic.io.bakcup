import Sortable from "sortablejs/modular/sortable.complete.esm.js";
import { log } from "util";

const formElements = document.getElementById("form-elements");
const formCreator = document.getElementById("form-creator");
const addRowButton = document.getElementById("add-row");

const formElementsSortable = Sortable.create(formElements, {
  group: {
    name: "shared",
    pull: "clone",
  },
  animation: 150,
  onAdd: function (evt) {
    if (evt.from !== formElements) {
      evt.item.parentNode.removeChild(evt.item);
    }
  },
});

const addRowButtonCols1 = document.getElementById("add-row-cols-1");
const addRowButtonCols2 = document.getElementById("add-row-cols-2");

// ...

// Create a function to handle row creation
function addRow(columns) {
  const newRow = document.createElement("div");
  newRow.classList.add("js-row", "grid", "border", "gap-2", "min-h-[40px]", "relative", "my-2");
  newRow.classList.add(columns === 1 ? "grid-cols-1" : "grid-cols-2");
  formCreator.querySelector(".flex").appendChild(newRow);

  const deleteButton = document.createElement("button");
  deleteButton.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "px-2", "py-1", "rounded");
  deleteButton.textContent = "X";
  newRow.appendChild(deleteButton);

  deleteButton.addEventListener("click", () => {
    newRow.remove();
  });

  let fieldCounter = 0;
  Sortable.create(newRow, {
    group: {
      name: "shared",
    },
    animation: 150,
    onAdd: function (evt) {
      fieldCounter++;
      evt.item.setAttribute("data-field-id", `f_${fieldCounter}`);
      // If the item is dragged from the form-creator to the form-elements container, remove it from the form-elements container
      if (evt.to === formElements) {
        evt.item.parentNode.removeChild(evt.item);
      } else {
        {
          // Remove the 'readonly' attribute from the cloned input elements
          const inputElements = evt.item.querySelectorAll("input, textarea, publicity,div");
          inputElements.forEach((input) => {
            input.removeAttribute("readonly");
          });

          // Set the 'contenteditable' attribute to 'true' for the cloned heading and paragraph elements
          const editableElements = evt.item.querySelectorAll(".js-editable-element");
          editableElements.forEach((element) => {
            element.setAttribute("contenteditable", "true");
          });
        }
      }

      const setNameElement = evt.item.querySelector(".set-name");
      if (setNameElement) {
        setNameElement.classList.remove("hidden");
      }

      const setPublicityElement = evt.item.querySelector(".set-publicity");
      if (setPublicityElement) {
        setPublicityElement.classList.remove("hidden");
      }

      const itemCount = newRow.getElementsByClassName("js-element").length;

      // Check the type of the element and update the default name accordingly
      if (evt.item.querySelector("input[type='text']") && evt.item.querySelector("input[type='text']").id === "text") {
        evt.item.querySelector("input[type='text']").name = `text-field-${inputCounter}`;
        evt.item.querySelector("input[type='text']").placeholder = `text-field-${inputCounter}`;
        evt.item.querySelector(".set-name").value = `text-field-${inputCounter}`;

        inputCounter++;
      } else if (evt.item.querySelector("textarea")) {
        evt.item.querySelector("textarea").name = `text-area-${textareaCounter}`;
        evt.item.querySelector("textarea").placeholder = `text-area-${textareaCounter}`;
        evt.item.querySelector(".set-name").value = `text-area-${textareaCounter}`;
        textareaCounter++;
      }
    },
  });
}

// Add event listeners for both buttons
addRowButtonCols1.addEventListener("click", () => addRow(1));
addRowButtonCols2.addEventListener("click", () => addRow(2));

// Initialize the first row as a 1-column row
addRowButtonCols1.click();

let inputCounter = 1;
let textareaCounter = 1;

document.addEventListener("input", (event) => {
  if (event.target.matches(".set-name")) {
    const element = event.target.previousElementSibling;
    const newName = event.target.value;

    if (newName.trim() !== "") {
      element.name = newName.trim();
      element.placeholder = newName.trim();
    }
  }
});

function cleanFormContent(content) {
  const parsedHtml = $("<div>").html(content);

  parsedHtml.find(".set-name, [contenteditable], [draggable], [style], .bg-red-500, .js-remlunch").each(function () {
    if ($(this).is("[contenteditable]")) $(this).removeAttr("contenteditable");
    if ($(this).is("[draggable]")) $(this).removeAttr("draggable");
    if ($(this).is("[style]")) $(this).removeAttr("style");
    if ($(this).hasClass("bg-red-500")) $(this).remove();
    if ($(this).hasClass("set-name")) $(this).remove();
    if ($(this).hasClass("js-remlunch")) $(this).remove();
    if ($(this).hasClass("my-2")) $(this).removeClass("my-2");
  });

  parsedHtml.find(".border").each(function () {
    $(this).removeClass("border");
  });

  return parsedHtml.html();
}

//personal code
window.publicity_deactive = false;
$(".js-publicity-check").on("change", function () {
  (publicity_deactive = !$(this).is(":checked")),
    $("html")
      .find("publicity")
      .each(function () {
        !publicity_deactive ? $(this).removeClass("force_hidden") : $(this).addClass("force_hidden");
      });
});

window.valid_flag = [true];
valid_flag[1] = false;
console.log(valid_flag);

$("#submit-form").on("click", function () {
  const formCreatorContent = formCreator.innerHTML;
  let cleanFormCreatorContent = cleanFormContent(formCreatorContent);
  $.ajax({
    url: route("document.store"),
    type: "POST",
    data: {
      reciver: $(".js-input-email").val(),
      name: $('[name="name"]').val(),
      description: $('[name="description"]').val(),
      content: cleanFormCreatorContent,
      _token: document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    },
    success: function (response) {
      console.log(response);
      window.location.href = route("dashboard.index");
    },
  });
});

var eventsList = [
  "click",
  "dblclick",
  "mousedown",
  "mousemove",
  "mouseout",
  "mouseover",
  "mouseup",
  "keydown",
  "keyup",
  "keypress",
  "change",
  "focus",
  "blur",
  "load",
  "unload",
  "beforeunload",
  "resize",
  "move",
  "DOMContentLoaded",
  "readystatechange",
  "error",
  "abort",
  "scroll",
];
eventsList.forEach(function (eventType) {
  $("html").on(eventType, function () {
    if ($(".js-form-creator").find("p, h3, input, textarea").length == 0) {
      valid_flag[0] = false;
    } else {
      valid_flag[0] = true;
    }

    // TODO Check kone bebine ticke publicity sevom shakhs khorde asan yana bad sharto bezare

    var emptyExists = false;
    $(".js-form-creator .set-publicity").each(function () {
      if ($(this).find('input[type="checkbox"]:checked').length == 0) {
        emptyExists = true;
        return false;
      }
    });

    if (emptyExists && !publicity_deactive) {
      valid_flag[1] = false;
    } else {
      valid_flag[1] = true;
    }

    $(".set-name").each(function () {
      var setNameValue = $(this).val();
      if (setNameValue.trim() == "") {
        valid_flag[2] = false;
      } else {
        valid_flag[2] = true;
      }
    });

    var allTrue = valid_flag.every(function (element) {
      return element === true;
    });
    if (allTrue) {
      $("#submit-form").removeClass("bg-opacity-40").prop("disabled", false);
    } else {
      $("#submit-form").addClass("bg-opacity-40").prop("disabled", true);
    }
  });
});

$("html").on("change", ".js-publicity-checkbox", function () {
  if ($(this).val() == "creator") {
    $(this).parents("field").attr("data-publicity-creator", $(this).prop("checked"));
  }
  if ($(this).val() == "reciver") {
    $(this).parents("field").attr("data-publicity-reciver", $(this).prop("checked"));
  }
});

//searchUser begin
let template = $(".js-row-user").first();

$(".js-btn-search").on("click", function () {
  let query = $(".js-input-search").val();
  $(".js-section-search-result").empty();

  function getEmailHash(email, callback) {
    const encoder = new TextEncoder();
    const data = encoder.encode(email);
    crypto.subtle.digest("SHA-256", data).then((hashBuffer) => {
      const hashArray = Array.from(new Uint8Array(hashBuffer));
      const hashHex = hashArray.map((b) => b.toString(16).padStart(2, "0")).join("");
      callback(hashHex);
    });
  }
  axios
    .get(`${route("actions.search_invi_by_name")}?query=${query}`)
    .then(function (response) {
      let data = response.data;
      console.log(data);
      if (data.length > 0) {
        data.forEach((element) => {
          getEmailHash(element.email, function (emailHash) {
            let clone = template.clone(); // Create a new clone for each element
            clone.find(".js-search-user-first-name").text(element.first_name);
            clone.find(".js-search-user-last-name").text(element.last_name);
            clone.find(".js-search-user-email").text(element.email);
            clone.find(".js-search-user-wallet").val(element.wallet);
            clone.find(".js-search-user-image").attr("src", `https://api.dicebear.com/6.x/identicon/svg?seed=${element.email}`);
            clone.find(".js-search-user-code").html(`${element.gender[0]}-${emailHash.substr(0, 8)}-${element.id}`);
            clone
              .find(".js-search-user-cv")
              .html(
                element.cv.replace(/<\/?[^>]+(>|$)/g, "").length > 90
                  ? element.cv.replace(/<\/?[^>]+(>|$)/g, "").substring(0, 90) + ".."
                  : element.cv.replace(/<\/?[^>]+(>|$)/g, "")
              );
            $(".js-section-search-result").append(clone);
          });
        });
      } else {
        $(".js-section-search-result").append('<p class="text-center">No se encontraron resultados</p>');
      }
    })
    .catch(function (error) {
      console.log(error);
    });
});
$(".js-modal-select-user").on("click", function (event) {
  if (event.target.tagName === "MODAL") {
    $(this).hide();
  }
});

let selected_email = null;
$("body").on("click", ".js-input-email", function () {
  selected_email = $(this);
  $(".js-modal-select-user").show();
});
$("body").on("click", ".js-btn-select-user", function () {
  selected_email.val($(this).data("email"));
  $(".js-modal-select-user").hide();
});
//searchUser end
