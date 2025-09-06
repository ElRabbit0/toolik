<?php
session_start();
$mouthToday = date('m');
$login = $_SESSION['login'];
$thisMouthFirst = array();
$thisMouthSecond = array();
$lastMouthFirst = array();
$lastMouthSecond = array();
$mysql;

function selecter($data)
{
    global $mouthToday, $thisMouthFirst, $thisMouthSecond, $lastMouthFirst, $lastMouthSecond, $mysql;
    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {

            $mouth = new DateTime($row['day']);
            $mouth = $mouth->format('m');
            $day = new DateTime($row['day']);
            $day = $day->format('d');
            settype($day, 'integer');
            settype($mouthToday, 'integer');
            settype($mouth, 'integer');
            $number = $mouthToday - $mouth;
            if ($number > 1) {
                $mysql->query("DELETE FROM `0_hours` WHERE `id` = '$row[id]';");
                continue;
            }
            if ($mouth == $mouthToday) {
                if ($day <= 15) {
                    $thisMouthFirst[] = $row['id'];
                } else {
                    $thisMouthSecond[] = $row['id'];
                }
            } else if ($mouth < $mouthToday || ($mouth == 12 && $mouthToday == 01)) {
                if ($day <= 15) {
                    $lastMouthFirst[] = $row['id'];
                } else {
                    $lastMouthSecond[] = $row['id'];
                }
            }
        }
    }
}

function render($array)
{
    $yer = date('y');
    global $mysql, $mouthToday;
    $allHours = 0;
    $allDay = 0;
    if (isset($array[0])) {
        $arrayMouth = $mysql->query("SELECT `day` FROM `0_hours` WHERE `id` = '$array[0]'");
        $arrayMouth = $arrayMouth->fetch_assoc();
        $arrayMouth = new DateTime($arrayMouth['day']);
        $arrayMouth = $arrayMouth->format('m');
        settype($arrayMouth, 'integer');
        $dayInMouth = cal_days_in_month(CAL_GREGORIAN, $arrayMouth, $yer);
        $arrayday = $mysql->query("SELECT `day` FROM `0_hours` WHERE `id` = '$array[0]'");
        $arrayday = $arrayday->fetch_assoc();
        $arrayday = new DateTime($arrayday['day']);
        $arrayday = $arrayday->format('d');
        settype($arrayday, 'integer');
        $arrayYers = $mysql->query("SELECT `day` FROM `0_hours` WHERE `id` = '$array[0]'");
        $arrayYers = $arrayYers->fetch_assoc();
        $arrayYers = new DateTime($arrayYers['day']);
        $arrayYers = $arrayYers->format('Y');
        $list = array();
        for ($i = 0; $i < count($array); $i++) {
            $value = $mysql->query("SELECT * FROM `0_hours` WHERE `id` = '$array[$i]'");
            $list[] = $value->fetch_assoc();
        }

        $toI = 0;
        $toFor = 0;
        if ($arrayday <= 15) {
            $toI = 1;
            $toFor = 15;
        } else {
            $toI = 16;
            $toFor = $dayInMouth;
        }
        for ($i = $toI; $i <= $toFor; $i++) {
            $isSet = false;
            $index = 0;
            for ($j = 0; $j < count($list); $j++) {
                $dayIn = new DateTime($list[$j]['day']);
                $dayIn = $dayIn->format('d');
                settype($dayIn, 'int');
                if ($dayIn == $i) {
                    $isSet = true;
                    $index = $j;
                    break;
                }
            }
            if ($isSet) {
                $allDay++;
                $mouth = new DateTime($list[$index]['day']);
                $mouth = $mouth->format('m');
                $day = new DateTime($list[$index]['day']);
                $day = $day->format('d');
                $date = $day . '.' . $mouth;
                $start = new DateTime($list[$index]['start']);
                $stop = new DateTime($list[$index]['stop']);
                $start = $start->format('H:i');
                $stop = $stop->format('H:i');
                $hours = $list[$index]['hours'];
                $allHours += $hours;

                $indexToDel = $list[$index]['id'];
                require 'node-fill.php';
            } else {
                $day = ($i);
                if ($day < 10) {
                    $day = 0 . $day;
                }
                $mouth = $arrayMouth;
                if ($mouth < 10) {
                    $mouth = 0 . $mouth;
                }
                $date = $day . '.' . $mouth;
                require 'node-fill.php';
            }
        }
    } else {
        echo '<p class="no">Нет данных</p>';
    }
    if ($allHours != 0) {
        $price = 0;
        $tarif = 196.24;
        $several = 0;
        $kof = 0;
        $ndfl = 0;
        $prime = 0;
        if ($arrayday <= 15) {
            $price = ($allHours * $tarif);
            $several = ($price / 100) * 30;
            $kof = ($price / 100) * 20;
            $price += $several + $kof;
            $ndfl = ceil((floor($price) / 100) * 13);
            $price = $price - $ndfl;
            $hourCounter = $allHours;
        } else {
            $price = ($allHours * $tarif);
            $kof = ($price / 100) * 20;
            $several = ($price / 100) * 30;
            $price += $several + $kof;
            $prime = $allHours * 46.72; //константа
            $price += $prime;
            $ndfl = ceil((floor($price) / 100) * 13);
            $price = $price - $ndfl;
        }
        echo "<div class='all-hours'>
        <p class='head'><b>Итог:</b> </p>
        <p><b>Дней:</b> $allDay д.</p>
        <p><b>Часы:</b> $allHours ч.</p>
        <p><b>Выплата:</b> $price р.</p>
        </div>";
    }
}

require('../node/vars.php');
$mysql = new mysqli($hostnameSQL, $usernameSQL, $passwordSQL, $databaseSQL);

$res = $mysql->query("SELECT * FROM `0_hours` WHERE `login` = '$login'");

selecter($res);



?>