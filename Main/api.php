<?php
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://spotify23.p.rapidapi.com/podcast_episodes/?id=0ofXAdFIQQRsCYj9754UFx&offset=0&limit=50",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: spotify23.p.rapidapi.com",
		"X-RapidAPI-Key: 9207f5cd7amsha2832953b149284p106bcejsne2119c23bc45",
		"content-type: application/octet-stream"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
?>
