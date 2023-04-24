<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\CreateRequest;
use App\Http\Requests\Dashboard\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();

        return view('page.dashboard.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('page.dashboard.user.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $result = app('createUser')->execute($request->validated());

            return redirect()->route('dashboard.user.index')->with('success', $result['message']);

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
        $result = app('getUser')->execute(['user_id' => $id]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return view('page.dashboard.user.edit', [
            'user' => $result['data']
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $result = app('updateUser')->execute([
            'name' => $request['name'],
            'email' => $request['email'],
            'user_id' => $id,
        ]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        return redirect()->route('dashboard.user.index')->with('success', $result['message']);
    }

    public function destroy($id)
    {
        $result = app('deleteUser')->execute(['user_id' => $id]);

        if (!$result['success']) return back()->with('fail', $result['message']);

        session()->flash('success', $result['message']);

        return response()->json(['success' => $result['message']], 200);
    }
}
