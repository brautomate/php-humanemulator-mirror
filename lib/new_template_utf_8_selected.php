<?php

$xhe_host = "127.0.0.1:7010";[[SERVER_PASSWORD]]

// The following code is required to properly run XWeb Human Emulator
require("[[TEMPLATE]]/Templates/xweb_human_emulator.php");
$bUTF8Ver=true;

[[SELECTED]]

// Quit
$app->quit();
?>