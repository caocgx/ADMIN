<?

//引入公用文件
require_once('../include/common.in.php');

//接收openID
$openID = trim($openID);

//查询语句
$sql = "SELECT id,uname,tel,address,postcode,header FROM cgx_user WHERE openid='".$openID."' LIMIT 1";

$msql -> execute($sql);

//获取数据
$res = $msql -> fetchquery();

//返回JSON
echo json_encode($res);