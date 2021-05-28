<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Todo;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{

    public function Login() 
    {
        return view('auth.login');
    }

    public function register() 
    {
        return view('auth.register');
    }

    public function save(RegisterRequest $request) 
    {

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $save = $admin->save();
        if ($save) {
            return back()->with('success', 'New User has been successfully added to database');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }

    public function check(LoginRequest $request) 
    {
        $userInfor = Admin::where('email', $request->email)->first();
        if (!$userInfor) {
            return back()->with('fail', 'we do not recognize your email address');
        } else {
            if (Hash::check($request->password,$userInfor->password)) {
                $request->session()->put('LoggedUser', $userInfor->id);
                return redirect('todolist/index');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }

    public function Logout() 
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('auth/login');
        }
    }

    public function index() 
    {
        $data = ['LoggedUserInfo' => Admin::where('id', session('LoggedUser'))->first()];
        $req = Todo::orderBy('completed')->get();
        return view('todolist.index', $data, compact('req'));
    }

    public function create() 
    {
        $data = ['LoggedUserInfo' => Admin::where('id', session('LoggedUser'))->first()];
        return view('todolist.create', $data);
    }

    public function upload(CreateRequest $request) 
    {
     
        $todo = $request->title;
        Todo::create(['title' => $todo]);
        return redirect('todolist/index');
    }

    public function completed($id) 
    {
        $todo = Todo::find($id);
        if ($todo->completed) {
            $todo->update(['completed'=>false]);
            return redirect()->back()->with('success', 'Todo marked as incomplete!');
        } else {
            $todo->update(['completed' => true]);
            return redirect()->back()->with('fail', 'Todo marked as complete!');
        }
    }

    public function edit($id) 
    {
        $todo = Todo::find($id);

        $data = ['LoggedUserInfo' => Admin::where('id', session('LoggedUser'))->first()];
        return view('todolist.edit', $data)->with(['id' => $id, 'todo' => $todo]);
    }

    public function update(EditRequest $request) 
    {
       
        $updateTodo = Todo::find($request->id);
        $updateTodo->update(['title' => $request->title]);
        return redirect('todolist/index');
    }

    public function delete($id) 
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->back()->with('fail', 'Todo deleted Successfully!');
    }  
}
