<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index()
    {
        return view('pages.profile.index');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.index')->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->phone_number = $request->phone;
        $user->address = $request->address;
        $user->save();

        Auth::login($user);
        return redirect()->route('profile.index')->with('success', 'Berhasil update profile');
    }

    public function destroy($id)
    {

            $user = User::findOrFail($id);

            $imagePath = $user->avatar;

            $imagePath = 'profile/' . $imagePath;

            Storage::delete($imagePath);

            $user->delete();

            Auth::logout();

            return response()->json([
                'message' => 'SUCCESS',
            ]);

    }
}
