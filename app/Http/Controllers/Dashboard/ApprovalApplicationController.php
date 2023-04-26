<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ApprovalApplication\CreateRequest;
use App\Models\ApprovalApplication;
use App\Models\Consent;
use App\Models\Department;
use Illuminate\Http\Request;

class ApprovalApplicationController extends Controller
{
    public function index()
    {
        $approval_applications = ApprovalApplication::latest()->get();

        return view('page.dashboard.approval_application.index', [
            'approval_applications' => $approval_applications,
        ]);
    }

    public function create()
    {
        $consents = Consent::latest()->get();
        $departments = Department::latest()->get();

        return view('page.dashboard.approval_application.create', [
            'consents' => $consents,
            'departments' => $departments,
        ]);
    }

    public function store(CreateRequest $request)
    {
        try {
            $result = app('createApplication')->execute([
                'user_id' => auth()->id(),
                'consent_id' => $request['consent_id'],
                'department_id' => $request['department_id'],
                'evidence_img' => $request->file('evidence_img'),
                'need_remark' => $request['need_remark'],
                'remark' => $request['remark'] ?? null
            ]);

            return redirect()->route('dashboard.approval_application.index')->with('success', $result['message']);

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

    public function edit(Type $var = null)
    {
        # code...
    }

    public function update(Type $var = null)
    {
        # code...
    }

    public function destroy(Type $var = null)
    {
        # code...
    }
}
