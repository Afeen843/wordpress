<?php

try {
$soap= new SoapClient('https://soap.ebizcharge.net/eBizService.svc?singleWsdl');

echo '<pre>';



}catch (Exception $e){
$e->getMessage();
}
