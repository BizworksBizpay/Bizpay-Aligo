<?php

  /*
  -----------------------------------------------------------------------------------
  등록된 템플릿 리스트
  -----------------------------------------------------------------------------------
  등록된 템플릿 목록을 조회합니다. 템플릿 코드가 D 나 P 로 시작하는 경우 공유 템플릿이므로 삭제 불가능 합니다.
  */

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
  echo nl2br($retArr->list[0]->templtContent);
  /*
  code : 0 성공, 나머지 숫자는 에러
  message : 결과 메시지
  */

?>