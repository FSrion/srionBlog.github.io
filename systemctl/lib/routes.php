<?php

namespace systemctl\lib;

class routes
{
    public $controller;  //控制器
    public $action;      //方法
    public function __construct()
    {
        /**
         * xxx.com/index.php/index/index
         *1. 隐藏地址中的 index.php
         * 2.获取地址中的参数
         * 3.获取控制器名和方法
         */

        //获取地址中的参数 判断其是否存在且不为斜线  如果存在参数且不为斜线  就解析URL  否则就是默认的index控制器和方法
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/',trim($path,'/'));
//          p($patharr);

            //判断参数构成  如果有第一个参数  那么控制器名就是第一个参数
            if (isset($patharr[0])) {
                $this -> controller = $patharr[0];
                unset($patharr[0]);
            }
            //如果有第二个参数 那么方法就是这个参数  如果没有参数 即为默认index方法
            if (isset($patharr[1])) {
                $this -> action = $patharr[1];
                unset($patharr[1]);
            } else {
                $patharr[1] = 'index';
                $this -> action = 'index';

            }
            //将URL中多余的部分 转换为GET参数
            $count = count($patharr) + 2;
            $i = 2;
            while ($i < $count ) {
                if(isset($patharr[$i + 1] )) {
                    $_GET[$patharr[$i]] = $patharr[$i + 1];
                }
                $i = $i + 2;
            }
        } else {
            $this -> controller = 'index';
            $this -> action = 'index';
        };
    }
}