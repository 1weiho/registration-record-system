<?php

require_once __DIR__ . "/../model/model.php";

class promoCode extends Model {
    public function getPromoCode($store_uuid) {
        $sql = $this->select('store_list', ['promo_code']) . $this->where('store_uuid', '=', $store_uuid);
        $result = $this->execute($sql);
        return $result;
    }
}
