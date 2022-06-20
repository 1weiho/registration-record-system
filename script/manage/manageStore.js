$(() => {
    getStore();
});

const getStore = () => {
    $.ajax({
        url: "../backend/manage/getStore.php",
        method: "POST",
        success: (res) => {
            if (res) {
                res.forEach((element) => {
                    displayStore(element);
                });
                displayStoreCount(res.length);
            } else {
                displayStoreCount(0);
            }
        },
    });
};

const displayStore = (data) => {
    let html = `
    <div class="card m-4 p-3" onclick="viewStore(${data["store_id"]});">
        <h2>${data["store_name"]}</h2>
        報名人數：${data["register_count"]} 人<br>
        店家地址：${data["store_address"]}<br>
        優惠碼：${data["promo_code"]}<br>
        平均報名人數：${data["average_count"]} 人 / 每日<br>
        開始日期：${data["create_date"]}<br>
    </div>
    `;
    $("#store-area").prepend(html);
};

const displayStoreCount = (data) => {
    $("#record-count").html(data);
};

const viewStore = (store_id) => {
    let url = `viewStore.php?id=${store_id}`;
    window.location = url;
};
