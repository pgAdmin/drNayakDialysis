<?php

$ch = curl_init("https://api.twitter.com/oauth2/token");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic Y1MwdU1nYnFWQTVjVWhLa3EyNkJnOjNxSG1pNDlscEQyTHhtQ2lDNUtmQ3NlNkZ2MU05eFlRV0tqOHJwOE5qaw=="));
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$data = curl_exec($ch);
$k = json_decode($data, true);

$ch = curl_init("https://api.twitter.com/1.1/statuses/user_timeline.json?count=5&screen_name=drnayakdialysis");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$k["access_token"]));
$data = curl_exec($ch);
$j = json_decode($data, true);
$response = array();
foreach ($j as $key => $value) {
	$response[] = nl2br($value['text']."<br>");
}
header("Content-type: application/json");
echo json_encode($response, JSON_FORCE_OBJECT);
?>