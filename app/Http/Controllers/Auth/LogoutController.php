<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function doLogout() {
        Session::forget( 'auth' );

        return redirect( '/' );
    }

}
