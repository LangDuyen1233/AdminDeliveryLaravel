<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Session::get('auth');
        $userAdmin = User::where('id', $user->id)->with('address')->first();
        return view('auth.profile',
            [
                'user' => $user,
                'userAdmin' => $userAdmin,
            ]
        );
    }

    public function update(Request $request)
    {

        $request->validate([
            'dob' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'username' => 'required',
        ], $this->messages());
        try {
            $username = $request->get('username');
//            $email = $request->get('email');
            $phone = $request->get('phone');
            $gender = $request->get('gender');
            $dob = date("Y-m-d", strtotime($request->get('dob')));
            $bio = $request->get('bio');

            $user = User::find($request->id);
            $user->username = $username;
//            $user->email = $email;
            $user->phone = $phone;
            $user->gender = $gender;
            $user->dob = $dob;
            $user->bio = $bio;

            $user->update();

            Session::put('auth',$user);
            $_SESSION['auth']  = true;

//            dd($user);

            return redirect('profile')->withErrors(['mes' => "Chỉnh sửa thông tin thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'username.required' => 'Bạn cần nhập họ tên',
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email' => 'Định dạng Email bị sai.',
            'email.unique' => 'Email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'address.required' => 'Bạn cần phải nhập địa chỉ.',
            'detail.required' => 'Bạn cần phải nhập địa chỉ.',
            'password.required' => 'Bạn cần phải nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải nhiều hơn 8 ký tự.',
            're_password.same' => 'Nhắc lại mật khẩu không trùng với mật khẩu',
            're_password.required' => 'Bạn cần nhập nhắc lại mật khẩu',
            'phone.required' => 'Bạn cần phải nhập số điện thoại.',
            'phone.min' => 'Số điện thoại phải lớn hơn 10 số.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];
    }
}
