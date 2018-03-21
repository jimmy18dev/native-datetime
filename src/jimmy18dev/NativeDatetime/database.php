<?php
namespace jimmy18dev\NativeDatetime;

class NativeDatetime{

    public static function dformat($datetime,$option = 'shortdate'){

        if(empty($datetime)) return null;

        $timestamp  = strtotime($datetime);
        $diff       = time() - $timestamp;
        $hour       = date('H',strtotime($datetime));
        $minute     = date("i",strtotime($datetime));
        $year       = date('Y',strtotime($datetime));
        $month      = date('n',strtotime($datetime));
        $date       = date('j',strtotime($datetime));

        $monthText = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
        $monthFullText = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');

        switch ($option) {
            case 'timestamp':
                $str = $timestamp;
                break;
            case 'fulldatetime':
                $str = $date.' '.$monthFullText[$month-1].' '.($year+543).' เวลา '.$hour.':'.$minute.' น.';
                break;
            case 'fulldate':
                $str = $date.' '.$monthFullText[$month-1].' '.($year+543);
                break;
            case 'shortdatetime':
                $str = $date.' '.$monthText[$month-1].' '.($year+543).' เวลา '.$hour.':'.$minute.' น.';
                break;
            case 'shortdate':
                $str = $date.' '.$monthText[$month-1].' '.($year+543);
                break;
            case 'topicdate':
                $diff = time() - $timestamp;
                if($diff < 86400){
                    $str = 'วันนี้';
                }else if($diff < (86400*2)){
                    $str = 'เมื่อวานนี้';
                }else{
                    if($year == date('Y')){
                        $str = $date.' '.$monthFullText[$month-1];
                    }else{
                        $str = $date.' '.$monthFullText[$month-1].' '.($year+543);
                    }
                }
                break;
            case 'facebook':
                $diff       = time() - $timestamp;
                $periods    = array('วินาที','นาที','ชั่วโมง');
                $words      = 'ที่แล้ว';

                if($diff < 10){
                    $text   = "เมื่อสักครู่";
                }
                else if($diff < 60){
                    $i      = 0;
                    $diff   = ($diff == 1)?"":$diff;
                    $text   = "$diff $periods[$i]$words";
                }
                else if($diff < 3600){
                    $i      = 1;
                    $diff   = round($diff/60);
                    // $diff   = ($diff == 3 || $diff == 4)?"":$diff;
                    $text   = "$diff $periods[$i]$words";
                }
                else if($diff < 86400){
                    // 1 Day
                    $i      = 2;
                    $diff   = round($diff/3600);
                    $diff   = ($diff != 1)?$diff:"" . $diff ;
                    $text   = "$diff $periods[$i]$words";
                }
                else if($diff < 432000){
                    // 5 Day
                    $diff   = round($diff/86400);
                    $text   = $diff.' วันที่แล้ว';
                }
                else{
                    $monthText = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');

                    $date   = date("j", $timestamp);
                    $month  = $monthText[date("m", $timestamp)-1];
                    $y      = (date("Y", $timestamp)+543)-2500;
                    $t1     = "$date  $month";
                    $t2     = "$date  $month  $y";

                    // if($timestamp < strtotime(date("Y-01-01 00:00:00"))){
                    //     $text = $t2;
                    // }
                    // else{
                    //     $text = $t1;
                    // }

                    $text = $t2;
                }
                $str = $text;

                break;
            default:
                break;
        }

        return $str;
    }
}
?>
