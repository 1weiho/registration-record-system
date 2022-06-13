$(() => {
    $("#next-btn").click(() => {
        $("#modal").modal("show");
    });
    $("#modal-submit-btn").click(() => {
        $("#submit-btn").click();
    });
    $("#form").on("keyup keypress", function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
});
