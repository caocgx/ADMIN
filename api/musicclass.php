<?php

//引入公用文件
require_once('../include/common.in.php');

//初始化
$arrTemp = array();

//查询语句
$sql = "SELECT id,cname FROM cgx_class_child WHERE cid=21";

//执行语句
$msql -> execute($sql);

//获取数据
while($res = $msql -> fetchquery()){

    $arrTemp[] = $res;

}

// 返回json

echo json_encode($arrTemp);

?>