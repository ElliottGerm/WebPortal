<?php

$_SESSION["eid"] = "";
session_start();

require_once "config.php";

echo $_SESSION["eid"];
