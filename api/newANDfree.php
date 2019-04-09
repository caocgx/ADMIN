<?php

//引入公用文件
require_once('../include/common.in.php');

//查询语句
$sql = "SELECT b.id,bookname,price,coverurl,freepost FROM cgx_book as b LEFT JOIN cgx_cover as c ON(b.id =c.bookid) GROUP BY b.id ORDER BY b.freepost DESC,
b.id DESC LIMIT 0,3";

$msql->execute($sql);

while ($res = $msql->fetchquery()) {

     //处理价格
        //分割
        $price = explode('.', $res['price']);
        //整数部分
        $res['price_int']  = $price[0];
        //小数部分
        $res['price_float'] = $price[1];


    $tempArr[] = $res;

 }


echo json_encode($tempArr);

