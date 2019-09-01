<?php

include ('connect_to_dbb.php');
define ('DB_PREFIX', $table_prefix);
if (strpos(DB_HOST, ":") == FALSE)
{
    $conn = mysqli_connect($servername, $username, $password, $dbname);
}
else
{
    $hostname = explode(":", $servername);
    $conn = mysqli_connect($hostname[0], $username, $password, $dbname, $hostname[1]);
}
if (!$conn)
{
	die("Connection failed: " . mysqli_connect_error());
}

function num_bollinger_for_id($conn)
{
  $query = "SELECT MAX(`id`) as COUNT FROM `" . DB_PREFIX . "bitcoin_bollinger`";
  $result = mysqli_query($conn, $query);
  $assoc = mysqli_fetch_assoc($result);
  return ($assoc['COUNT'] + 1);
}

//calcul de la moyenne mobile
function mobile_average($tab, $id, $size, $param)
{
    $start = $id - $size;
    $sum = 0;
    for ($i = $start; $i != ($start + $size); $i ++)
    {
        $sum += $tab[$i][$param];
    }
    return($average = $sum / $size);
}

//calcul de l'écart-type
function ecart_type($tab, $id, $size, $average, $param)
{
    $start = $id - $size;
    $sum = 0;
    for ($i = $start; $i != ($start + $size); $i ++)
    {
        $sum += pow(($tab[$i][$param] - $average), 2);
    }
    return ($ecart_type = sqrt($sum / $size));
}

function analyze_delta($tab, $id)
{
    if (abs($tab[$id]['diff_mm_et_delta']) > $tab[$id]['ref_type_delta'])
    {
        $trigger = "anormal";
        if ($tab[$id]['diff_mm_et_delta'] > 0)
        {
            $trigger .= "+pos";
        }
        else
        {
            $trigger .= "+neg";
        }
    }
    else
    {
        $trigger = "normal";
        if (isset($tab[$id]['minus_2']) && $tab[$id]['minus_2'] > $tab[$id]['closed_price'])
        {
            $trigger .= "+min";
        }
        if (isset($tab[$id]['plus_2']) && $tab[$id]['plus_2'] < $tab[$id]['closed_price'])
        {
            $trigger .= "+max";            
        } 
    }
    return ($trigger);
}

function send_msg($msg)
{
    $token = "bot556988821:AAH6oWEgB04A6JLzhexH1u-bVl0pjjNeees";
    $chatid = "695918940";
    $url = "https://api.telegram.org/" . $token . "/sendMessage?chat_id=" . $chatid;
    $url = $url . "&text=" . urlencode($msg);
    echo "<br/>" . $url . "<br/>";
    wp_remote_post($url);
    //wp_mail("nickauteen@gmail.com", "Evolution du bitcoin", $msg, 'From: LAM YEE MAN Nick <lamyeemanick@gmail.com>');
}

$modulo = 30;
include ('boll_calcul_table.php');

$modulo = 10;
include ('boll_calcul_table.php');

$modulo = 5;
include ('boll_calcul_table.php');

$modulo = 3;
include ('boll_calcul_table.php');

$modulo = 1;
include ('boll_calcul_table.php');
mysqli_close($conn);

?>