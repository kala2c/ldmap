<?php
namespace app\admin\controller;

use app\admin\model\Buildings;
use think\facade\Validate;

class LatlngApi extends ApiBase
{
  // 修改和新增接口
  public function post()
  {
    $validate = Validate::make([
      'id' => 'number',
      'name' => 'require',
      'latitude' => 'require',
      'longitude' => 'require',
      'placetype' => 'require|number',
      'campus' => 'require|number',
      'desc' => 'require',
      'address' => 'require'
    ])->message([
      'id.number' => '参数格式不正确',
      'name.require' => '缺少地点名称',
      'latitude.require' => '缺少纬度',
      'longitude.require' => '缺少经度',
      'placetype.require' => '缺少分类',
      'placetype.number' => '分类格式不正确',
      'campus.require' => '缺少校区',
      'campus.number' => '校区格式不正确',
      'desc.require' => '缺少地点描述',
      'address.require' => '缺少地址描述',
    ]);
    $param = $this->request->post();
    if (!$validate->check($param)) {
      return json(['err' => $validate->getError()])->code(400);
    }
    $data = [
      'name' => $param['name'],
      'pt_id' => $param['placetype'],
      'campus_id' => $param['campus'],
      'latitude' => $param['latitude'],
      'longitude' => $param['longitude'],
      'address' => $param['address'],
      'description' => $param['desc'],
      'updated_at' => time(),
    ];
    if (isset($param['id'])) {
      // 修改
      $rlt = Buildings::update($data, ['id' => $param['id']]);
      if ($rlt) {
        return json(['msg' => '操作成功']);
      } else {
        return json(['err' => '未知错误 稍后再试'])->code(500);
      }
    } else {
      $data['created_at'] = time();
      // 新增
      $rlt = Buildings::create($data);
      if ($rlt) {
        return json(['msg' => '操作成功']);
      } else {
        return json(['err' => '未知错误 稍后再试'])->code(500);
      }
    }
  }

  public function delete()
  {
    $id = $this->request->get('id') ?? null;
    if (!$id) {
      return json(['err' => '参数错误'])->code(400);
    }

    $building = Buildings::where(['status' => 0])->get($id);

    if (!$building) {
      return json(['err' => '要删除的坐标不存在'])->code(404);
    }

    $building->status = 1;

    if ($building->save()) {
      return json(['msg' => '删除成功']);
    }
  }

  // public 
}