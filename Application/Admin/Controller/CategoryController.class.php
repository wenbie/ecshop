<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 17/9/7
 * Time: 下午11:09
 */

namespace Admin\Controller;

class CategoryController extends CommonController {

    //实现分类的添加
    public function add() {
        if(IS_GET) {
            //获取格式化之后的分类信息
            $model = D('Category');

            $cate = $model->getCateTree();
            //将信息赋值给模板
            $this->assign('cate',$cate);
            $this->display('Category/add');
        }else {
            //数据入库
            $model = D('Category');
            //创建数据
            $data = $model->create();
            if(!$data) {
                $this->error($model->getError());
            }
            $insertid = $model->add($data);
            if(!$insertid) {
                $this->error('数据写入失败');
            }
            $this->success('写入成功');

        }
    }

    public function index() {

        $model = D('Category');
        $list = $model->getCateTree();
        $this->assign('list',$list);

        $this->display('Category/index');
    }

    public function dels() {
        $id = intval(I('get.id'));
        if($id<=0) {
            $this->error('参数不对');
        }
        $model = D('Category');
        //调用模型中的删除方法
        $res = $model->dels($id);
        if($res === false) {
            $this->error('删除失败');
        }
        $this->success('删除成功');
    }

    public function edit() {
        if(IS_GET){
            $id = intval(I('get.id'));
            //
            $model = D('Category');
            $info = $model->findOneById($id);
            $this->assign('info',$info);
            //获取所有的分类信息
            $cate = $model->getCateTree();
            $this->assign('$cate',$cate);
            $this->display();
        }else {
            $model = D('Category');
            $data = $model->create();
            $res = $model->update($data);
            if($res === false) {
//                $this->error('修改失败');
                $this->error($model->getError());
            }else {

                $this->success('修改成功');
            }
        }
    }
}