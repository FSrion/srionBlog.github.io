<?php

namespace App\controller;

class indexController extends  \systemctl\kernal
{
    public function index ()
    {
        $data = "hello world";
        $this->assign('data',$data);
        $this->display('index.html');
    }
}