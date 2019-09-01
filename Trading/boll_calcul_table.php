<?php

/**
 * IMPORTANT VALUES WHICH COULD BE CHANGED
 */
echo $modulo . "<br />";
    $num = 360;
    $size = 20;

//clean la table de
$delete = "DELETE FROM `" . DB_PREFIX . "bitcoin_bollinger`";
$deleted = mysqli_query($conn, $delete);

$create_table = "CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "bitcoin_bollinger (ix INT NOT NULL, id INT PRIMARY KEY NOT NULL, closed_price TEXT NOT NULL, date TEXT NOT NULL, ecart_type TEXT DEFAULT NULL, mobile_average TEXT DEFAULT NULL, minus_2 TEXT DEFAULT NULL, plus_2 TEXT DEFAULT NULL, delta TEXT DEFAULT NULL, mobile_average_delta TEXT DEFAULT NULL, ref_type_delta TEXT DEFAULT NULL, diff_mm_et_delta TEXT DEFAULT NULL, analyze_phase TEXT DEFAULT NULL)";
$is_created = mysqli_query($conn, $create_table);
echo $create_table;

$ix = 0;
$index = 0;
$query = "SELECT * FROM `" . DB_PREFIX . "bitcoin_value` ORDER BY `id` DESC LIMIT " . ($num * 2 - $size) * $modulo;
echo $query;
$result = mysqli_query($conn, $query);
if (num_bollinger_for_id($conn) == 1)
{
    while ($assoc = mysqli_fetch_assoc($result)) 
    {
        if ($index % $modulo == 0)
        {
            $close = explode(";", $assoc['last_trade_closed']);
            $insert = "INSERT INTO `" . DB_PREFIX . "bitcoin_bollinger` (ix, id, closed_price, date)
            VALUES (" . $ix . ", " . $assoc['id'] . ", '" . floatval($close[0]) . "', '" . $assoc['date'] . "')";
            $inserted = mysqli_query($conn, $insert);
            $ix++;
        }
        $index = $index + 1;
    }
}
else
{
    while ($assoc = mysqli_fetch_assoc($result)) 
    {
        if ($index % $modulo == 0)
        {
            $close = explode(";", $assoc['last_trade_closed']);
            $id_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `id` = '" . $assoc['id'] . "' WHERE `ix` = " . $ix;
            $idupdated = mysqli_query($conn, $id_update);
            $cp_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `closed_price` = '" . floatval($close[0]) . "' WHERE `ix` = " . $ix;
            $cpupdated = mysqli_query($conn, $cp_update);
            $dt_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `date` = '" .  $assoc['date'] . "' WHERE `ix` = " . $ix;
            $dtupdated = mysqli_query($conn, $dt_update);
            $ix ++;
        }
        $index = $index + 1;
    }
}
//cas n1 : closed_price 0 au départ => closed price vaut la prochaine valeur
$case1 = "SELECT * FROM `" . DB_PREFIX . "bitcoin_bollinger` ORDER BY `id`";
$res_case1 = mysqli_query($conn, $case1);
$ass_case1 = mysqli_fetch_assoc($res_case1);
$id_zero = $ass_case1['id'];
if ($ass_case1['closed_price'] == "0")
{
    while ($ass_case1 = mysqli_fetch_assoc($res_case1))
    {
        if ($ass_case1['closed_price'] != 0)
        {
            break;
        }
    }
    $replace_first_zero = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `closed_price`='" . $ass_case1['closed_price'] . "' WHERE `id` = '" . $id_zero . "'";
    $res_replace = mysqli_query($conn, $replace_first_zero);
}
    
//cas n2 : closed_price = 0 n'importe ou dans la table => remplacer par la derniere valeur connue (précédente)
$res_case2 = mysqli_query($conn, $case1);
$ass_case2 = mysqli_fetch_assoc($res_case2);
$closed_zero = $ass_case2['closed_price'];
while ($ass_case2 = mysqli_fetch_assoc($res_case2))
{
    $id_zero = $ass_case2['id'];
    if ($ass_case2['closed_price'] == "0")
    {
        $replace_zero = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `closed_price`='" . $closed_zero . "' WHERE `id` = '" . $id_zero . "'";
        echo $replace_zero;
        $res_replace = mysqli_query($conn, $replace_zero);
    }
    else
    {
        $closed_zero = $ass_case2['closed_price'];
    }
}

//create array from the table for calculzzz
$res_calc = mysqli_query($conn, $case1);
$arr_calc = array();
$index = 0;
while ($ass_calc = mysqli_fetch_assoc($res_calc))
{
    $arr_calc[$index] = array();
    $arr_calc[$index]['id'] = $ass_calc['id'];
    $arr_calc[$index]['closed_price'] = $ass_calc['closed_price'];
    $index = $index + 1;
}
$arr_calc[$index] = "END_DEV";

//updates dans la base
$index = $size;
while ($arr_calc[$index] != "END_DEV")
{
    $arr_calc[$index]['mobile_average'] = mobile_average($arr_calc, $index, $size, 'closed_price');
    $average = $arr_calc[$index]['mobile_average'];
    $arr_calc[$index]['ecart_type'] = ecart_type($arr_calc, $index, $size, $average, 'closed_price');
    $ecart_type = $arr_calc[$index]['ecart_type'];
    $mm_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `mobile_average`='" . $arr_calc[$index]['mobile_average'] . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
    $mm_result = mysqli_query($conn, $mm_update);
    $et_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `ecart_type`='" . $arr_calc[$index]['ecart_type'] . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
    $et_result = mysqli_query($conn, $et_update);
    $minus_2 = $average - 2 * $ecart_type;
    $arr_calc[$index]['minus_2'] = $minus_2;
    $m2_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `minus_2`='" . $minus_2 . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
    $m2_result = mysqli_query($conn, $m2_update);
    $plus_2 = $average + 2 * $ecart_type;
    $arr_calc[$index]['plus_2'] = $plus_2;    
    $p2_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `plus_2`='" . $plus_2 . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
    $p2_result = mysqli_query($conn, $p2_update);
    $arr_calc[$index]['delta'] = $plus_2 - $minus_2;
    $delta_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `delta`='" . $arr_calc[$index]['delta'] . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
    $delta_result = mysqli_query($conn, $delta_update);
    if ($index >= $size * 2)
    {
        $arr_calc[$index]['mobile_average_delta'] = mobile_average($arr_calc, $index, $size, 'delta');
        $mm_delta_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `mobile_average_delta`='" . $arr_calc[$index]['mobile_average_delta'] . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
        $mm_delta_result = mysqli_query($conn, $mm_delta_update);
        $arr_calc[$index]['diff_mm_et_delta'] = $arr_calc[$index]['mobile_average_delta'] - $arr_calc[$index]['delta'];
        $dd_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `diff_mm_et_delta`='" . $arr_calc[$index]['diff_mm_et_delta'] . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
        $dd_result = mysqli_query($conn, $dd_update);    
    }
    $index += 1;
}


$index = $num;
while ($arr_calc[$index] != "END_DEV")
{
    $da = mobile_average($arr_calc, $index, $num - $size, 'delta');
    $et = ecart_type($arr_calc, $index, $num - $size, $da, 'delta');
    $arr_calc[$index]['ref_type_delta'] = $et;
    $da_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `ref_type_delta`='" . $et . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
    $da_result = mysqli_query($conn, $da_update);
    $arr_calc[$index]['analyze_phase'] = analyze_delta($arr_calc, $index);
    $ap_update = "UPDATE `" . DB_PREFIX . "bitcoin_bollinger` SET `analyze_phase`='" . $arr_calc[$index]['analyze_phase'] . "' WHERE `id` = '" . $arr_calc[$index]['id'] . "'";
    $ap_result = mysqli_query($conn, $ap_update);
    $index ++;
}


//table statement updates

$actual_state  = "SELECT * FROM `" . DB_PREFIX . "bitcoin_statement`";
$actual = mysqli_query($conn, $actual_state);
$act_statement = mysqli_fetch_assoc($actual);

$ac_tb = $modulo . "_min";

print_r2($act_statement);


//analyze actual bitcoin evolution
$analyze_statement = "SELECT * FROM `" . DB_PREFIX . "bitcoin_bollinger` LIMIT " . $size;
$statement = mysqli_query($conn, $analyze_statement);
$stat = mysqli_fetch_assoc($statement);
$stat_1 = mysqli_fetch_assoc($statement);

echo "<br/> s = " . $stat['analyze_phase'] . " s-1 = " . $stat_1['analyze_phase'];

//fin de bulle
if ($act_statement[$ac_tb] == "bulle+asc+wait+max" || $act_statement[$ac_tb] == "bulle+dsc+wait+min" || $act_statement[$ac_tb] == "bulle+asc+max" || $act_statement[$ac_tb] == "bulle+dsc+min")
{
    $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='bulle+end' WHERE study='bollinger'";
    $st_updated = mysqli_query($conn, $st_update);
    echo $st_update;
    $msg = $ac_tb . " : bulle end from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
}

//en plein dans une bulle
if ($act_statement[$ac_tb] == "bulle+asc+min")
{
    $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='bulle+asc+wait' WHERE study='bollinger'";
    $st_updated = mysqli_query($conn, $st_update);
    echo $st_update;
    $msg = $ac_tb . " : bulle wait from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
}
if ($act_statement[$ac_tb] == "bulle+dsc+max")
{
    $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='bulle+dsc+wait' WHERE study='bollinger'";
    $st_updated = mysqli_query($conn, $st_update);
    echo $st_update;
    $msg = $ac_tb . " : bulle wait from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
}
//quelle etape de bulle ?
if ($act_statement[$ac_tb] == "bulle+asc" || $act_statement[$ac_tb] == "bulle+dsc+wait")
{
    if ($stat_1['minus_2'] <= $stat['minus_2'])
    {
        $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='" . $act_statement[$ac_tb] . "+min' WHERE study='bollinger'";
        $st_updated = mysqli_query($conn, $st_update);
        echo $st_update;
        $msg = $ac_tb . " : bulle min from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
    }
}
if ($act_statement[$ac_tb] == "bulle+dsc" || $act_statement[$ac_tb] == "bulle+asc+wait")
{
    if ($stat_1['plus_2'] >= $stat['plus_2'])
    {
        $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='" . $act_statement[$ac_tb] . "+max' WHERE study='bollinger'";
        $st_updated = mysqli_query($conn, $st_update);
        echo $st_update;
        $msg = $ac_tb . " : bulle max from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
    }
}


//when normal et +
if (strncmp($stat['analyze_phase'], "normal", 6) == 0)
{
    if ($act_statement[$ac_tb] == "constant" && strpos($stat['analyze_phase'], "+"))
    {
        $var = (strpos($stat['analyze_phase'], "+min") !== false) ? "+min" : "+max";
        $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='constant" . $var . "' WHERE study='bollinger'";
        $st_updated = mysqli_query($conn, $st_update);
        echo $st_update;
        $msg = $ac_tb . " : constant " . $var . " from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
    }
    if ($act_statement[$ac_tb] == "couloir" || $act_statement[$ac_tb] == "bulle+end")
    {
        $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='constant' WHERE study='bollinger'";
        $st_updated = mysqli_query($conn, $st_update);
        echo $st_update;
        $msg = $ac_tb . " : constant from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
    }
}

//anorml neg
if ($stat['analyze_phase'] == "anormal+neg")
{
    if (strncmp($act_statement[$ac_tb], "constant", 8) == 0 || strncmp($act_statement[$ac_tb], "couloir", 7) == 0 || $act_statement[$ac_tb] == "bull+end")
    {
        $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='bulle' WHERE study='bollinger'";
        $st_updated = mysqli_query($conn, $st_update);
        echo $st_update;
        $msg = $ac_tb . " : bulle from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
    }
    if ($act_statement[$ac_tb] == "bulle")
    {
        if ($stat['mobile_average'] > $stat_1['mobile_average'])
        {
            $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='bulle+asc' WHERE study='bollinger'";
            $st_updated = mysqli_query($conn, $st_update);
            echo $st_update;
            $msg = $ac_tb . " : bulle+asc from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
        }
        if ($stat['mobile_average'] < $stat_1['mobile_average'])        
        {
            $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='bulle+dsc' WHERE study='bollinger'";
            $st_updated = mysqli_query($conn, $st_update);
            echo $st_update;
            $msg = $ac_tb . " : bulle+dsc from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
        }
    }
}

//anormal pos
if ($stat['analyze_phase'] == "anormal+pos")
{
    if (strncmp($act_statement[$ac_tb], "couloir", 7) != 0)
    {
        $st_update = "UPDATE `" . DB_PREFIX . "bitcoin_statement` SET `" . $ac_tb . "`='couloir' WHERE study='bollinger'";
        $st_updated = mysqli_query($conn, $st_update);
        echo $st_update;
        $msg = $ac_tb . " : couloir from Bollinger where XBT = " . $stat['closed_price'] . " at : " . $stat['date'];
    }
}

?>