<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 17/9/7
 * Time: 下午11:15
 */

namespace Admin\Model;

/**
 * Class CategoyModel
 * @package Admin\Model
 * 分类模型
 */
class CategoryModel extends CommonModel {
    //自定义字段
    protected $fields = array('id','cname','parent_id','isrec');
    //自动验证
    protected $_validate = array(
        array('cname','require','分类名称必须填写'),
    );

    //获取格式化之后的数据
    public function getCateTree($id = 0) {
        //获取所有的分类信息
        $data = $this->select();
        //在对获取的信息进行格式化
        $list = $this->getTree($data,$id);
        return $list;
    }

    //格式化分类信息
    public function getTree($data,$id=0,$lev=1) {
        static $list = array();
        foreach ($data as $key => $value) {
            if($value['parent_id'] == $id) {
                $value['lev'] = $lev;
                $list[] = $value;
                $this->getTree($data,$value['id'],$lev+1);
            }
        }
        return $list;

    }

    public function dels($id) {
        $result = $this->where('parent_id='.$id)->find();
        if($result) {
            return false;
        }
        return $this->where('id='.$id)-$this->delete();
    }

    public function update($data) {
        $tree = $this->getCateTree($data['id']);
        $tree[] = array('id'=>$data['id']);
        foreach ($data as $key => $value) {
            if($data['parent_id'] == $value['id']) {
                $this->error = '不能设置子类分类为父分类';
                return false;
            }
        }
        return $this->save($data);
    }
}