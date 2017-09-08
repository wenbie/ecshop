<?php
namespace Admin\Model;
use Think\Upload;

/**
 * 分类模型
 */
class GoodsModel extends CommonModel
{

    //自定义字段
    protected $fields=array('id','goods_name','goods_sn','cate_id','market_price','shop_price','goods_img','goods_thumb','goods_body','is_hot','is_rec','is_new','addtime','isdel','is_sale');
    //自定义自动验证
    protected $_validate=array(
        array('goods_name','require','商品名称必须填写',1),
        array('cate_id','checkCategory','分类必须填写',1,'callback'),
        array('market_price','currency','市场价格格式不对'),
        array('shop_price','currency','本店价格格式不对'),
    );
    //对分类进行验证
    public function checkCategory($cate_id)
    {
        $cate_id = intval($cate_id);
        if($cate_id>0){
            return true;
        }
        return false;
    }
    //使用TP的钩子函数
    public function _before_insert(&$data)
    {
        //添加时间
        $data['addtime']=time();

        //处理货号
        if(!$data['goods_sn']){
            //没有题号货号自动生成
            $data['goods_sn'] = 'JX'.uniqid();
        }else{
            //有提交货号
            $info = $this->where('goods_sn='.$data['goods_sn'])->find();
            if($info){
                $this->error='货号重复';
                return false;
            }
        }
        //实现图片上传
        $upload = new Upload();
        $info = $upload->uploadOne($_FILES['goods_img']);
        if(!$info){
            $this->error=$upload->getError();
        }
        //在代码中图片的地址使用不用使用/ 在html代码中显示图片时必须使用/ 表示域名对应的根目录
        //上传之后的图片地址
        $goods_img = 'Uploads/'.$info['savepath'].$info['savename'];

        //实现缩略图的制作
        $img = new \Think\Image();
        //打开图片
        $img->open($goods_img);

        //制作缩略图
        $goods_thumb = 'Uploads/'.$info['savepath'].'thumb_'.$info['savename'];
        $img->thumb(450,450)->save($goods_thumb);
        $data['goods_img'] = $goods_img;
        $data['goods_thumb'] =  $goods_thumb;
    }


}