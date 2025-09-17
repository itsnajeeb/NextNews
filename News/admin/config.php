<?php

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

// Initialize MySQLi
$conn = mysqli_init();

// Enable SSL (important for TiDB Cloud)
mysqli_ssl_set($conn, NULL, NULL, getenv('DB_SSL_CA'), NULL, NULL);

// Connect
mysqli_real_connect($conn, $host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>