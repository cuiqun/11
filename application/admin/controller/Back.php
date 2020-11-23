<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Back extends Controller
{
    //
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $data = session('url');
        $user = session('user');
        if (!$user){
            return $this->error('未登录，请登录后再试','http://www.week.com/login');
        }
        $request = Request::instance();
        $url = $request->path();
        if (!in_array($url,$data)){
            return $this->error('对不起，没有权限，请联系管理员','http://www.week.com/back');
        }
    }
}
