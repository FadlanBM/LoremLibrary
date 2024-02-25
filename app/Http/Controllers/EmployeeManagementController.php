<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = User::where('active', 'true')->where('role', 'employee')->get();
        return view('pages.admin.employeemanagement', ['employee' => $employee]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function accessadmin($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->save();
        if ($user == null) {
            return response()->json(['errors' => 'error'], 422);
        }
        return response()->json([
            'data' => $user,
            'message' => 'SUCCESS',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);

        return response()->json($users);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = User::findOrFail($id);
        $imagePath = $employee->img;
        $imagePath = 'profile/' . $imagePath;
        Storage::delete($imagePath);
        $employee->delete();

        return response()->json([
            'message' => 'SUCCESS',
        ]);
    }
}
