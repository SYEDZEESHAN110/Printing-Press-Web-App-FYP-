<?php
$payload = @file_get_contents('php://input');
$data = json_decode($payload);
if ($data) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        foreach ($data as $key => $value) {
            $_POST[$key] = $value;
            $_REQUEST[$key] = $value;
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        foreach ($data as $key => $value) {
            $_GET[$key] = $value;
            $_REQUEST[$key] = $value;
        }
    }
}