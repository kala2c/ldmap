<?php
namespace app\admin\controller;

use think\Controller;

class ApiBase extends Controller
{
  public function initialize()
  {
    // 这里可以进行api鉴权 未登录中止并重定向
    // 理应使用bearer token或其他api验证方式
    // 因为未跨域 session依然有效 所以没有使用bearer token
    $uid = session('uid');
    if (!$uid) {
      header('HTTP/1.1 401 Unauthorized');
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode(['err' => '未登录']);
      exit;
    }

    // 获取bearer token的代码
    // $token = $this->request->header('authorization') ?? null;
    // if (isset($token)) {
    //   $token = explode(' ', $token);
    //   if (count($token) > 1) {
    //     if ($token[0] = 'Bearer') {
    //       $token = $token[1];
    //     } else {
    //       $token = null;
    //     }
    //   } else {
    //     $token = null;
    // }
    // }
  }
}