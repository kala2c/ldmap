<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Buildings;
use app\index\model\PlaceType;

class Api extends Controller
{
  public function building()
  {
    return '建筑物详情';
  }

  public function nav()
  {
    return '导航';
  }

  public function street()
  {
    return '街景';
  }

  public function placeType()
  {
    $map = ['status' => 0];
    $data = PlaceType::where()->select();
    return json($data);
  }

  public function buildings()
  {
    $placeType = $this->request->get('place_type');
    $map['status'] = 0;
    if (isset($placeType) && $placeType != 0) {
      $map['pt_id'] = $placeType;
    }
    $list = Buildings::where($map)->select();
    return json($list);
  }
}