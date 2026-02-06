<?php

class TOOLKIT
{
    public static function CompareDay($tanggalStart, $tanggalEnd)
    {
        $d1 = new DateTime($tanggalStart);
        $d2 = new DateTime($tanggalEnd);
        $interval = $d1->diff($d2);
        $days =  $interval->format('%R%a'); // +2 days
        $days = str_replace("+", "", $days);
        $days = (int)$days;
        //report maksimal 7 hari
        if ($days > 7) {
            return false;
        } else {
            return true;
        }
    }
}