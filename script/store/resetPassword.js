$(() => {
    let editState = getUrl();
    if (editState != null) {
        if (editState == "true") {
            $("#modal-success").modal("show");
        } else {
            $("#modal-error-text").html(editState);
            $("#modal-error").modal("show");
        }
    }
});

const getUrl = () => {
    let param = new URLSearchParams(window.location.search);
    return param.get("state");
};
