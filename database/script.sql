CREATE TABLE store_list (
    store_id INT UNSIGNED PRIMARY KEY auto_increment COMMENT '店家編號',
    store_uuid VARCHAR(5) UNIQUE NOT NULL COMMENT '店家UUID',
    store_name VARCHAR(30) COMMENT '店家名稱',
    store_address VARCHAR(50) COMMENT '店家地址',
    promo_code VARCHAR(5) COMMENT '店家優惠碼'
) COMMENT '店家清單';
CREATE TABLE store_account (
    store_id INT UNSIGNED UNIQUE NOT NULL COMMENT '商家編號',
    store_password VARCHAR(60) NOT NULL COMMENT '商家密碼',
    create_date DATE NOT NULL COMMENT '創建日期',
    FOREIGN KEY(store_id) REFERENCES store_list(store_id),
    PRIMARY KEY(store_id, store_password)
) COMMENT '店家帳號';
CREATE TABLE register_record (
    register_id INT UNSIGNED PRIMARY KEY auto_increment COMMENT '報名編號',
    parent_name VARCHAR(10) NOT NULL COMMENT '家長姓名',
    phone_num VARCHAR(16) NOT NULL COMMENT '手機號碼',
    register_time DATETIME NOT NULL comment '報名時間',
    store_uuid VARCHAR(5) NOT NULL COMMENT '店家UUID',
    FOREIGN KEY(store_uuid) REFERENCES store_list(store_uuid)
) COMMENT '報名紀錄';
CREATE TABLE employee_list (
    employee_ssn INT UNSIGNED PRIMARY KEY auto_increment COMMENT '員工編號',
    employee_name VARCHAR(30) NOT NULL COMMENT '員工姓名',
    employee_super_ssn INT UNSIGNED COMMENT '員工上級主管編號',
    FOREIGN KEY(employee_super_ssn) REFERENCES employee_list(employee_ssn)
) COMMENT '員工清單';
CREATE TABLE employee_account (
    employee_ssn INT UNSIGNED UNIQUE NOT NULL COMMENT '員工編號',
    employee_email VARCHAR(60) UNIQUE NOT NULL COMMENT '員工電子信箱',
    employee_password VARCHAR(60) NOT NULL COMMENT '員工密碼',
    FOREIGN KEY(employee_ssn) REFERENCES employee_list(employee_ssn),
    PRIMARY KEY(employee_ssn, employee_password)
) COMMENT '員工帳號';
CREATE TABLE responsible_for (
    employee_ssn INT UNSIGNED NOT NULL COMMENT '員工編號',
    store_id INT UNSIGNED UNIQUE NOT NULL COMMENT '店家編號',
    FOREIGN KEY(employee_ssn) REFERENCES employee_list(employee_ssn),
    FOREIGN KEY(store_id) REFERENCES store_list(store_id),
    PRIMARY KEY(employee_ssn, store_id)
) COMMENT '員工負責之店家';