<?php

//引入公用文件
require_once('../include/common.in.php');

//查询销量最高的6首歌曲
$sql  = "SELECT m.id,pid,sum(counts) as total,musicname,price,coverurl FROM cgx_order as o LEFT JOIN cgx_music as m ON(o.pid=m.id) WHERE catagory = 'music' GROUP BY pid ORDER BY total DESC LIMIT 0,6";

$msql->execute($sql);

while ($res = $msql->fetchquery()) {

    // //处理星级
    // $pid = $res['pid'];

    // $sql = "SELECT AVG(stars) as avgstars FROM cgx_commont WHERE catagory='music' AND pid=$pid";

    // $msql->execute($sql,'xxx');

    // $res_star = $msql ->fetchquery('xxx');

    // //如果没有评论
    // $res_star['avgstars'] = $res_star['avgstars']?$res_star['avgstars']:5;

    // $res['stars'] =ceil($res_star['avgstars']);

    $tempArr[] = $res;
}

echo json_encode($tempArr);

