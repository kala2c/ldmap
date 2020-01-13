<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
  public function initialize()
  {
    // 检查登录状态
    $uid = session('uid');
    $username = session('username');
    if (!$uid) {
      $this->redirect("/admin/auth/login");
    }
    $this->assign("username", $username);
    // 渲染大布局
    $leftBarConfig = [
      "welcome" => "/admin",
      "坐标管理" => [
        "添加坐标" => "/admin/latlng/create",
        "坐标列表" => "/admin/latlng/manage",
        "分类管理" => "/admin/latlng/placetype"
      ],
      "用户管理" => "/admin/member/manage"
    ];
    $this->assign([
      'leftBarConfig' => $leftBarConfig,
    ]);
  }
}