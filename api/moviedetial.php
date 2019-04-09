<?

//引入公用文件
require_once('../include/common.in.php');

//接收参数ID
$id = intval($id);


$sql = "SELECT id,class_style,class_country,moviename,director,writer,roles,price,longs,coverurl,movieurl,descript FROM cgx_movie WHERE id=$id LIMIT 1";

$msql -> execute($sql);

$res = $msql->fetchquery();

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

echo json_encode($res);
 