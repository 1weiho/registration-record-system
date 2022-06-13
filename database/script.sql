CREATE TABLE store_list (
    store_id INT UNSIGNED PRIMARY KEY auto_increment COMMENT '店家編號',
    store_uuid VARCHAR(5) UNIQUE NOT NULL COMMENT '店家UUID',
    store_name VARCHAR(30) COMMENT '店家名稱',
    store_address VARCHAR(50) COMMENT '店家地址',
    promo_code VARCHAR(5) COMMENT '店家優惠碼'
) COMMENT '店家清單';
CREATE TABLE register_record (
    register_id INT UNSIGNED PRIMARY KEY auto_increment COMMENT '報名編號',
    parent_name VARCHAR(10) NOT NULL COMMENT '家長姓名',
    phone_num VARCHAR(16) NOT NULL COMMENT '手機號碼',
    register_time DATETIME NOT NULL comment '報名時間',
    store_uuid VARCHAR(5) NOT NULL COMMENT '店家UUID',
    FOREIGN KEY(store_uuid) REFERENCES store_list(store_uuid)
) COMMENT '報名紀錄';
CREATE TABLE store_account (
    store_id INT UNSIGNED UNIQUE NOT NULL COMMENT '商家編號',
    store_password VARCHAR(60) NOT NULL COMMENT '商家密碼',
    FOREIGN KEY(store_id) REFERENCES store_list(store_id),
    PRIMARY KEY(store_id, store_password)
) COMMENT '店家帳號';