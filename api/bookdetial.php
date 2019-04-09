<?php

//引入公用文件
require_once('../include/common.in.php');

//接收小程序传递的ID
$id = intval($id);

//初始化
$tempArr = array();

//查询语句
$sql = "SELECT b.id,ccid,bookname,author,publicer,price,descript,cname FROM cgx_book as b LEFT JOIN cgx_class_child as c ON(b.ccid = c.id) WHERE b.id=$id LIMIT 1";

//执行语句
$msql->execute($sql);

//获取数据
$res = $msql->fetchquery();

//处理价格
    //分割
    $price = explode('.', $res['price']);
    //整数部分
    $res['price_int']  = $price[0];
    //小数部分
    $res['price_float'] = $price[1];

//处理封面
$sql1 = "SELECT coverurl FROM cgx_cover WHERE bookid=$id";
//执行
$msql -> execute($sql1);
//抓取数据
while($rex = $msql->fetchquery()){
    $tempArr[] = $rex;
}
$res['cover'] = $tempArr;

//转换成json格式
echo json_encode($res);

