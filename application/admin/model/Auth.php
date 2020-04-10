<?php

namespace app\admin\model;
use think\Model;

class Auth extends Model
{
    public function addMenu($post)
    {
        return $this->insert($post);
    }

    public function editMenu($post)
    {
        return $this->where("id", $post['id'])->update(array(
            "name" => $post['name'],
            "parent_id" => $post['parent_id'],
            "icon" => $post['icon'],
            "url" => $post['url'],
            "status" => $post['status'],
            "sort" => $post['sort'],
            "is_menu" => $post['is_menu']
        ));
    }

    public function getMenu($id = 0) {
        if ($id) {
            return $this->where("id", $id)->find();
        }
        return $this->order("sort","asc")->select();
    }

    public function getMenuByWhere($where)
    {
        return $this->where($where)->select()->toArray();
    }

    public function deleteMenu($id)
    {
        //判断是否有下级菜单
        $count = $this->whereIn("parent_id", $id)->count();
        if ($count > 0) {
            return -1;
        }
        return $this->whereIn("id", $id)->delete();
    }
}