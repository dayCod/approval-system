<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Department\CreateRequest;
use App\Http\Requests\Dashboard\Department\UpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->get();

        return view('page.dashboard.department.index', [
            'departments' => $departments,
        ]);
    }

    public function create()
    {
        return view('page.dashboard.department.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $result = app('createDepartment')->execute($request->validated());

            return redirect()->route('dashboard.department.index')->with('success', $result['message']);

        } catch (\Exception $err) {
            $result['success'] = false;
            $result['message'] = $err->getMessage();
            $result['data'] = [];

            return back()->with([
                'fail' => $result['message'],
                'result' => $result,
            ]);
        }
    }

    public function edit($id)
    {
        $result = app('getDepartment')->execute(['department_id' => $id]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return view('page.dashboard.department.edit', [
            'department' => $result['data']
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = app('updateDepartment')->execute([
            'name' => $request['name'],
            'department_id' => $id,
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return redirect()->route('dashboard.department.index')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = app('deleteDepartment')->execute(['department_id' => $id]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        session()->flash('success', $result['message']);

        return response()->json(['success' => $result['message']], 200);
    }
}
