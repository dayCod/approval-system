<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ApprovalApplication;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    public function index()
    {
        $approval_applications = ApprovalApplication::latest()->get();

        return view('page.dashboard.approval.index', [
            'approval_applications' => $approval_applications,
        ]);
    }

    public function approveApplication($id)
    {
        $result = app('approveApplication')->execute([
            'application_id' => $id,
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return redirect()->route('dashboard.approval.index')->with('success', $result['message']);
    }

    public function rejectApplication($id)
    {
        $result = app('rejectApplication')->execute([
            'application_id' => $id,
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return redirect()->route('dashboard.approval.index')->with('success', $result['message']);
    }
}
