<?php
$ReceiveServer = "https://print.payrollok.co.kr/KAKAO/PAY/Pay.php";
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD']; 
$pathInfo = $_SERVER['PATH_INFO']; 

$login_data = str_replace("/","",$pathInfo);


//인코딩 처리
$data = "PROGRAM=BIZPAY&YYYYMM=202112&CODE=20270001&EMP_NO=A0000043&CODE_SUPPLY=A001";  // 전송 데이터(get 형식)
$get_data = base64_encode(urlencode($data));

//echo $ReceiveServer."/".$get_data.'<br>';
//디코팅 처리
if($login_data)
{
   $vars    = explode("&",urldecode(base64_decode($login_data)));
   $vars_num  = count($vars);
   for($i=0;$i<$vars_num;$i++)
   {
      $elements = explode("=",$vars[$i]);
      $logindataArr[$elements[0]]=$elements[1];
   }
   $PROGRAM            = $logindataArr[PROGRAM];
   $YYYYMM            = $logindataArr[YYYYMM];
   $CODE              = $logindataArr[CODE];
   $EMP_NO            = $logindataArr[EMP_NO];
   $CODE_SUPPLY       = $logindataArr[CODE_SUPPLY];
   
   echo $PROGRAM.'<br>';
   echo $YYYYMM.'<br>';
   echo $CODE.'<br>';
   echo $EMP_NO.'<br>';
   echo $CODE_SUPPLY.'<br>';  
}
?>