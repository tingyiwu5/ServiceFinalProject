<?php

session_start();
$c = $_POST['city'];
//$g = $_POST['gender'];
$g = $_SESSION['gender'];
$cc = trim($c);

$ch = curl_init();
// jennifer -> 128 ; x1c ->140 ; me ->243
curl_setopt($ch, CURLOPT_URL,"http://140.118.109.140:5000/weatherAndOutfits");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query( array( 'gender' => $g, 'city' => $cc ) ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//if connect to server's time more then 500ms -> timeout error
curl_setopt($ch, CURLOPT_TIMEOUT_MS, 500);

$server_output = curl_exec($ch);

//timeout's curl_errno($ch) = 28
if (curl_errno($ch) > 0) {
    curl_close ($ch);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://140.118.109.128:5000/weatherAndOutfits");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query( array( 'gender' => $g, 'city' => $cc ) ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    echo $server_output;
}else{
    echo $server_output;
}
curl_close ($ch);


?>