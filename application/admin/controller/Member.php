<?php
namespace app\admin\controller;

// use think\Controller;

class Member extends Base 
{
  public function manage()
  {
    return $this->fetch();
  }
}