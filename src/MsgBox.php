<?php

namespace MsgBox;

use CmdOutput\Color;
use CmdOutput\Output;

class MsgBox
{
    /**
     * @var bool $show 显示状态
     */
    protected bool $show = false;

    /**
     * @var string 标题
     */
    protected string $title = '提示';

    /**
     * @var string 内容
     */
    protected string $content = '';

    /**
     * @method __construct
     * @desciption 构造方法
     */
    public function __construct(string $content = '',string $title = '')
    {
        $this->setContent($content);
        $this->setTitle($title);
    }

    /**
     * @method show
     * @desciption 显示
     */
    public function show()
    {
        $this->show = true;
        return $this->render();
    }

    // ====== setter ======

    /**
     * @method setContent
     * @desciption 设置内容
     * @param string $content
     * @return self
     */
    public function setContent(string $content = '') : self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @method setTitle
     * @desciption 设置标题
     * @param string $title
     * @return self
     */
    public function setTitle(string $title = '') : self
    {
        $this->title = $title;
        return $this;
    }

    // ====== protected methods ======
    /**
     * @method render
     * @desciption 渲染方法
     */
    protected function render()
    {
        if (!$this->show) {
            return false;
        }
        // 判断是否允许shell_exec
        if (!function_exists('passthru')) {
            return $this->renderCommand();
        }
        // 如果不允许则直接在控制台显示
        switch(strtolower(PHP_OS)) {
            case 'winnt':
                return $this->renderWindow();
            default:
                return $this->renderLinux();
        }
    }

    /**
     * @method renderWindow
     * @desciption 窗口渲染
     */
    protected function renderWindow()
    {
        if (151 <= mb_strlen($this->content)) {
            $this->content = mb_substr($this->content, 0, 151) . '...';
        }
        $command = 'mshta vbscript:msgbox("'.$this->content.'",0,"'.$this->title.'")(window.close)';
        passthru($command);
    }

    /**
     * @method renderCommand
     * @desciption 终端渲染
     */
    protected function renderCommand()
    {
        $content =  "\n\n".$this->title.":\n".$this->content."\n";
        (new Output())->output($content, Color::BG_BLUE)->output("\n\n", Color::BG_BLACK);
    }

    /**
     * linux系统运行
     */
    protected function renderLinux()
    {
        $len = mb_strlen($this->content);
        switch(true) {
            case $len < 100:
                $width = 40;
                break;
            case $len < 500:
                $width = 60;
                break;
            case $len < 1000:
                $width = 80;
                break;
            default: // >1000
                $width = 100;
                break;
        }
        $height = 6 + ceil($len/$width);

        $command = [
            'whiptail',  // 主命令
            '--title', $this->title, // 标题
            '--ok-button 确认',
            '--cancel-button 取消',
            '--msgbox ' . $this->content,
            '--scrolltext',
            $height > 30 ? 30 : $height, // 高
            $width + 4, // 宽
        ];
        $command = implode(' ', $command);

        passthru($command);
    }

}
