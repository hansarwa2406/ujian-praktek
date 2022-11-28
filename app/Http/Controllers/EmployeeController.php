<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index', [
            'title' => 'Daftar Karyawan',
            'employees' => Employee::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create', [
            'title' => 'Tambah Karyawan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'jenis_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'image' => 'image|file',
            'tanggal_lahir' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('karyawan-images');
        }

        Employee::create($validatedData);

        return redirect('/employees')->with('success', 'Karyawan Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'title' => 'Ubah Karyawan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis_karyawan' => 'required',
            'jenis_kelamin' => 'required',
            'image' => 'image|file',
            'tanggal_lahir' => 'required',
        ]);

        if ($request->file('image')) {
            if ($employee->image) {
                Storage::delete($employee->image);
            }
            $validatedData['image'] = $request->file('image')->store('karyawan-images');
        }

        Employee::where('id', $employee->id)
            ->update($validatedData);

        return redirect('/employees')->with('success', 'Karyawan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if ($employee->image) {
            Storage::delete($employee->image);
        }

        Employee::destroy($employee->id);

        return redirect('/employees')->with('success', 'Karyawan Berhasil Dihapus');
    }
}
