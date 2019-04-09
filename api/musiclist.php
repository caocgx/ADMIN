<?php

//引入公用文件
require_once('../include/common.in.php');

//接收ccid
$ccid = intval($ccid);

// echo $id;


//初始化
$arrTemp = array();

//查询语句
if($ccid){
    $sql = "SELECT id,musicname,singer,composer,writer,price,musicurl,coverurl,dt FROM cgx_music WHERE ccid=$ccid ORDER BY id DESC LIMIT 0,20";
}else{
 
    $sql = "SELECT id,musicname,singer,composer,writer,price,musicurl,coverurl,dt FROM cgx_music ORDER BY id DESC LIMIT 0,20";

}


//执行语句
$msql->execute($sql);

//获取数据
while ($res = $msql->fetchquery()) {

    //处理价格
        //分割
        $price = explode('.', $res['price']);
        //整数部分
        $res['price_int']  = $price[0];
        //小数部分
        $res['price_float'] = $price[1];

    //处理星级
    $res['stars'] = 5;

    //处理评论数
    $res['commont_count'] = 0;

    $arrTemp[] = $res;
}


//转换成json格式
echo json_encode($arrTemp);
