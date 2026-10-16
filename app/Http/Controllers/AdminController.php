<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function users() {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function changeRole(Request $request, User $user) {
        $request->validate(['role' => 'required|in:member,admin']);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Role updated.');
    }

    public function auditLog() {
        $logs = AuditLog::with('user')->orderBy('timestamp', 'desc')->paginate(30);
        return view('admin.audit', compact('logs'));
    }
}