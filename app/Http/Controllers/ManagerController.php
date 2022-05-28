<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:managerPanel', ['only' => ['index']]);
        $this->middleware('permission:managerReply', ['only' => ['reply']]);
    }

    public function index()
    {
        $items = 5;
        $apps = Application::selectRaw('applications.*, u.name, u.email, u.id as u_id, u.email')
            ->orderBy('created_at', 'DESC')
            ->join('users as u', 'u.id', 'applications.user_id')
            ->paginate($items);

        return view('manager.index', compact('apps'));
    }

    public function reply(Application $application)
    {
        $application->viewed = !$application->viewed;
        $application->save();

        return back();
    }
}
