<?php


namespace App\Http\Controllers;


use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderStatusController extends Controller
{
    public function index()
    {
        $orderStatus = OrderStatus::where('is_delete', 1)->get();
        $user = Session::get('auth');
        return view('orderStatus.index',
            [
                'orderStatus' => $orderStatus,
                'user' => $user,
            ]
        );
    }

    public function create()
    {
        $orderStatus = OrderStatus::all();
        $user = Session::get('auth');
        return view('orderStatus.create',
            [
                'orderStatus' => $orderStatus,
                'user' => $user,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ], $this->messages());

        $name = $request->get('name');
        $description = $request->get('description');

        $orderStatus = new OrderStatus([
            'status' => $name,
            'description' => $description,
        ]);

        $orderStatus->save();

        return redirect('admin-statusOrder')->withErrors(['mes' => "Thêm trạng thái thành công"]);
    }

    public function edit($id)
    {
        $orderStatus = OrderStatus::where('id', $id)->first();
        $user = Session::get('auth');
        return View('orderStatus.edit',
            [
                'orderStatus' => $orderStatus,
                'user' => $user,
            ]);
    }

    public function update(Request $request, $id)
    {
        $orderStatus = OrderStatus::find($id);
        $request->validate([
            'name' => 'required|max:100',
        ], $this->messages());
        try {
            error_log($orderStatus);
            $orderStatus->status = $request->get('name');
            $orderStatus->description = $request->get('description');

            $orderStatus->update();
            return redirect('admin-statusOrder')->withErrors(['mes' => "Cập nhật trạng thái thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response('', 500);
        }
    }

    public function destroy($id)
    {
        $orderStatus = OrderStatus::find($id);

        try {
            $orderStatus->is_delete = 0;
            $orderStatus->update();
            return redirect()->back()->withErrors(['mes' => "Xóa danh mục thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

}
