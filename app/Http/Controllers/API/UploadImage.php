<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadImage extends Controller
{
    public function uploadImage(Request $request)
    {
        $file = $request->file('image');
        $path = public_path() . '/data/files/';
        $file->move($path, $file->getClientOriginalName());
        return response()->json(['namefile' => $file->getClientOriginalName()], 200);
    }

    public function uploadAvatar(Request $request)
    {
        $file = $request->file('image');
        $path = public_path() . '/data/avatar/';
        $file->move($path, $file->getClientOriginalName());
        return response()->json(['namefile' => $file->getClientOriginalName()], 200);
    }
}
