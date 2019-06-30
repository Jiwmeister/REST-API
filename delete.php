<?php
$id = $_GET["id"];
$url = "http://modul9.test/api.php?id=" . $id;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
$result = json_decode($result);
curl_close($curl);
header("Location: index.php");