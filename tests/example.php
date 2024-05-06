<?php

require __DIR__ . '/../vendor/autoload.php';

use MsgBox\MsgBox;

$content = '';
for($i = 0; $i < 450; ++$i) {
    $content .= '这是想象不到的内容'.$i;
}
// (new MsgBox('这是想象不到的内容这是想象不到的内容', '标题'))->show();
msgbox('这是标题', $content);

