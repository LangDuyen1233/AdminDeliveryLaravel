<?php


namespace App\Http\Controllers;
//
use App\Import\UserImport;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->with('address')->get();
//        dd($users->role->name);
        return view('user.users',
            [
                'users' => $users,
            ]
        );
    }

    public function create()
    {
        return View('user.addUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:100',
            'address' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
            'phone' => 'required|numeric|min:11'
        ], $this->messages());
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $address = $request->get('address');
        $dob = $request->get('dob');
        $phone = $request->get('phone');
        $gender = $request->get('gender');
        $bio = $request->get('bio');
        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
//            'address' => $address,
            'dob' => date("Y-m-d", strtotime($dob)),
            'phone' => $phone,
            'gender' => $gender,
            'bio' => $bio,
            'active' => $request->get('status'),
            'role_id' => $request->get('role_id'),
            'is_delete' => 1,
        ]);
//        dd($user);
        $user->save();
        $addresses = [new Address(['address' => $address, 'user_id' => $user->id, 'status' => 1])];
        $user->address()->saveMany($addresses);
        return redirect('admin-user')->withErrors(['mes' => "Thêm người dùng thành công"]);
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->with('address')->first();
//        dd($users);
        return View('user.editUser',
            [
                'users' => $users,
            ]);
    }

    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return response('', 400);
        }
        $u = User::find($id);
        if (!isset($u)) {
            return response('', 404);
        }
        $request->validate([
            'username' => 'required|max:100',
            'address' => 'required|max:100',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ], $this->messages());
        try {
            error_log($u);
            $u->username = $request->get('username');
            $u->email = $request->get('email');
            $u->dob = $request->get('dob');
            $u->phone = $request->get('phone');
            $u->gender = $request->get('gender');
            $u->bio = $request->get('bio');
            $u->active = $request->get('status');
            $u->role_id = $request->get('role_id');

            $count = 0;

            foreach ($u->address as $add) {

                if ($add->status == 1) {
                    error_log($add->address);
                    $u->address[$count]->update(['address' => $request->get('address')]);
                }
                $count++;
            }
            $u->save();
//            $u->address()
            return redirect('admin-user')->withErrors(['mes' => "Cập nhật người dùng thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {

        $u = User::find($id);

        try {
            if ($u->active == 0) {
                $u->active = 1;
                $u->update();
            } else {
                $u->active = 0;
                $u->update();
            }
            return redirect()->back()->withErrors(['mes' => "Xóa người dùng thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    public function import(Request $r)
    {
        if ($r->data == '' || $r->data == null) {
            return redirect(route('admin-user.index'))->witherrors([
                'mes' => ' Không có dữ liệu! ',
            ]);
        }
        $ui = new UserImport();
//        dd($ui->count);
        try {
            Excel::import($ui, $r->file('data'));
            error_log($ui->count);
//
            return redirect('admin-user')->withErrors(['mes' => 'Nhập thành công ' . $ui->count . ' người dùng.']);
        } catch (NoTypeDetectedException $e) {
            return redirect('admin-user')->withErrors(['mes' => 'Nhập người dùng Lỗi, Vui lòng kiểm tra lại File Excel']);
        }
    }

    private function messages()
    {
        return [
            'username.required' => 'Bạn cần nhập họ tên',
            'email.required' => 'Bạn cần phải nhập Email.',
            'email.email' => 'Định dạng Email bị sai.',
            'email.unique' => 'Email đã tồn tại',
            'address.required' => 'Bạn cần phải nhập địa chỉ.',
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
