$(() => {
    let editState = getUrl();
    if (editState != null) {
        $("#modal-text").html(editState);
        $("#modal-error").modal("show");
    }
});

const getUrl = () => {
    let param = new URLSearchParams(window.location.search);
    return param.get("state");
};
