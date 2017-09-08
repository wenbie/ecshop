<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 17/9/8
 * Time: 上午2:42
 */

namespace Admin\Controller;

class GoodsController extends CommonController {
    public function add()
    {
        if(IS_GET){
            //获取所有的分类信息
            $cate = D('Category')->getCateTree();
            $this->assign('cate',$cate);
            $this->display();
            exit();
        }
        $model = D('Goods');
        $data = $model->create();
        if(!$data){
            $this->error($model->getError());
        }
        // $data['addtime']=time();
        $goods_id = $model->add($data);
        if(!$goods_id){
            $this->error($model->getError());
        }
        $this->success('添加成功');
    }
}