<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('login');
    }
    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function login()
    {
        //
        $user_name=input('user_name');
        $user_pwd=md5(md5(input('user_pwd')));
        $result = $this->validate($user_name,$user_pwd,
            [
                'user_name|管理员名称' => 'require',
                'user_pwd|密码' => 'require'
            ],
            [
                'user_name.require' => '管理员名称不能为空',
                'user_pwd.require' => '管理员密码不能为空'
            ]
        );
        if (true !== $result){
            $this->error($result);
        }
        //保存数据
        $data = Db::table('user')->where('user_name',$user_name)->find();
        if ($data['user_name'] == $user_name){
            if ($data['user_password'] == $user_pwd){
                session('user',$data);
                return json(['code'=>200,'msg'=>'登陆成功','result'=>null]);
            }else{
                return json(['code'=>500,'msg'=>'密码错误','result'=>null]);
            }
        }else{
            return json(['code'=>500,'msg'=>'用户名错误','result'=>null]);
        }
    }
}
