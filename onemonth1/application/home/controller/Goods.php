<?php

namespace app\home\controller;

use think\Controller;
use think\Loader;
use think\Request;

class Goods extends Controller
{
    /**
     * 商品排行榜展示
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = model('goods')->order('goods_chu','desc')->select();
        return json(['code'=>200,'msg'=>'查询成功','data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 书写商品详情页面
     */
    public function read($id)
    {
//        $validate = Loader::validate('Validates');
//        if(!$validate->check($id)){
//            dump($validate->getError());
//        }
        $data = model('goods')->where('goods_id',$id)->find();
        return json($data);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }

}
