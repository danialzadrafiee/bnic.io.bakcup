$(function () {


    $(".js_btn_open_publicity_modal").on("click", () => {
        modal_publicity_edit.showModal();
    });

    $(".js-btn-publicity-submit").on("click", () => {
        let form = $("<form>").append($(".js-publicity-toggle").clone());
        let data = form.serialize();


        axios.post(route("api.update_publicity"), data)
            .then((response) => {
                window.location.reload();
            });
    });
});
