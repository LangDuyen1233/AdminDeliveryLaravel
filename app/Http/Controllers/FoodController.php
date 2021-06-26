<?php


namespace App\Http\Controllers;


use App\Models\Food;
use Yajra\DataTables\Facades\DataTables;

class FoodController extends Controller
{
    public function index()
    {
        return view('food.index');
//        $category = Category::all();
////        dd($res);
//        return view('category.index',
//            [
//                'category' => $category,
//            ]
//        );
    }

    public function getFoods(Request $request)
    {
        if ($request->ajax()) {
            $data = Food::all()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
