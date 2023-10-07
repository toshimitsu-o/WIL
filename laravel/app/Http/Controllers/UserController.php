<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        $users = User::where('usertype', 'student')->paginate(20);
        return view('user.index', ['users' => $users, 'usertype' => 'student']);
    }

    /**
     * Display student profile.
     * 
     * @param string $id userid
     */
    public function student(string $id)
    {
        if (Auth::user()->usertype === 'teacher' || Auth::user()->id == $id) {
            $user = User::find($id);
            return view('user.show', ['user' => $user, 'usertype' => 'student']);
        }
        return redirect('dashboard');
    }

    /**
     * Display IPs.
     */
    public function ips()
    {
        $users = User::where('usertype', 'ip')->get();
        return view('user.ips', ['users' => $users]);
    }

    /**
     * Store a new application in storage.
     */
    public function approve_ip(Request $request, string $id)
    {
        $user = $request->user();
        

        //dd(count($user->applications));

        if ($user->usertype !== 'teacher') {
            return back()->withErrors(array('You do not have a permission for this action.'));
        }

        $ip = User::find($id);
        $ip->approved_at = now();
        $ip->save();
        return back();

    }
}
