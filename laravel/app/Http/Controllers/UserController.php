<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display users with usertype student.
     */
    public function students()
    {
        if (Auth::user()->usertype !== 'teacher') {
            return redirect('dashboard');
        }
        $users = User::where('usertype', 'student')->get();
        return view('user.index', ['users' => $users, 'usertype' => 'student']);
    }

    /**
     * Display users with usertype student.
     */
    public function student(string $id)
    {
        if (Auth::user()->usertype !== 'teacher') {
            return redirect('dashboard');
        }
        $user = User::find($id);
        return view('user.show', ['user' => $user, 'usertype' => 'student']);
    }
}
