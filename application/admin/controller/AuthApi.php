<?php
namespace app\admin\controller;

use think\Controller;
use think\facade\Validate;
use app\admin\model\Member;

class AuthApi extends Controller
{
  public function login()
  {
    $validate = Validate::make([
      'username' => 'require',
      'password' => 'require'
    ])->message([
      'username.require' => '缺少用户名',
      'password.require' => '缺少登录密码'
    ]);
    $param = $this->request->post();
    if (!$validate->check($param)) {
      return json(['err' => $validate->getError()])->code(400);
    }

    $member = Member::where(['status' => 0])->get(['username' => $param['username']]);

    if (!$member) {
      return json(['err' => '用户不存在'])->code(400);
    }

    if ($member->password == sha1($param['password'])) {
      session('uid', $member->id);
      session('username', $member->username);
      // 此处往往还要签发token view储存在浏览器localStorage中
      return json(['msg' => '登录成功']);
    } else {
      return json(['err' => '密码不正确'])->code(400);
    }
  }
}