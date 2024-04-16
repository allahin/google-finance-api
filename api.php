<?php
header("Content-Type: application/json");

$ch = curl_init();

$url = "https://www.google.com/finance/quote/USD-TRY";
$user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);

$dom = new DOMDocument();
@$dom->loadHTML($response);

$xpath = new DOMXPath($dom);
$elements = $xpath->query("//div[@class='YMlKec fxKbKc']");

$result = "";
if ($elements->length > 0) {
    $result = $elements->item(0)->nodeValue;
}

$output = json_encode(array("TRY" => trim($result)));

echo $output;