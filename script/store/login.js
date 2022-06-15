$(() => {
    let loginState = getUrl();
    if (loginState) {
        $("#modal-text").html(loginState);
        $("#modal-error").modal("show");
    }
});

const getUrl = () => {
    let param = new URLSearchParams(window.location.search);
    return param.get("error");
};
