<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoApiController extends Controller
{
    public function index()
    {
        $todos = Todo::latest()->paginate(3);
        return response()->json(['date' => $todos] , 200);
    }

    public function show(Todo $todo)
    {
        return view('todos.show' , compact('todo'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required'
//        ]);

        Todo::create(
//        [
//        'title' => $request->title,
//        'description' => $request->description
//        ]
            $request->all()
        );

        alert()->success('Success Message' , 'Optional Title');
        return redirect()->route('todos.index');
    }

    public function edit(Todo $todo){
        return view('todos.edit' , compact('todo'));
    }

    public function update(Request $request , Todo $todo){

//        $request->validate([
//            'title' => 'required',
//            'description' => 'required'
//        ]);

        $todo->update(
//        [
//        'title' => $request->title,
//        'description' => $request->description
//        ]
            $request->all()
        );

        alert()->success('با تشکر' , 'تسک با موفقیت ویرایش شد');
        return redirect()->route('todos.index');
    }

    public function delete(Todo $todo){
        $todo->delete();

        alert()->error('دقت کنید' , 'تسک با موفقیت حذف شد');
        return redirect()->route('todos.index');
    }

    public function complete(Todo $todo){
        $todo->update([
            'completed' => 1
        ]);

        alert()->success('با تشکر' , 'تسک موردنظر به وضعیت انجام شد تغییر پیدا کرد');
        return redirect()->route('todos.index');
    }

}
