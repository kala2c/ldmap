<?php
namespace app\admin\model;

use think\Model;

class Buildings extends Model
{
  public function campus()
  {
    return $this->belongsTo('Campuses', 'campus_id');
  }

  public function placeType()
  {
    return $this->belongsTo('PlaceType',  'pt_id', 'id');
  }
}