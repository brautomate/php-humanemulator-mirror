<?php

$xhe_host = "127.0.0.1:7010";[[SERVER_PASSWORD]]

// The following code is required to properly run XWeb Human Emulator
require("[[TEMPLATE]]/xweb_human_emulator.php");
$bUTF8Ver=true;

// navigate to google
$browser->navigate("http://www.ya.ru");
$input->set_inner_text_by_name("text","中文");

// Quit
$app->quit();
?>