<?php
session_start();
require_once "../config/connection.php";
require_once "users/functions.php";

deleteLogin($_SESSION["user"]->user_id);
unset($_SESSION["user"]);

header("Location: ../index.php?page=home");