<?php 

namespace Util;

use Api\ApiController as APIController;

class ApiResponse
{
    public static function HomologatesApiResponse($ApiRequest)
    {
        $get_data = API_MAIN_LINK . $ApiRequest. API_KEY;
        $json = json_decode(file_get_contents($get_data),true);
        return $json;
    }
}

?>