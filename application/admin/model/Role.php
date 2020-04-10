<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/13
 * Time: 14:05
 */

namespace app\admin\model;

use think\Model;

class Role extends Model
{
    public function initialize()
    {
        parent::initialize();
    }
    public function addRole($post)
    {
        return $this->insert($post);
    }
    public function editRole($post){
        return $this->where("id", $post['id'])->update(array(
            "name" => $post['name'],
            "note" => $post['note'],
            "auth" => $post['auth'],
            "update_entered" => $post['update_entered']
        ));
    }
    public function getRoleList($page, $limit)
    {
        return $this->where("is_deleted", 0)
            ->order("id", "desc")
            ->page($page, $limit)
            ->select();
    }

    public function getRoleListCount()
    {
        return $this->where("is_deleted", 0)->count();
    }

    public function getRole($id = 0)
    {
        $this->where("is_deleted", 0);
        if ($id) {
            return $this->where("id", $id)->find();
        }
        return $this->order("id","asc")->select();
    }
    public function deleteRole($id)
    {
        return $this->whereIn("id", $id)->update(array("is_deleted" => 1));
    }
}