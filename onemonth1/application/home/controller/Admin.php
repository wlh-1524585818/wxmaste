<?php

namespace app\home\controller;

use think\Controller;
use think\Request;

class Admin extends Controller
{
    /**
     *跳转登录页面
     */
    public function login()
    {
        //返回登录页面
        return view('login');
    }

    /**
     * 验证账号密码是否正确.
     */
    public function logins(Request $request)
    {
        $param = \request()->param();
        $admin_name = model('admin')->where('admin_name',$param['admin_name'])->select();
        if ($admin_name){
            $admin_pas = model('admin')->where('admin_pas',md5(md5($param['admin_pas'])))->find();
            if ($admin_pas){
                return json(['code'=>200,'msg'=>'登录成功']);
            }else{
                return json(['code'=>500,'msg'=>'密码错误']);
            }
        }else{
            return json(['code'=>500,'msg'=>'账户不存在']);
        }
    }
    /*
     * 管理员商品列表
     */
    public function adminList(){
        $data = model('goods')->paginate(2);
        return view('adminList',['data'=>$data]);
    }
    /*
     * 商品添加页面
     */
    public function create()
    {
        //返回添加表单
        return view('create');
    }
    public function save(Request $request){
        //接收数据
        $param = \request()->param();
        $file = request()->file('goods_img');
        dump($file);
        //书写判断名称是否为空和id格式
        $validate = $this->Validate($param,[
            'goods_name|商品名称'=>"require",
            'goods_number|商品库存'=>"integer"
        ]);
        //判断
        if ($validate!==true){
            $this->error($validate);
        }
        if($file){
            $info = $file->move(ROOT_PATH . 'public');
            if($info){
                // 成功上传后 获取上传信息
                $data['goods_img'] = $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        //拼接数组
        $data['goods_name'] = $param['goods_name'];
        $data['goods_number'] = $param['goods_number'];
        $data['goods_price'] = $param['goods_price'];
        dump($data);
        //进行添加
        $data = model('goods')->create($param,true);
        if ($data){
            $this->redirect('Admin/adminList');
        }
    }
    /*
     * 软删除
     */
    public function delete($id){
        //进行删除
        $data=\app\home\model\Goods::destroy($id);
        //删除成功跳转
        if($data) {
            $this->redirect('Admin/adminList');
        }else{
            $this->error("网络出现波动");
        }
    }
}
