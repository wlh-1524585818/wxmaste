<?php

namespace app\home\model;

use think\Model;
use traits\model\SoftDelete;

class Goods extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
}
