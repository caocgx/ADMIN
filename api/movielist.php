<?

//引入公用文件
require_once('../include/common.in.php');

//接收参数类型ID，国家ID
$sname = trim($sname);
$cname = trim($cname);

// echo $sname.'/'.$cname;

$where = '';
$datas=$tempArr=$movieclass=$style=$country= array();

if($sname !='allstyle'){
    $where .=" AND class_style = '".$sname."'";
}

if($cname !='allcountry'){
    $where .=" AND class_country = '".$cname."'";
}


//列表查询语句
$sql = "SELECT id,class_style,class_country,moviename,director,writer,roles,price,longs,coverurl 
        FROM cgx_movie WHERE 1 $where LIMIT 0,20";

$msql -> execute($sql);
// $msql ->error();

while($res = $msql->fetchquery()){

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
     
    $tempArr[] = $res;

}

//分类查询--类型
$sql = "SELECT id,cid,cname FROM cgx_class_child WHERE cid=22 ";

$msql -> execute($sql);

while($res = $msql->fetchquery()){
    if($res['cid'] ==  22){
        if($res['cname'] == $sname){
            $res['activestyle'] = 'active_class';
        }else{
            $res['activestyle'] = '';
        }
    }
    $style[]= $res;
}

//分类查询--国家
$sql = "SELECT id,cid,cname FROM cgx_class_child WHERE cid = 24";

$msql -> execute($sql);

while($res = $msql->fetchquery()){

    if($res['cid'] ==  24){
        if($res['cname'] == $cname){
            $res['activecountry'] = 'active_country';
        }else{
            $res['activecountry'] = '';
        }
    }
    $country[] = $res;
}


$movieclass['style']= $style;
$movieclass['country']= $country;

$datas['list'] = $tempArr;
$datas['movieclass'] = $movieclass;



echo json_encode($datas);
 