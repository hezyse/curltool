<!-- process.php -->
<?php
//die("reached");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];
    $headers_data = $_POST['headers'];
    $headers = explode("\r\n", $headers_data);

    $curl = curl_init($url);
    //curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    if(array_key_exists("sslchk", $_POST) && $_POST['sslchk'] === "on"){
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    }

    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);

    $response = curl_exec($curl);
    if(!$response){
        $response = curl_error($curl);
    }
    curl_close($curl);

    // Display the response

    echo "<pre>" . htmlentities($response) . "</pre>";
}
?>