<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/11
 * Time: 15:56
 */

namespace app\admin\controller;
use app\admin\model\Auth as AuthModel;
use app\admin\model\Role as RoleModel;
use app\admin\model\Admin as AdminModel;
class Role extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        return $this->fetch();
    }

    public function lst()
    {
        $page = $this->request->get("page");
        $limit = $this->request->get("limit");
        $offset = ($page - 1) * $limit;
        $roleModel = new RoleModel();
        $data = $roleModel->getRoleList($offset, $limit);
        $count = $roleModel->getRoleListCount();
        return result($data, 0, '获取成功', $count);
    }

    public function add()
    {
        if ($this->request->method(true) == 'POST') {
            $post = $this->request->post("post/a");
            $post['date_entered'] = $post['update_entered'] = date("Y-m-d H:i:s", time());
            $post['auth'] = implode(",", $post['auth']);
            $roleModel = new RoleModel();
            if ($roleModel->addRole($post)) {
                $this->redirect(url('role/index'));
                return false;
            }
            $this->error("添加角色失败");
        }
        $auth = new AuthModel();
        $data = getRoleTree($auth->getMenu());
        $this->assign("tree", json_encode($data));
        return $this->fetch();
    }

    public function edit()
    {
        if ($this->request->method(true) == 'POST') {
            $post = $this->request->post("post/a");
            $post['update_entered'] = date("Y-m-d H:i:s", time());
            $post['auth'] = implode(",", $post['auth']);
            $roleModel = new RoleModel();
            if ($roleModel->editRole($post)) {
                $this->redirect(url('role/index'));
                return false;
            }
            $this->error("编辑角色失败");
        }
        $id = $this->request->get("id");
        if ($id == 1) {
            $this->error("超级管理员不能被编辑");
        }
        $roleModel = new RoleModel();
        $info = $roleModel->getRole($id);
        $auth = new AuthModel();
        $data = getRoleTree($auth->getMenu(), 0, explode(",", $info['auth']));
        $this->assign("tree", json_encode($data));
        $this->assign("info", $info);
        return $this->fetch();
    }
    public function delete_op(){
        $id = $this->request->get('id');
        $id_array = explode(",", $id);
        if (in_array(1, $id_array)) {
            return result(array(), 1, "超级管理员不能被删除");
        }
        //判断角色下是否有用户
        $adminModel = new AdminModel();
        if (count($adminModel->getAdminByRoleId($id)) > 0) {
            return result(array(), 1, "角色下有管理员不能被删除");
        }
        $roleModel = new RoleModel();
        if ($roleModel->deleteRole($id)) {
            return result(array(), 200, "删除角色成功");
        }
        return result(array(), -1, "删除角色失败");
    }
}