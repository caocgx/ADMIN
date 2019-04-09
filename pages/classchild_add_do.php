<?php

//页面编码
header("Content-type:text/html;charset=utf8");

//访问限制
if (!defined('WWWROOT')) {
    die('request not allowed!');
}

//接收表单数据
$cid = intval($cid);
$tittle = trim($title);


//数据入库
$sql = "INSERT INTO cgx_class_child(cid,cname) VALUES($cid,'" . $title . "')";

//执行语句
$msql->execute($sql);

//验证数据是否已入库
$res = $msql->affectedRows();

$msql->error();

if ($res > 0) {
    $result = '创建成功！';
} else {
    $result = '创建失败！';
}

include 'pages/templates/classchild_add_do.html';
