<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompleteAccountController extends Controller
{
    public function index($id)
    {
        $data = User::findOrFail($id);
        return view('pages.auth.CompleteAccount', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('complete.account', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $employees = User::findOrFail($id);
        $employees->name = $request->name;
        $employees->phone_number = $request->phone_number;
        $employees->address = $request->address;
        $employees->save();
        if ($employees->active == 'false') {
            return redirect()->route('login')->with('pasif', 'Account is not yet active, please contact admin');
        }
        Auth::login($employees);
        if ($employees->role = 'admin') {
            return redirect()->route('admin.index')->with('success', 'Login successful');
        }
        return redirect()->route('employees.index')->with('success', 'Login successful');
    }
}
