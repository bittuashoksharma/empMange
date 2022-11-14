<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccessResponse($result, $message)
    {
        $response = ['success' => true, 'data'    => $result, 'message' => $message];
      return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($errorData = [], $message,  $code = 404, $otherParams = [])
    {
        $response = ['success' => false,'message' => $message];
        if(!empty($errorData)){
            $response['data']['errors'] = $errorData;
            $response['data']['otherParams'] = $otherParams;
        }
        return response()->json($response, $code);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendValidationError($errorData = [], $message,  $code = 404, $otherParams = [])
    {
        $response = ['success' => false,'message' => $message];
        if(!empty($errorData)){
            $response['errors']= $errorData;
            $response['data']['otherParams'] = $otherParams;
        }
        return response()->json($response, $code);
    }
    /**
     * [encrypt description]
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    public function encrypt($string)
    {
        return Crypt::encryptString($string);
    }
    /**
     * [decrypt description]
     * @param  [type] $string [description]
     * @return [type]         [description]
     */
    public function decrypt($string)
    {
        return Crypt::decryptString($string);
    }
}
