let selectedInputMemberEmail = null;

// Methods
const actionOnMemberRow = (e) => {
  const target = $(e.target);
  const row = target.closest(".js_div_member_row");
  if (target.data("action") === "add") {
    const newRow = row.clone();
    newRow.find("input").val("");
    newRow.find("select").val("");
    row.after(newRow);
    target.text("-").attr("data-action", "remove");
  } else if (target.attr("data-action") === "remove") {
    row.remove();
  }
};

const selectCorporationType = () => {
  const type = $(".js_select_corporation_type").val();
  const showMembers = ["public", "group", "stock"].includes(type);
  const shareIsActive = ["public", "stock"].includes(type);
  $(".js_div_members_section").toggle(showMembers);
  $(".js_input_member_share").prop("disabled", !shareIsActive).val("");
};

const searchMember = () => {
  axios
    .get("../action/search", {
      params: {
        query: $(".js_input_search_member").val(),
      },
    })
    .then((response) => {
      $(".js_div_members_search_result").empty();
      response.data.forEach((element) => {
        const memberElement = $("<member>")
          .addClass("js_div_member_search_result flex h-max shadow rounded-xl p-4 cursor-pointer hover:bg-primary/80 hover:text-white")
          .attr("data-id", element.id)
          .append(
            $("<column>")
              .addClass("w-20")
              .append(
                $("<avatar>")
                  .addClass("w-20 h-20")
                  .append(
                    $("<img>").attr("src", element.profile_picture).addClass("rounded-full w-20 h-20 block aspect-square")
                  )
              )
          )
          .append(
            $("<column>")
              .append(
                $("<name>")
                  .addClass("font-semibold")
                  .text(element.first_name + " " + element.last_name)
              )
              .append(
                $("<wallet>")
                  .addClass("")
                  .text(element.wallet_address.slice(0, 6) + ".." + element.wallet_address.slice(-4))
              )
              .append($("<email>").text(element.email))
          );

        $(".js_div_members_search_result").append(memberElement);
      });
    })
    .catch((error) => {
      console.log(error);
    });
};

const showSearchModal = (e) => {
  $(".js_input_search_member").val("");
  $(".js_div_members_search_result").empty();
  selectedInputMemberEmail = $(e.target);
  console.log(selectedInputMemberEmail);
  $(".js_modal_search").show();
};
const closeSearchModal = (e) => {
  if ($(e.target).hasClass("js_modal_search")) {
    $(".js_modal_search").hide();
  }
};

const selectMember = (e) => {
  const member = $(e.target).closest(".js_div_member_search_result");
  selectedInputMemberEmail.val(member.find("email").text());
  $(".js_modal_search").hide();
};

// Events
const attachEvents = () => {
  selectCorporationType();
  $("html").on("click", ".js_btn_action_on_member_row", actionOnMemberRow);
  $("html").on("change", ".js_select_corporation_type", selectCorporationType);
  $("html").on("click", ".js_input_open_search_member_email", showSearchModal);
  $("html").on("click", ".js_modal_search", closeSearchModal);
  $("html").on("click", ".js_btn_search_member", searchMember);
  $("html").on("click", ".js_div_member_search_result", selectMember);
};

$(attachEvents);
