<?php

namespace App\helper;

class JsonApiHelper 
{
    public static function successResponse($a_data, $a_responseCode = null)
    {
        $iResponseCode = is_numeric($a_responseCode) ? (int) $a_responseCode : 200;
        $aResponseData = [];

        if (!empty($a_data) && is_array($a_data)) {
            $aResponseData = $a_data;
        }

        self::sendResponse('success', $aResponseData, $iResponseCode);
    }

    public static function failResponse($a_data, $a_responseCode = null)
    {
        $iResponseCode = is_numeric($a_responseCode) ? (int) $a_responseCode : 400;
        $aResponseData = [];

        if (!empty($a_data) && is_array($a_data)) {
            $aResponseData = $a_data;
        }

        self::sendResponse('fail', $aResponseData, $iResponseCode);
    }

    public static function errorResponse($a_message, $a_responseCode = null, $a_internalCode = null)
    {
        $iResponseCode    = is_numeric($a_responseCode) ? (int) $a_responseCode : 500;
        $sResponseMessage = '';

        if (!empty($a_message) && is_string($a_message) && !ctype_space($a_message)) {
            $sResponseMessage = $a_message;
        }

        self::sendResponse('error', $sResponseMessage, $iResponseCode, $a_internalCode);
    }

    private static function sendResponse($a_status, $a_data, $a_responseCode, $a_internalCode = null)
    {
        $sStatus        = $a_status;
        $iResponseCode  = $a_responseCode;
        $aResponseArray = [];
        if ($sStatus === 'success' || $sStatus === 'fail') {
            if (is_array($a_data)) {
                $aResponseArray = $a_data;
            } else {
                $sStatus        = 'error';
                $iResponseCode  = 500;

                if (is_object($a_data)) {
                    $aResponseArray = ['The application tried to respond with an object.'];
                } else {
                    $aResponseArray = ['The application tried to respond with malformed data.'];
                }
            }
        } else {
            if (!empty($a_data) && is_string($a_data) && !ctype_space($a_data)) {
                $aResponseArray = [$a_data];
            } else {
                $aResponseArray = ['The request failed due to an unspecified error.'];
            }
        }

        /**
         * Validate and set the final response data.
         */
        $aResponseData = [
            'status' => $sStatus,
        ];

        if ($sStatus === 'success' || $sStatus === 'fail') {
            $aResponseData['data'] = $aResponseArray;
        } else {
            $aResponseData['message'] = (string) @$aResponseArray[0];

            if (is_numeric($a_internalCode)) {
                $aResponseData['code'] = (int) $a_internalCode;
            }
        } 

        $sJsonResponse = self::convertToJson($aResponseData);

        if ($sJsonResponse === false) {
            $sJsonResponse = self::convertToJson([
                'status'  => 'error',
                'message' => 'The application tried to respond with malformed data.'
            ]);
        }

        header('Content-Type: application/json; charset=utf-8');
        http_response_code($iResponseCode);
        echo $sJsonResponse;
        die;
    }

    private static function convertToJson($a_data)
    {
        $iJsonOptions = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK;

        if (isset($_GET['pretty']) && $_GET['pretty'] === 'true') {
            $iJsonOptions += JSON_PRETTY_PRINT;
        }

        return json_encode($a_data, $iJsonOptions);
    }
}
