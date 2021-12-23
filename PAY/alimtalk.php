<?php

function get_templeate_contents(){
    $_apiURL		=	'https://kakaoapi.aligo.in/akv10/template/list/';
    $_hostInfo	=	parse_url($_apiURL);
    $_port			=	(strtolower($_hostInfo['scheme']) == 'https') ? 443 : 80;
    $_variables	=	array(
        'apikey'    => 'qabj85ftkdpo51pg58wn8hblab92hjmp',
        'userid'    => 'bizro',
        'token'     => '6cbce0cf7930454a50f0330ec6e93b83974f93dcfddce899a40282945ea8481791fb565756858fab0c1d5a5f30d41980eb9f8b3e7c14e75c33016abb4095df9aErwF2dUNr7cxALjMp2XRivL4dJpguK10y0pns34BDIQ5SQuMvreDby2Y+Hm76Lea/LiFQQ/sQJphCML3q1yehA==',
        'senderkey' => 'eaa6ac82fd4834bb3400cea17b16a7de507571f1',
        'tpl_code'  => 'TG_9304'
    );

    $oCurl = curl_init();
    curl_setopt($oCurl, CURLOPT_PORT, $_port);
    curl_setopt($oCurl, CURLOPT_URL, $_apiURL);
    curl_setopt($oCurl, CURLOPT_POST, 1);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($_variables));
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);

    $ret = curl_exec($oCurl);
    $error_msg = curl_error($oCurl);
    curl_close($oCurl);

    // 리턴 JSON 문자열 확인
    //print_r($ret . PHP_EOL);

    // JSON 문자열 배열 변환
    $retArr = json_decode($ret);

    // 결과값 출력
    //print_r($retArr);
    return nl2br($retArr->list[0]->templtContent);
}

//echo get_templeate_contents().'<br>';
//exit;
/* 
-----------------------------------------------------------------------------------
알림톡 전송
-----------------------------------------------------------------------------------
버튼의 경우 템플릿에 버튼이 있을때만 버튼 파라메더를 입력하셔야 합니다.
버튼이 없는 템플릿인 경우 버튼 파라메더를 제외하시기 바랍니다.
*/

$_apiURL    =	'https://kakaoapi.aligo.in/akv10/alimtalk/send/';
$_hostInfo  =	parse_url($_apiURL);
$_port      =	(strtolower($_hostInfo['scheme']) == 'https') ? 443 : 80;
$_variables =	array(
  'apikey'      => 'qabj85ftkdpo51pg58wn8hblab92hjmp', 
  'userid'      => 'bizro', 
  'token'       => 'f4d488983feed5fc53cc668e23c9758356f396794f5a2e08e0f60bf28b0338360f4164f7bccd29f34be52bb39d3bf1659a7b96fe1c067132be2003fd6380dd1e2abX2GhUYVRjVwjHkYBR5QHvZJyLHI5SgUayIXJO3lgfwdZse5sMh3zo/Ms65M9dISVvHq4+h9FOr/T2yWdkOQ==', 
  'senderkey'   => 'eaa6ac82fd4834bb3400cea17b16a7de507571f1', 
  'tpl_code'    => 'TG_9304',
  'sender'      => '01077532936',
  //'senddate'    => date("YmdHis", strtotime("+10 minutes")),
  'receiver_1'  => '01041574503',
  'recvname_1'  => '이민주',
  'subject_1'   => '급여명세서테스트',
  
  'message_1'   => '#{귀속년월} 급여 명세서
  #{회사명}
  안녕하세요. #{직원명}님!
  
  귀하의 노고에
  진심으로 감사드립니다~',
  'button_1'    => '{"button":[{"name":"급여명세서 보기","linkType":"WL","linkP":"https://print.payrollok.co.kr/KAKAO/PAY/Pay.php/WVlZWU1NJTNEMjAyMTEyJTI2Q09ERSUzRDIwMjcwMDAxJTI2RU1QX05PJTNEQTAwMDAwNDMlMjZDT0RFX1NVUFBMWSUzREEwMDE=", "linkM": "https://print.payrollok.co.kr/KAKAO/PAY/Pay.php/WVlZWU1NJTNEMjAyMTEyJTI2Q09ERSUzRDIwMjcwMDAxJTI2RU1QX05PJTNEQTAwMDAwNDMlMjZDT0RFX1NVUFBMWSUzREEwMDE="}]}
  ', // 템플릿에 버튼이 없는경우 제거하시기 바랍니다.
  
);

/*

-----------------------------------------------------------------
치환자 변수에 대한 처리
-----------------------------------------------------------------

등록된 템플릿이 "#{이름}님 안녕하세요?" 일경우
실제 전송할 메세지 (message_x) 에 들어갈 메세지는
"홍길동님 안녕하세요?" 입니다.

카카오톡에서는 전문과 템플릿을 비교하여 치환자이외의 부분이 일치할 경우
정상적인 메세지로 판단하여 발송처리 하는 관계로
반드시 개행문자도 템플릿과 동일하게 작성하셔야 합니다.

예제 : message_1 = "홍길동님 안녕하세요?"

-----------------------------------------------------------------
버튼타입이 WL일 경우 (웹링크)
-----------------------------------------------------------------
링크정보는 다음과 같으며 버튼도 치환변수를 사용할 수 있습니다.
{"button":[{"name":"버튼명","linkType":"WL","linkP":"https://www.링크주소.com/?example=12345", "linkM": "https://www.링크주소.com/?example=12345"}]}

-----------------------------------------------------------------
버튼타입이 AL 일 경우 (앱링크)
-----------------------------------------------------------------
{"button":[{"name":"버튼명","linkType":"AL","linkI":"https://www.링크주소.com/?example=12345", "linkA": "https://www.링크주소.com/?example=12345"}]}

-----------------------------------------------------------------
버튼타입이 DS 일 경우 (배송조회)
-----------------------------------------------------------------
{"button":[{"name":"버튼명","linkType":"DS"}]}

-----------------------------------------------------------------
버튼타입이 BK 일 경우 (봇키워드)
-----------------------------------------------------------------
{"button":[{"name":"버튼명","linkType":"BK"}]}

-----------------------------------------------------------------
버튼타입이 MD 일 경우 (메세지 전달)
-----------------------------------------------------------------
{"button":[{"name":"버튼명","linkType":"MD"}]}

-----------------------------------------------------------------
버튼이 여러개 인경우 (WL + DS)
-----------------------------------------------------------------
{"button":[{"name":"버튼명","linkType":"WL","linkP":"https://www.링크주소.com/?example=12345", "linkM": "https://www.링크주소.com/?example=12345"}, {"name":"버튼명","linkType":"DS"}]}

*/

$oCurl = curl_init();
curl_setopt($oCurl, CURLOPT_PORT, $_port);
curl_setopt($oCurl, CURLOPT_URL, $_apiURL);
curl_setopt($oCurl, CURLOPT_POST, 1);
curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($_variables));
curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);

$ret = curl_exec($oCurl);
$error_msg = curl_error($oCurl);
curl_close($oCurl);

// 리턴 JSON 문자열 확인
print_r($ret . PHP_EOL);

// JSON 문자열 배열 변환
$retArr = json_decode($ret);

// 결과값 출력
print_r($retArr);

/*
code : 0 성공, 나머지 숫자는 에러
message : 결과 메시지
*/
?>