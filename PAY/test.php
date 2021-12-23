<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );
require '../vendor/autoload.php';

use Bizpay\Aligo\Token;


$test = Token::test();

echo $test.'<br>';
?>