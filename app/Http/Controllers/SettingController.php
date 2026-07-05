<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json([
            'show_copyright' => Setting::get('show_copyright', '1'),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'key'   => 'required|string|in:show_copyright',
            'value' => 'required|string|in:0,1',
        ]);

        Setting::set($validated['key'], $validated['value']);

        return response()->json(['success' => true]);
    }
}
