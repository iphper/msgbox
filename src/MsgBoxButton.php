<?php

namespace MsgBox;

/**
 * @class MsgBoxButton
 * @desciption 消息弹窗按钮
 */
class MsgBoxButton
{
    // 只显示确定按钮。
    const OK_ONLY = 0; 
    // 显示确定和取消按钮。
    const OK_CANCEL = 1; 
    // 显示放弃、重试和忽略按钮。
    const ABORT_RETRY_IGNORE = 2;
    // 显示是、否和取消按钮。
    const YES_NO_CANCEL = 3;
    // 显示是和否按钮。
    const YES_NO = 4; 
    // 显示重试和取消按钮。
    const RETRY_CANCEL = 5;
    // 显示临界信息图标。
    const CRITICAL = 16; 
    // 显示警告查询图标。
    const QUESTION = 32; 
    // 显示警告消息图标。
    const EXCLAMATION = 48; 
    // 显示信息消息图标。
    const INFORMATION = 64; 
    // 第一个按钮为默认按钮。
    const DEFAULT_BUTTON_1 = 0; 
    // 第二个按钮为默认按钮。
    const DEFAULT_BUTTON_2 = 256; 
    // 第三个按钮为默认按钮。
    const DEFAULT_BUTTON_3 = 512; 
    // 第四个按钮为默认按钮。
    const DEFAULT_BUTTON_4 = 768; 
    // 应用程序模式：用户必须响应消息框才能继续在当前应用程序中工作。
    const APPLICATION_MODAL = 0;
    // 系统模式：在用户响应消息框前，所有应用程序都被挂起。
    const SYSTEM_MODAL = 4096; 

}
