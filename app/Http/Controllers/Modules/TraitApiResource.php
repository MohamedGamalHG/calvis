<?php


namespace App\Http\Controllers\Modules;


trait TraitApiResource
{
    function ApiResource($data,$msg,$code)
    {
        return response()->json([
            'data'      => $data,
            'msg'       => $msg,
            'code'      => $code
        ]);
    }

}
