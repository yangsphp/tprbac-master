<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/11
 * Time: 15:56
 */

namespace app\admin\controller;

class Settings extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        return $this->fetch();
    }
}