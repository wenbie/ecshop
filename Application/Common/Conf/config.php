<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'MODULE_ALLOW_LIST'     =>  array('Home','Admin'),
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC_ADMIN__' => '/PUBLIC/Admin'
    ),

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'jxshop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'jx_',    // 数据库表前缀


);