<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
       if(Auth::user()->id==6 || Auth::user()->id==7) {
           $current_user = User::find(Auth::user()->id);
           $todos = Todo::orderBy('is_done')
               ->orderBy('due_date')
               ->latest()
               ->get();

           return view('todos.index', compact('todos', 'current_user'));
       }
       else{
           return redirect()->back();
       }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        Todo::create($request->all());

        return redirect()->back()->with('success', 'تمت الإضافة');
    }

    public function update(Todo $todo)
    {
        $todo->update([
            'is_done' => !$todo->is_done
        ]);

        return redirect()->back();
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }
}

