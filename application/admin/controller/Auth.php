<?php
namespace app\admin\controller;

use think\Controller;

class Auth extends Controller
{
  public function login()
  {
    return $this->fetch();
  }
}