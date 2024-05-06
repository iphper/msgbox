# php-cmd-output
PHP命令行输出

##安装
```sh
composer require iphper/msgbox
```

## 使用示例
### 字符串输出
```php
use MsgBox\MsgBox;

(new MsgBox('这是想象不到的内容这是想象不到的内容', '标题'))->show();
```

### 助手函数
```php
msgbox('标题', '内容');
```
