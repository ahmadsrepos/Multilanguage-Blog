<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Setting;

//Helpers
use Str;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $this->authorize('view', $setting);
        return view('dashboard.settings');
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        $this->authorize('update', $setting);

        $rules = 
        [
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
        ];

        foreach(config('app.languages') as $key => $value)
        {
            $rules[$key.'.title'] = 'required';
            $rules[$key.'.description'] = 'required';
            $rules[$key.'.address'] = 'required';
        }

        $this->validate($request, $rules);

        $request->request->add(
        [
            'allow_comments' => $request->has('allow_comments') ? true : false,
            'revise_comments' => $request->has('revise_comments') ? true : false,
        ]);

        Setting::find(1)->update($request->all());

        if($request->has('logo'))
        {
            $logoName = Str::uuid().'.'.$request->file('logo')->extension();
            $logoPath = $request->file('logo')->move(public_path('images/settings'), $logoName);

            Setting::find(1)->update(['logo' => $logoName]);
        }

        if($request->has('favicon'))
        {
            $faviconName = Str::uuid().'.'.$request->file('favicon')->extension();
            $faviconPath = $request->file('favicon')->move(public_path('images/settings'), $faviconName);

            Setting::find(1)->update(['favicon' => $faviconName]);
        }

        return back();
    }
}
