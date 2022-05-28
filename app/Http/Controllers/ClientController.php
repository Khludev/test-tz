<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientAppRequest;
use App\Jobs\NewClientApp;
use App\Models\Application;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clientPanel', ['only' => ['index', 'resetDate']]);
        $this->middleware('permission:clintCreate', ['only' => ['create']]);
    }

    public function index()
    {
        $create_app_access = Application::todayEntry()->first();

        return view('client.index', compact('create_app_access'));
    }

    public function resetDate()
    {
        Application::todayEntry()->update(['created_at' => now()->subDay()]);

        return back();
    }

    public function create(ClientAppRequest $request)
    {
        if ($request->hasFile('file'))
            $file_path = $request->file('file')->store('uploads/application/' . auth()->id(), 'public');

        $request->merge([
            'user_id' => auth()->id(),
            'attached_file' => $file_path ?? null
        ]);

        $new_app = Application::create($request->all());

        if ($new_app) {
            session()->flash('flash', ['success', 'Application Created']);
            dispatch(new NewClientApp($new_app, auth()->user()));
        } else
            session()->flash('flash', ['error', 'Created Error']);


        return back();
    }

}
