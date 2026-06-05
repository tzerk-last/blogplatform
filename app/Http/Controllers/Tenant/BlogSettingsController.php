<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogSettingsController extends Controller
{
    public function edit()
    {
        return view('dashboard.settings', [
            'blog' => tenant(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'blog_name'    => 'required|string|max:255',
            'bio'          => 'nullable|string|max:500',
            'avatar'       => 'nullable|image|max:2048',
            'bg_color'     => 'required|string',
            'text_color'   => 'required|string',
            'accent_color' => 'required|string',
            'font'         => 'required|string',
        ]);

        $tenant = tenant();

        $avatarPath = $tenant->avatar;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')
                                  ->store('avatars/' . $tenant->id, 'public');
        }

        $tenant->update([
            'blog_name'    => $request->blog_name,
            'bio'          => $request->bio,
            'avatar'       => $avatarPath,
            'bg_color'     => $request->bg_color,
            'text_color'   => $request->text_color,
            'accent_color' => $request->accent_color,
            'font'         => $request->font,
        ]);

        return back()->with('success', 'Configuración actualizada correctamente');
    }
}
