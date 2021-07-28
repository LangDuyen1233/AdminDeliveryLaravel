<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadImage extends Controller
{
    public function uploadImage(Request $request)
    {
        $file = $request->file('image');
        error_log($file);
        $path = public_path() . '/data/files/';
        error_log($file->getClientOriginalName());
        $file->move($path, $file->getClientOriginalName());
        return response()->json(['namefile' => $file->getClientOriginalName()], 200);
    }

    public function uploadAvatar(Request $request)
    {
        $file = $request->file('image');
        error_log($file);
        $path = public_path() . '/data/avatar/';
        error_log($file->getClientOriginalName());
        $file->move($path, $file->getClientOriginalName());
        return response()->json(['namefile' => $file->getClientOriginalName()], 200);
    }
}
