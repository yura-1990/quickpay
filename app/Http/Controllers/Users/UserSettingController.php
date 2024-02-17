<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\UserSetting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $userSettings = UserSetting::query()->where('user_id', auth()->user()->id)->orderByDesc('id')->get();

        return view('users-settings.index', compact('userSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'nullable|email|string',
            'phone' => 'nullable',
            'telegram' => 'nullable|string'
        ]);


        foreach($data as $key => $value){
            UserSetting::query()->updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'setting_key' => $key,
                ],
                ['setting_value' => $value,]
            );
        }

        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSetting $userSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSetting $userSetting)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserSetting $userSetting)
    {
        $data = $request->validate([
            'email' => 'nullable|email|string',
            'phone' => 'nullable',
            'telegram' => 'nullable|string'
        ]);


        foreach($data as $key => $value){
            UserSetting::query()->updateOrCreate(
                [
                    'user_id' => $request->user()->id,
                    'setting_key' => $key,
                ],
                [ 'setting_value' => $value ]
            );
        }

        return redirect()->route('settings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSetting $userSetting)
    {
        //
    }


}
