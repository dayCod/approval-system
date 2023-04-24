<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Consent\CreateRequest;
use App\Http\Requests\Dashboard\Consent\UpdateRequest;
use App\Models\Consent;
use Illuminate\Http\Request;

class ConsentController extends Controller
{
    public function index()
    {
        $consents = Consent::latest()->get();

        return view('page.dashboard.consent.index', [
            'consents' => $consents
        ]);
    }

    public function create()
    {
        return view('page.dashboard.consent.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $result = app('createConsent')->execute($request->validated());

            return redirect()->route('dashboard.consent.index')->with('success', $result['message']);

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
        $result = app('getConsent')->execute(['consent_id' => $id]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return view('page.dashboard.consent.edit', [
            'consent' => $result['data']
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = app('updateConsent')->execute([
            'name' => $request['name'],
            'consent_id' => $id,
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return redirect()->route('dashboard.consent.index')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = app('deleteConsent')->execute(['consent_id' => $id]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        session()->flash('success', $result['message']);

        return response()->json(['success' => $result['message']], 200);
    }
}
