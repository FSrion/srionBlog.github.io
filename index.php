<?php
/**
 * @入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */
//定义常量  当前框架所在的根目录
define('SRion',realpath('./'));
//框架核心文件所在的目录
define('common',SRion.'/systemctl');
//框架的应用目录（项目文件目录）
define('APP',SRion.'/App');
define('MODULE','App');

/**
 * 是否开启调试默认
 * @default  true
 */
define('DEBUG',true);
//如果开启调试模式  就打开php.ini中的错误模式
if(DEBUG){
    ini_set('display_errors','On');
}else{
    ini_set('display_errors','Off');
}

//引入函数库
include common.'/common/function.php';

//引入框架核心文件
include SRion.'/systemctl/kernal.php';

spl_autoload_register('\systemctl\kernal::load');  //参数为括号内的内容  当我们使用  $class = new \systemctl\kernal::load;时new 后面的类名将作为$class参数传入我们的自动加载类
//启动框架
\systemctl\kernal::run();