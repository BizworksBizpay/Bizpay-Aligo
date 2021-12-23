<?php
namespace Bizpay\Aligo;

use UnexpectedValueException;

/**
* @throws UnexpectedValueException     exception handling
**/

class Token
{

    /**
     * The Aligo token API server
     */
    const API_URL = 'https://kakaoapi.aligo.in/akv10/token/create/30/i/';


    /* 
    -----------------------------------------------------------------------------------
    알림톡 토큰 생성
    -----------------------------------------------------------------------------------
    API호출 URL의 유효시간을 결정하며 URL 의 구성중 "30"은 요청의 유효시간을 의미하며, "s"는 y(년), m(월), d(일), h(시), i(분), s(초) 중 하나이며 설정한 시간내에서만 토큰이 유효합니다.
    운영중이신 보안정책에 따라 토큰의 유효시간을 특정 기간만큼 지정할 경우 매번 호출할 필요없이 해당 유효시간내에 재사용 가능합니다.
    주의하실 점은 서버를 여러대 운영하실 경우 토큰은 서버정보를 포함하므로 각 서버에서 생성된 토큰 문자열을 사용하셔야 하며 토큰 문자열을 공유해서 사용하실 수 없습니다.
    */
    /**
     * Registers the given token for the given interest
     *
     * @param $interest
     * @param $token
     *
     * @throws UnexpectedValueException
     *
     * @return string
     */
    public function test()
    {
        $test ="123";
        if($test!=="456"){
            throw new UnexpectedValueException('Wrong number of segments');
        }
        return "autoload 성공!";
    }
}
?>