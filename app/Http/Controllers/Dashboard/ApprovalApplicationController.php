<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ApprovalApplication\CreateRequest;
use App\Http\Requests\Dashboard\ApprovalApplication\UpdateRequest;
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

    public function edit($id)
    {
        $consents = Consent::latest()->get();
        $departments = Department::latest()->get();

        $result = app('getApplication')->execute([
            'application_id' => $id,
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return view('page.dashboard.approval_application.edit', [
            'approval_applications' => $result['data'],
            'consents' => $consents,
            'departments' => $departments,
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = app('updateApplication')->execute([
            'user_id' => auth()->id(),
            'application_id' => $id,
            'consent_id' => $request['consent_id'],
            'department_id' => $request['department_id'],
            'evidence_img' => $request['evidence_img'],
            'need_remark' => $request['need_remark'],
            'remark' => $request['remark'] ?? null,
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return redirect()->route('dashboard.approval_application.index')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = app('deleteApplication')->execute(['application_id' => $id]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        session()->flash('success', $result['message']);

        return response()->json(['success' => $result['message']], 200);
    }
}
