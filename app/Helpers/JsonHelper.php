<?php


namespace App\Helpers;


/**
 * Class JsonHelper
 * @package App\Helpers
 */
class JsonHelper
{
    /**
     * @param array $arrayToConvert
     * @return false|string
     */
    public function encodeArrayToJSON(array $arrayToConvert)
    {
        return json_encode($arrayToConvert);
    }

    /**
     * @param string $jsonString
     * @return mixed
     */
    public function decodeJSONString(string $jsonString)
    {
        return json_decode($jsonString);
    }
}
