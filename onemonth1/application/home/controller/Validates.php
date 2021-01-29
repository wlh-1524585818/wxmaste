<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\Validate;

class Validates extends Validate
{
    protected $rule = [
        'goods_id' => 'require|integer|egt:1'
    ];
    protected $message  =   [
        'goods_id.require' => '商品id不能为空',
        'goods_id.integer'     => '商品id必须为整数',
        'goods_id.egt:1'   => '商品id必须大于或者等1'
    ];
}
