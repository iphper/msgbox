<?php

// +-------------------------------------------
// | 助手函数
// +-------------------------------------------

use MsgBox\MsgBox;

if (! function_exists('msgbox')) {
    /**
     * @function msgbox
     * @desciption 消息函数
     * @param string $title 标题
     * @param string $content 内容
     * @return void
     */
    function msgbox(string $title, string $content) {
        (new MsgBox($content, $title))->show();
    }
}

