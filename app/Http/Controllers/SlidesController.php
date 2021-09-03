<?php


namespace App\Http\Controllers;


use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SlidesController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        $user = Session::get('auth');

        return view('slide.index',
            [
                'slider' => $slider,
                'user' => $user,
            ]
        );
    }

    public function create()
    {
        $user = Session::get('auth');
        return View('slide.create',
            [
                'user' => $user,
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ], $this->messages());

        $image = $request->get('image');
        $description = $request->get('description');
        $slider = new Slider([
            'url' => $image,
            'description' => $description,
        ]);
        $slider->save();
        return redirect('admin-slides')->withErrors(['mes' => "Thêm barner thành công"]);
    }

    public function edit($id)
    {

        $slider = Slider::where('id', $id)->first();
        $user = Session::get('auth');
        return View('slide.edit',
            [
                'slider' => $slider,
                'user' => $user,
            ]);
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        try {
            $slider->url = $request->get('image');
            $slider->description = $request->get('description');
            $slider->update();

            return redirect('admin-slides')->withErrors(['mes' => "Cập nhật banner thành công"]);

        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response('', 500);
        }
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        try {
            $slider->delete();
            return redirect()->back()->withErrors(['mes' => "Xóa banner thành công"]);
        } catch (\Exception $e) {
            return response('', 500);
        }
    }

    private function messages()
    {
        return [
            'image.required' => 'Bạn cần phải chọn hình ảnh.',
        ];
    }
}
