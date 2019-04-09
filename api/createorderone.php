<?php

//引入公用文件
require_once('../include/common.in.php');

//下单日期
$dt = time();

//订单入库
$sql = "INSERT INTO cgx_order(openid,pid,catagory,counts,dt) VALUES('".$openID."',$pid,'".$catagory."',1,$dt)";

$msql -> execute($sql);

$as = $msql -> affectedRows();

if($as>0){
    $result='success';
}else{
    $result='fail';
}

echo $result;