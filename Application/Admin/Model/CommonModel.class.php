<?php
/**
 * Created by PhpStorm.
 * User: Lin
 * Date: 17/9/7
 * Time: 下午11:13
 */

namespace Admin\Model;
use Think\Model;

class CommonModel extends Model{

    //根据id获取指定的数据
    public function findOneById($id) {
        return $this->where('id='.$id)->find();
    }
}