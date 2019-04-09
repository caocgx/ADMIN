<?php

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//接收ID
$id = intval($id);

//初始化
$data = '';

//根据ID从数据中读取该一级分类下的二级分类
$sql = "SELECT id,cname FROM cgx_class_child WHERE cid = $id";

//执行语句
$msql->execute($sql);

while ($res = $msql->fetchquery()) {

    $datas .= '<option value="' . $res['id'] . '">' . $res['cname'] . '</option>';
}

echo $datas;
 