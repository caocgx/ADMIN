<?php

//引入公用文件
require_once('../include/common.in.php');

//评论日期
$dt = time();


if ($action == 'add') {
    //入库
    $sql = "INSERT INTO cgx_comment(catagory,pid,openid,stars,notes,dt)VALUES('" . $catagory . "',$pid,'" . $openID . "','" . $starNum . "','" . $content . "',$dt)";

}

if($action == 'edit'){
    //修改
    $sql = "UPDATE cgx_comment SET stars=$starNum,notes='".$content."'";
}

$msql->execute($sql);

$msql -> error();

$as = $msql -> affectedRows();

if($as>0){
    $result = 'success';
}else{
    $result = 'fail';
}


echo $result;
