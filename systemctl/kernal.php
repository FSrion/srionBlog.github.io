<?php

namespace systemctl;

class kernal
{
    public static $classMap = array();

    public $assign;

    static function run ()
    {

        $route = new \systemctl\lib\routes();
       $controllerClass =  $route -> controller;
       $action = $route -> action;
       $controllerFile = APP . '/controller/' . $controllerClass . 'Controller.php';

       if (is_file ($controllerFile)) {
            include $controllerFile;
           $ctrlClass = '\\'.MODULE . '\controller\\' . $controllerClass . 'Controller';
//            p($controllerClass);die;
           $cont = new  $ctrlClass;
           $cont -> index();
       } else {
           throw new \Exception('找不到控制器' . $controllerClass . 'Controller');
       }
    }


    static function load ($class)
    {

        //自动加载类库
        //new /systemctl/route();正常情况需要这样引入   因为这个类还没有引入  所以会触发入口文件中的自动引入方法
        //$class = '\systemctl\route.php';
        //转化成 kernal.'/systemctl/route.php';

        if(isset($classMap[$class])){
            //如果已存在该文件 那么直接调用
            return true;
        }else{
            //如果没有   那么出发入口文件自动引入
            $class = str_replace('\\','/',$class);   //替换目录符号  单独的'\'视为转义  所以用两个
            $file = SRion.'/'.$class.'.php';
            if(is_file($file)){
                //引入 路由文件
                include $file;
                self::$classMap[$class] = $class;
            }else{
                return false;
            }
        }

    }
    public function assign ($name,$value)
    {
        $this->assign[$name] = $name;
        $this->assign[$value] = $value;
    }
    public function display ($file)
    {
        $file = App . '/views/'.$file;
        if (is_file($file)) {
            extract($this->assign);
            include $file;
        }
    }
}