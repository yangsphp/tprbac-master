<?php
/**
 * Created by PhpStorm.
 * User: 25754
 * Date: 2020/3/26
 * Time: 15:17
 */

namespace app\admin\controller;
use think\captcha\Captcha;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use think\Session;

class User extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public function login()
    {
        if ($this->request->method(true) == 'POST')
        {
            $post = $this->request->post("post/a");
            $captcha = new Captcha();
            if( !$captcha->check($post['verity'])) { // 验证失败
                $this->error("验证码不正确");
            }
            $adminModel = new AdminModel();
            $admin = $adminModel->getAdminByName($post['username']);
            if (!$admin['status']) {
                $this->error("该用户已被停用");
            }
            if ($admin['password'] != md5(md5($post['password']).$admin['salt'])) {
                $this->error("用户名或密码不正确");
            }
            $update = array(
                "id" => $admin['id'],
                "login_entered" => date("Y-m-d H:i:s"),
                "last_login_entered" => $admin['login_entered'],
                "login_ip" => $this->request->ip(),
                "times" => $admin['times'] + 1
            );
            //修改登录时间和ip地址与登录日志
            $adminModel->editModel($update);
            Session::set("user", $admin);
			$this->success('登录成功', url("admin/index/index"));
        }
        return $this->fetch();
    }
    public function verify()
    {
        $captcha = new Captcha();
        $captcha->length = 5;
        return $captcha->entry();
    }

    public function logout()
    {
        Session::delete("user");
        $this->redirect(url('user/login'));
    }
}