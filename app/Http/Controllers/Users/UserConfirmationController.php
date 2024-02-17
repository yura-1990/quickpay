<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\VerificationCode;
use App\Services\CodeGenerator;
use App\Services\SendProvider;
use Illuminate\Http\Request;

class UserConfirmationController extends Controller
{
    public function send(Request $request, CodeGenerator $codeGenerator)
    {
        $verificationCode = VerificationCode::query()->updateOrCreate(
            [ 'user_id' => $request->user()->id ],
            [
                'provider' => $request->input('provider'),
                'code' => $codeGenerator->generateCode(),
                'status' => 'active'
            ]
        );

        foreach($codeGenerator->mapping() as $key => $value){
            if ($key === $verificationCode->provider) {
                $provider = new SendProvider($value);
                $provider->sendMessage($request, $verificationCode);
            }
        }

        return response()->json([
            'status' => 200,
        ], 200);
    }

    public function confirm(Request $request)
    {
        $verificationCode = VerificationCode::query()->where([
            ['code', '=', $request->input('code')],
            ['user_id', '=', $request->user()->id],
        ])->orderBy('id', 'desc')->latest()->first();

        if($verificationCode){
            $verificationCode->delete();

            return response()->json([
                'status' => 200,
                'success'=> 'Success',
            ], 200);
        }

        return response()->json([
            'status' => 400,
        ], 401);
    }
}
