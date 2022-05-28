<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $apps = Application::selectRaw('applications.*, u.name, u.email')
            ->orderBy('created_at', 'DESC')
            ->join('users as u', 'u.id', 'applications.user_id')
            ->paginate(5);

        return view('manager.index', compact('apps'));
    }
}
