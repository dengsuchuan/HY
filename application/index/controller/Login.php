<?php
/**
 * Created by PhpStorm.
 * User: @ 若雨
 * Date: 2018/7/31
 * Time: 11:28
 */

namespace app\index\controller;


use think\Controller;
use think\facade\Request;
use app\index\model\Administrators;
use think\facade\Session;
class Login extends Controller
{
    public function adminLogin(){
        return $this->view->fetch('admin-login');
    }
    public function adminHandleLogin(){
        if(Request::isAjax()){
            $admin_name = Request::post('admin_name');
            $password = Request::post('password');
            $info = Administrators::where(['admin_name'=>$admin_name])->where(['password'=>$password])->field('id,admin_code,admin_name,login_number')->find();
            $id = $info['id'];
            $login_number = $info['login_number'];
            if(!$info){
               return json([
                    'code'  => 0,
                    'msg'   => '用户或者密码错误'
                ]);
            }
            if($info){
                Administrators::update(['login_number'=>++$login_number],['id'=>$id]);
                $user['admin'] =  'admin';
                $user['user_id'] =  $info['id'];
                $user['admin_code'] =  $info['admin_code'];
                $user['admin_name'] =  $info['admin_name'];
                session('user',$user);
                return json([
                    'code'  => 1,
                ]);
            }
        }
    }
    public function outLogin(){
        session('user',null);
        Session::clear();
        $this->redirect('index/index/index');
    }
    public function switchLogin(){
        session('user',null);
        Session::clear();
        $this->redirect('index/login/adminLogin');
    }
}