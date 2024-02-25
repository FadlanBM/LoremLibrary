<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class EmployeeVerificationController extends Controller
{
    public function index()
    {
        $users = User::where('active', 'false')->where('role', 'employee')->get();

        return view('pages.admin.VerifEmployee', ['users' => $users]);
    }

    public function verification($id)
    {
        $user = User::findOrFail($id);
        $user->active = 'true';
        $user->save();
        if ($user == null) {
            return response()->json(['errors' => 'error'], 422);
        }
        return response()->json([
            'data' => $user,
            'message' => 'SUCCESS',
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $imagePath = $user->avatar;
        $imagePath = 'profile/' . $imagePath;
        Storage::delete($imagePath);
        $user->delete();
        if ($user == null) {
            return response()->json(['errors' => 'error'], 422);
        }
        return response()->json([
            'data' => $user,
            'message' => 'SUCCESS',
        ]);
    }
}
