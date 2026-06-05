<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'total_blogs'   => Tenant::count(),
            'total_users'   => User::count(),
            'total_posts'   => Post::count(),
            'active_blogs'  => Tenant::where('is_active', true)->count(),
            'recent_blogs'  => Tenant::latest()->take(10)->get(),
        ]);
    }

    public function suspend(Tenant $tenant)
    {
        $tenant->update(['is_active' => false]);
        return back()->with('success', 'Blog suspendido correctamente');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return back()->with('success', 'Blog eliminado correctamente');
    }
}
