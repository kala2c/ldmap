<?php
namespace app\admin\controller;

use app\admin\model\Buildings;
use app\admin\model\Campuses;
use app\admin\model\PlaceType;
use think\facade\Validate;

class Latlng extends Base
{
  public function baseInfo()
  {
    $campuses = Campuses::where(['status' => 0])->select();
    $placeTypeList = PlaceType::where(['status' => 0])->select();
    $this->assign([
      'placeTypeList' => $placeTypeList,
      'campuses' => $campuses
    ]);
  }
  public function create()
  {
    $this->baseInfo();
    return $this->fetch();
  }

  public function edit()
  {
    $id = $this->request->get('id') ?? null;
    if (!$id) {
      return json(['err' => '参数不行'])->code(400);
    }
    $building = Buildings::where(['status' => 0])->get($id);
    $this->baseInfo();
    $this->assign([
      'edit' => 1,
      'building' => $building
    ]);
    return $this->fetch('create');
  }

  public function manage()
  {
    $page = $this->request->get('page') ?? 1;  // 页码
    $map = ['status' => 0];                    // 查询条件

    $total = Buildings::where($map)->count();  // 数据总条数
    $pageCount = 15;                           // 每页条数
    $pageMax = ceil($total/$pageCount);        // 最大页码

    // 检验页码    
    if ($page < 1 || $page > $pageMax) { 
      return json(["err" => "页码不正确"])->code(400);
    }

    $offset = ($page-1)*$pageCount;        // 数据起始点

    $list = Buildings::with(['campus', 'placeType'])
      ->where($map)
      ->limit($offset, $pageCount)
      ->order('created_at', 'desc')
      ->select();
    $this->assign('list', $list);
    $this->assign([
      "pageurl" => $this->request->baseUrl(),
      "page" => $page,
      "pageMax" => $pageMax,
      "total" => $total,
      "param" => ""
    ]);
    return $this->fetch();
  }

  public function PlaceType()
  {
    return $this->fetch();
  }
}