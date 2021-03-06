<?php


namespace App\Http\Controllers;
use App\Import\UserImport;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $usersList = User::with('role')->with('address')->get();
        $user = Session::get('auth');
        return view('user.users',
            [
                'usersList' => $usersList,
                'user'=>$user,
            ]
        );
    }

    public function create()
    {
        $user = Session::get('auth');
        return View('user.addUser',
        [
            'user'=>$user,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:100',
            'address' => 'required|max:100',
            'detail' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
            'phone' => 'required|numeric|min:11|unique:users'
        ], $this->messages());
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $address = $request->get('address');
        $detail = $request->get('detail');
        $dob = $request->get('dob');
        $phone = $request->get('phone');
        $gender = $request->get('gender');
        $bio = $request->get('bio');
        $user = new User([
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'dob' => date("Y-m-d", strtotime($dob)),
            'phone' => $phone,
            'gender' => $gender,
            'bio' => $bio,
            'active' => $request->get('status'),
            'role_id' => $request->get('role_id'),
            'is_delete' => 1,
        ]);
        $user->save();
        $addresses = [new Address(['detail' => $detail, 'address' => $address, 'user_id' => $user->id, 'status' => 1])];
        $user->address()->saveMany($addresses);
        return redirect('admin-user')->withErrors(['mes' => "Th??m ng?????i d??ng th??nh c??ng"]);
    }

    public function edit($id)
    {
        $users = User::where('id', $id)->with('address')->first();
        $user = Session::get('auth');
        return View('user.editUser',
            [
                'users' => $users,
                'user'=>$user,
            ]);
    }

    public function update(Request $request, $id)
    {
        if (!isset($id)) {
            return response('', 400);
        }
        $u = User::where('id', $id)->with('address')->first();
        if (!isset($u)) {
            return response('', 404);
        }
        $request->validate([
            'username' => 'required|max:100',
            'address' => 'required|max:100',
            'detail' => 'required|max:100',
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

            if (count($u->address) == 0) {
                $a = new Address([
                    'detail' => $request->get('detail'),
                    'address' => $request->get('address'),
                    'user_id' => $u->id,
                    'status' => 1,
                ]);

                $u->address()->save($a);
            } else {
                foreach ($u->address as $add) {
                    if ($add->status == 1) {
                        error_log($add->address);
                        $u->address[$count]->update(['address' => $request->get('address')]);
                        $u->address[$count]->update(['detail' => $request->get('detail')]);
                    }
                    $count++;
                }
            }

            $u->save();
            return redirect('admin-user')->withErrors(['mes' => "C???p nh???t ng?????i d??ng th??nh c??ng"]);

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
            return redirect()->back()->withErrors(['mes' => "X??a ng?????i d??ng th??nh c??ng"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    public function import(Request $r)
    {
        if ($r->data == '' || $r->data == null) {
            return redirect(route('admin-user.index'))->witherrors([
                'mes' => ' Kh??ng c?? d??? li???u! ',
            ]);
        }
        $ui = new UserImport();
        try {
            Excel::import($ui, $r->file('data'));
            error_log($ui->count);
            return redirect('admin-user')->withErrors(['mes' => 'Nh???p th??nh c??ng ' . $ui->count . ' ng?????i d??ng.']);
        } catch (NoTypeDetectedException $e) {
            return redirect('admin-user')->withErrors(['mes' => 'Nh???p ng?????i d??ng L???i, Vui l??ng ki???m tra l???i File Excel']);
        }
    }

    private function messages()
    {
        return [
            'username.required' => 'B???n c???n nh???p h??? t??n',
            'email.required' => 'B???n c???n ph???i nh???p Email.',
            'email.email' => '?????nh d???ng Email b??? sai.',
            'email.unique' => 'Email ???? t???n t???i',
            'phone.unique'=> 'S???? ??i????n thoa??i ???? t???n t???i',
            'address.required' => 'B???n c???n ph???i nh???p ?????a ch???.',
            'detail.required' => 'B???n c???n ph???i nh???p ?????a ch???.',
            'password.required' => 'B???n c???n ph???i nh???p m???t kh???u.',
            'password.min' => 'M???t kh???u ph???i nhi???u h??n 8 k?? t???.',
            're_password.same' => 'Nh???c l???i m???t kh???u kh??ng tr??ng v???i m???t kh???u',
            're_password.required' => 'B???n c???n nh???p nh???c l???i m???t kh???u',
            'phone.required' => 'B???n c???n ph???i nh???p s??? ??i???n tho???i.',
            'phone.min' => 'S??? ??i???n tho???i ph???i l???n h??n 10 s???.',
            'phone.regex' => 'S??? ??i???n tho???i kh??ng ????ng ?????nh d???ng.',
        ];
    }
}
