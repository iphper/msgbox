<?php

namespace MsgBox;

use CmdOutput\Color;
use CmdOutput\Output;

class MsgBox
{
    /**
     * @const 窗口显示
     */
    const MODE_WINDOW = 1;

    /**
     * @const 终端显示
     */
    const MODE_COMMAND = 2;

    /**
     * @var int $button 按钮
     */
    protected int $button = MsgBoxButton::OK_ONLY;

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
     * @var string $mode 显示模式
     */
    protected int $mode = self::MODE_WINDOW;

    /**
     * @method __construct
     * @desciption 构造方法
     */
    public function __construct(
        string $content = '',
        string $title = '',
        $button = MsgBoxButton::OK_ONLY,
        $mode = self::MODE_WINDOW
    )
    {
        $this->setContent($content);
        $this->setButton($button);
        $this->setTitle($title);
        $this->setMode($mode);
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
     * @method setButton
     * @desciption 设置内容
     * @param int $button
     * @return self
     */
    public function setButton($button) : self
    {
        $this->button = $button;
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

    /**
     * @method setMode
     * @desciption 设置显示模式
     */
    public function setMode(int $mode) : self
    {
        $this->mode = $mode;
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
        // 如果不允许则直接在控制台显示
        switch(true) {
            case $this->mode == static::MODE_WINDOW && function_exists('shell_exec') :
                return $this->renderWindow();
            default:
                return $this->renderCommand();
        }
    }

    /**
     * @method renderWindow
     * @desciption 窗口渲染
     */
    protected function renderWindow()
    {
        shell_exec('mshta ' . $this);
    }

    /**
     * @method renderCommand
     * @desciption 终端渲染
     */
    protected function renderCommand()
    {
        (new Output())->setColor(Color::BG_BLUE)->output($this->title. '::')->output($this->content);
    }

    // ====== magic methods ======
    /**
     * @method __toString
     */
    public function __toString() : string
    {
        return 'vbscript:msgbox("'.$this->content.'",'.$this->button.',"'.$this->title.'")(window.close)';
    }

}
