<?php

namespace app\admin\model;
use think\Model;

class Menu extends Model
{
    public function getAdminList($page, $limit)
    {
        return $this->alias('a')->field('a.*,name')->join("role r", "r.id=a.role_id", "left")->where("a.status", 1)->order("a.id", "desc")->page($page, $limit)->select();
    }

    public function getAdminListCount()
    {
        return $this->where("status", 1)->count();
    }
}