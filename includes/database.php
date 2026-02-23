<?php

$hostname = 'localhost';
$dbName = 'enrollment';
$username = 'demo';
$password = 'abc123';
$conn = new mysqli($hostname, $username, $password, $dbName);

function getConnection(): mysqli
{
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}