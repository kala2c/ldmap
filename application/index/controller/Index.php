<?php
namespace app\index\controller;

use app\index\model\PlaceType;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $map = [
            'status' => 0,
        ];
        $placeType = PlaceType::where($map)->select();
        $this->assign('placeType', $placeType);
        return $this->fetch();
    }
}
