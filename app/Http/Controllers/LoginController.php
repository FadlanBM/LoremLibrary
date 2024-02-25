<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.Login');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $google = Socialite::driver('google')->stateless()->user();
        $filename = $google->id . '.jpg';
        $path = Storage::putFileAs('profile', $google->avatar, $filename);
        $img_file = basename($path);
        $userexis = User::where('google_id', $google->id)->count();
        if ($userexis == 0) {
            $employees = User::updateOrCreate(
                ['email' => $google->email],
                [
                    'google_id' => $google->id,
                    'avatar' => $img_file,
                ],
            );
            if ($employees->address == null || $employees->phone_number == null || $employees->name == null) {
                return redirect()->route('complete.account', ['id' => $employees->id]);
            } else {
                if ($employees->active == 'false') {
                    return redirect()->route('login')->with('pasif', 'Account is not yet active, please contact admin');
                }
                Auth::login($employees);
                if ($employees->role == 'admin') {
                    return redirect()->route('admin.index')->with('success', 'Login successful');
                }
                return redirect()->route('employees.index')->with('success', 'Login successful');
            }
        } else {
            $employees = User::updateOrCreate(
                ['email' => $google->email],
                [
                    'google_id' => $google->id,
                    'avatar' => $img_file,
                ],
            );
            if ($employees->address == null || $employees->phone_number == null || $employees->name == null) {
                return redirect()->route('complete.account', ['id' => $employees->id]);
            }
            if ($employees->active == 'false') {
                return redirect()->route('login')->with('pasif', 'Account is not yet active, please contact admin');
            }
            Auth::login($employees);
            if ($employees->role == 'admin') {
                return redirect()->route('admin.index')->with('success', 'Login successful');
            }
            return redirect()->route('employees.index')->with('success', 'Login successful');
        }
    }
}
