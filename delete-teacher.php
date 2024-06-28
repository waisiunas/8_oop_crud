<?php
require_once "./partials/database.php";

$id = htmlspecialchars($_GET['id']);

if ($database->delete("teachers", $id)) {
    header('location: ./');
} else {
    die("Failed to delete!");
}
