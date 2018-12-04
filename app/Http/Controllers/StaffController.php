<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();

        return view('staff.index', compact('staff'));
    }

    public function store()
    {
        $data = request()->validate([
            'nama' => 'required|unique:staff,name',
            'password' => 'required|confirmed|unique:staff',
        ]);

        Staff::create([
            'name' => request('nama'),
            'password' => request('password'),
        ]);

        session()->flash('success', 'Data staff berhasil disimpan!');

        return redirect()->route('staff.index');
    }
}
