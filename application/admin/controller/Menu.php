<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/13
 * Time: 9:09
 */

namespace app\admin\controller;
use think\Controller;
use  app\admin\model\Auth as MenuModal;

class Menu extends Controller
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
        $menu = new MenuModal();
        $data = getCategory($menu->getMenu());
        return result($data, 0, '获取成功',count($data));
    }
    public function add()
    {
        $menu = new MenuModal();
        if ($this->request->method(true) == 'POST') {
            $post = $this->request->post("post/a");
            $post['date_entered'] = date("Y-m-d H:i:s", time());
            $post['url'] = strtolower($post['url']);
            if ($menu->addMenu($post)) {
                $this->redirect(url('menu/index'));
                return false;
            }
            $this->error("添加菜单失败");
        }
        $data = getCategory($menu->getMenu());
        $this->assign('category', $data);
        $this->assign('id', $this->request->get('id'));
        return $this->fetch();
    }

    public function edit()
    {
        $menu = new MenuModal();
        if ($this->request->method(true) == 'POST') {
            $post = $this->request->post("post/a");
            $post['url'] = strtolower($post['url']);
            if ($menu->editMenu($post)) {
                $this->redirect(url('menu/index'));
                return false;
            }
            $this->error("编辑菜单失败");
        }
        $data = getCategory($menu->getMenu());
        $info = $menu->getMenu($this->request->get('id'));
        $this->assign('category', $data);
        $this->assign('info', $info);
        return $this->fetch();
    }

    public function delete_op()
    {
        $id = $this->request->get('id');
        $menu = new MenuModal();
        $flag = $menu->deleteMenu($id);
        if ($flag == -1) {
            return result(array(), 1, "该菜单有下级菜单不能删除");
        }
        return result(array(), 200, "删除菜单成功");
    }
}