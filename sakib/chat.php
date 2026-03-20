<?php
session_start();
include "db.php";
include "config.php";

if(!isset($_SESSION['user_id'])) die("Login required");

$message = $_POST['message'];

$data = [
    "contents" => [
        ["parts" => [["text" => $message]]]
    ]
];

$ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . GEMINI_API_KEY);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
$reply = $result['candidates'][0]['content']['parts'][0]['text'] ?? "Error";

$conn->query("INSERT INTO messages (user_id,message,response) VALUES ('".$_SESSION['user_id']."','$message','$reply')");

echo $reply;
?>
