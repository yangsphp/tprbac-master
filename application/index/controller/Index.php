<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function hello($id)
    {
        return $id;
    }
}
