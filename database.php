<?php
// database configuration constants
require_once('config.php');  

function db_connect() {
  try {
    // Create and return a new PDO connection object
    $dbh = new PDO(
      'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE,
      DB_USER,
      DB_PASS
    );
    return $dbh;
  } catch (PDOException $e) {
    // Throw error if connection fails
    throw new Exception("DB connection failed: " . $e->getMessage());
  }
}
?>
