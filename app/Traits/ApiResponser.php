<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser{

    public function succesResponse($data, $code = Response::HTTP_OK){
        
        return  response()->json(['data' => $data], $code);
    }

    public function errorResponse($data, $code){
        return  response()->json(['data' => $data, 'code' => $code], $code);
    }

}