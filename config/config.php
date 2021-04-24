<?php
define("BASE_URL", "http://localhost/Gentleman/");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/Gentleman/");

define("ERRORS_FILE", ABSOLUTE_PATH . "data/errors.txt");
define("LOG_ACCESS_FILE", ABSOLUTE_PATH . "data/log_access.txt");
define("LOGIN_FILE", ABSOLUTE_PATH . "data/login.txt");

define("ENV_FILE", ABSOLUTE_PATH . "config/.env");

define("DBNAME", env("DBNAME"));
define("SERVER", env("SERVER"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($param) {
    $open = fopen(ENV_FILE, "r");
    $data = file(ENV_FILE);

    $string = "";
    foreach($data as $key => $value) {
        $config = explode("=", $value);
        if ($config[0] == $param) {
            $string = trim($config[1]);
        }
    }
    return $string;

    fclose($open);
}