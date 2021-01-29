// index.js
// 获取应用实例
const app = getApp()

Page({
  data: {
    //设置数组接收数据
    goods:[]
  },
  onLoad() {
    var goods = this.data.goods
    var that =this
    // 调用接口获得数据
    wx.request({
      url: 'http://www.onemonth.com/goods',
      method:'GET',
      success(res){
      //成功后打印数据
      console.log(res.data.data)
      goods =res.data.data
      that.setData({goods})
      }
    })
  },
  // 触摸事件
  click(res){
    let goods_id = res.currentTarget.dataset.goods_id
    console.log(goods_id)
    wx.navigateTo({
      url: '/pages/info/info?goods_id='+goods_id,
    })
  }
})
