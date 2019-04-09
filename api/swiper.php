<?


//引入公用文件
require_once('../include/common.in.php');

$tempArr = array();

$sql = "SELECT id,photo,gourl FROM cgx_swiper";

$msql -> execute($sql);

while($res = $msql->fetchquery()){
     
    $tempArr[] = $res;

}

echo json_encode($tempArr);
 