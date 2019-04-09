<?php

//引入公用文件
require_once('../include/common.in.php');

//接收小程序的订单数据
$openID  = $openID;
$datas = json_decode(stripslashes($datas), true);
$result = 'success';

// echo $openID.$datas;

//数据提取及入库
foreach ($datas as $key => $item) {

    //分类名称
    $catagory = $key;

    if (count($item)) {


        //遍历内容
        foreach ($item as $item2) {

            //产品ID
            $pid = $item2['pid'];
            //产品数量
            $count = $item2['count'];
            //下单日期
            $dt = time();

            //入库
            $sql = "INSERT INTO cgx_order(openid,catagory,pid,counts,dt) VALUES ('" . $openID . "','" . $catagory . "',$pid,$count,$dt)";
            //执行语句
            $msql->execute($sql);
            //返回结果
            $as = $msql->affectedRows();

            if ($as < 1) {
                $result = 'fail';
            }
        }
    }
}

echo $result;
