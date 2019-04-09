<?php
    //访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//获取ID
$id = intval($id);

//根据ID，查询数据库
$sql = "SELECT cname FROM cgx_class_parent WHERE id=$id LIMIT 1";

//执行语句
$msql -> execute($sql);

//获取数据
$res = $msql -> fetchquery();

//给模板提供数据
$value = $res['cname'];

//载入模板
include 'pages/templates/classparentedit.html';
 