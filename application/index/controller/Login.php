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
use app\index\model\Employee;
class Login extends Controller
{

    //---------------超级管理员
    public function adminLogin(){
        if(session('user')){
            $this->redirect('index/index/index');
        }
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
                $user['admin'] =  'admin';  //登陆类型
                $user['user_id'] =  $info['id'];  //登陆id
                $user['user_code'] =  $info['admin_code'];  //登陆编码
                $user['user_name'] =  $info['admin_name'];  //登陆名
                $user['is_quota'] =  1;   //定额权限  默认管理员有最高权限
                $user['employee_lv'] = 1; //管理员权限
                $user['is_price'] = 2;  //价格权限
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

    //普通成员登陆
    public function login(){
        if(session('user')){
            $this->redirect('index/index/index');
        }
        return $this->view->fetch("login");
    }
    public function handleLogin(){
        if(Request::isAjax()){
            $employee_code = Request::post('employee_code');
            $password = Request::post('password');
            $info = Employee::where(['employee_code'=>$employee_code])->where(['password'=>$password])->field('id,employee_code,employee_name,employee_lv,is_quota,is_price')->find();
            if(!$info){
                return json([
                    'code'  => 0,
                    'msg'   => '用户或者密码错误'
                ]);
            }
            if($info){
                $user['admin'] =  'user';
                $user['user_id'] =  $info['id'];
                $user['user_code'] =  $info['employee_code'];
                $user['user_name'] =  $info['employee_name'];
                $user['employee_lv'] =  $info['employee_lv'];
                $user['is_quota'] =  $info['is_quota'];
                $user['is_price'] =  $info['is_price'];
                session('user',$user);
                return json([
                    'code'  => 1,
                ]);
            }
        }
    }
    public function switchLoginU(){
        session('user',null);
        Session::clear();
        $this->redirect('index/Login/login');
    }

}