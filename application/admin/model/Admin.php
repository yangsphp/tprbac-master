<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/2
 * Time: 14:56
 */

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    public function getAdminList($page, $limit)
    {
        return $this->alias('a')->field('a.*,name')->join("role r", "r.id=a.role_id", "left")->where("status", 1)->order("a.id", "desc")->page($page, $limit)->select();
    }

    public function getAdminListCount($id = 0)
    {
        if ($id) {
            $this->whereIn("id", $id);
        }
        return $this->where("status", 1)->count();
    }

    public function getAdminByRoleId($id)
    {
        return $this->where("status", 1)->whereIn("role_id", $id)->select();
    }

    public function addAdmin($post)
    {
        return $this->insert($post);
    }

    public function checkUserName($username)
    {
        return $this->where("username", $username)->where("status", 1)->count();
    }

    public function getAdmin($id)
    {
        if ($id) {
            return $this->where("id", $id)->find();
        }
        return $this->->where("status", 1)order("id", "asc")->select();
    }

    public function editModel($post)
    {
        return $this->where("id", $post['id'])->update($post);
    }

    public function deleteAdmin($id) {
        return $this->whereIn("id", $id)->delete();
    }

    public function getAdminByName($username)
    {
        return $this->alias("a")
            ->field("a.username, a.salt, a.password, a.id, r.name, a.login_entered, a.times,a.status")
            ->join("role r", "r.id=a.role_id", "left")
            ->where("a.username", $username)
            ->find();
    }
}