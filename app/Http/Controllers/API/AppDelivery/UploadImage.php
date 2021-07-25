<?php


namespace App\Http\Controllers\API\AppDelivery;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadImage extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = public_path() . '/data/';
        $file->move($path, $file->getClientOriginalName());
        return response()->json(compact('path'));

    }
}
