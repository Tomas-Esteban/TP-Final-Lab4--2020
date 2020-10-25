<?php
namespace API;

class APIController
{    
   public static function callAPI($method, $url, $data)
   {

      $result = $metod.$url.$data;
      echo $result;
      return $result;
   }
}
?>