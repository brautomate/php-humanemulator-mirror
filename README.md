# php-humanemulator-mirror

This is a readonly mirror for official HumanEmulator's php client.

- Web: <https://gitee.com/brautomate/php-humanemulator-mirror>
- Issues: <https://gitee.com/brautomate/php-humanemulator-mirror/issues>
- My email: <va@brautomate.ru>

## HumanEmulator (WebEmulator)

HumanEmulator (WebEmulator) - web browser automation & emulation software,
also can automate MS Windows (clipboard, local files access, keyboard, mouse,
sound).

Read more about HumanEmulator with examples and videos on official
website: <http://humanemulator.info/?a_aid=brautomate>.

## Simple example

```
<?php
// coding: utf-8

$xhe_host = "127.0.0.1:7010";
$server_password = "xhe instance password";

require("../../../Templates/xweb_human_emulator.php");

$bUTF8Ver = true;
$PHP_Use_Trought_Shell=false;

// 1
$browser->navigate("http://humanemulator.net/poligon/textarea.html");

// 2
$textarea->send_keyboard_input_by_attribute("name", "txt3", true, "New Text\nValue");

// 3
if(!$textarea->send_keyboard_input_by_attribute("name", "not-found-attr-name", true, "blah blah blah"))
{
    echo "Element in DOM not found.\n";
}

$app->quit();
exit(0);
```
