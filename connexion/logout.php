<?php

session_start();
$_SESSION["client"] = NULL;
session_destroy();
header("location: /index.php");