<?php

namespace App\Http\Controllers;

use App\Models\todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class todocontroller extends Controller
{

    public function index()
    {
//        dd(now());
        $yesterday = todo::where('created_at', 'like', '%' . date('Y-m-d', strtotime("-1 days")) . '%')->where('status', 0)->where('users_id', Auth::id())->latest()->paginate(8);
        $todo = todo::where('created_at', 'like', '%' . date("Y-m-d") . '%')->where('users_id', Auth::id())->latest()->paginate(8);

        $count = $todo->count();
        $countyesterday = $yesterday->count();
//      date('Y-m-d',strtotime("-1 days"));
//        $now = Carbon::now();
//        $yesterday = Carbon::yesterday();

        return view('admin/todo', compact('todo', 'count', 'yesterday', 'countyesterday'));

    }

    public function addyestardat()
    {
        $yesterday = todo::where('created_at', 'like', '%' . date('Y-m-d', strtotime("-1 days")) . '%')->where('status', 0)->where('users_id', Auth::id())
            ->update([
                'created_at' => date("Y-m-d")
            ]);
//        $countyesterday=$yesterday->count();


        $todo = todo::where('created_at', 'like', '%' . date("Y-m-d") . '%')->where('users_id', Auth::id())->latest()->paginate(30);
//        $count=$todo->count();
        return view('admin/home', compact('todo',))->render();
    }


    public function store(Request $request)
    {

        $to = todo::create([
            'name' => request()->name,
            'users_id' => Auth::id(),
        ]);

        $count = $to->count();

        $todo = todo::where('created_at', 'like', '%' . date("Y-m-d") . '%')->where('users_id', Auth::id())->latest()->paginate(30);

        return view('admin/home', compact('todo', 'count'))->render();
    }

    public function update(Request $request)
    {
        $to = todo::findOrFail($request->id);
        if ($to->status == 0) {
            $status = 'Completed';
            $to->update([
                'status' => 1
            ]);
        } else {
            $status = 'In progress';
            $to->update([
                'status' => 0
            ]);
        }


        return response()->json([
            'success' => $status
        ]);

    }
    public function destroy(Request $request)
    {
        todo::destroy($request->id);
        $todo = todo::where('created_at', 'like', '%' . date("Y-m-d") . '%')->where('users_id', Auth::id())->latest()->paginate(30);
        $count = $todo->count();
        return response()->json([
            'success' => $count
        ]);
    }
    public function history()
    {
        if (request()->has('sarech')) {
            $tasks = todo::where('created_at', 'like', '%' . request()->sarech . '%')->where('users_id', Auth::id())->orderBy('id', 'desc')->paginate(9);
            $count = $tasks->count();

            return view('admin.history', compact('tasks', 'count'));
        } else {
            $tasks = todo::where('id', '>', 0)->where('users_id', Auth::id())->orderBy('id', 'desc')->paginate(9);
            $count = $tasks->count();
            return view('admin.history', compact('tasks', 'count'));
        }
    }
}
