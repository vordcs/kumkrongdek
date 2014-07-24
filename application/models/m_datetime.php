<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class m_datetime extends CI_Model {

    public function monthTHtoDB($str_date_th) {
        $month_th = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        for ($i = 0; $i < count($month_th); $i++) {
            if ($month_th[$i] == $str_date_th) {
                return $i;
            }
        }
    }

}
