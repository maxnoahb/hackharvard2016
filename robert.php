<?php
$APP_ID="581bc055";
$APP_KEY="3a5ccb688b998197fcaad08b719f609a";
$i = str_replace(" ", "+", $_POST['ingredients']);

// Stores the data returned from the API as an associative array
$data = json_decode(file_get_contents("https://api.edamam.com/search?q=$i&app_id=$APP_ID&app_key=$APP_KEY&to=30"), true);


// Print data
// print_r($data["hits"][0]["recipe"]);

?>