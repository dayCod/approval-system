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

        if (!$result['success']) {

            session()->flash('fail', $result['message']);

            return response()->json(['error' => $result['message']], 404);
        }

        session()->flash('success', $result['message']);

        return response()->json(['success' => $result['message']], 200);
    }

    public function rejectApplication($id)
    {
        $result = app('rejectApplication')->execute([
            'application_id' => $id,
        ]);

        if (!$result['success']) {

            session()->flash('fail', $result['message']);

            return response()->json(['error' => $result['message']], 404);
        }

        session()->flash('success', $result['message']);

        return response()->json(['success' => $result['message']], 200);
    }

    public function reviseApplication(Request $request, $id)
    {
        $result = app('reviseApplication')->execute([
            'application_id' => $id,
            'revise_notes' => $request['notes'],
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return redirect()->route('dashboard.approval.index')->with('success', $result['message']);
    }
}
