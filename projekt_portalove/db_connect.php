<?php
include_once "db.php";

use projekt_portalove\DB;

$db = new DB("localhost", "projekt_poratalove", "root", "", '');

global $db;

session_start();