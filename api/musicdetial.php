<?php

//引入公用文件
require_once('../include/common.in.php');

//接收音乐id
$id = intval($id);

//查询语句
$sql = "SELECT m.id,musicname,singer,composer,writer,words,price,musicurl,coverurl,dt,cname FROM cgx_music as m LEFT JOIN cgx_class_child as c  ON(m.ccid=c.id) WHERE m.id=$id ORDER BY m.id DESC LIMIT 1";

//执行语句
$msql->execute($sql);

//获取数据
$res = $msql->fetchquery();

//处理星级
$res['stars'] = 5;

//处理评论数
$res['commont_count'] = 0;

echo json_encode($res);
 