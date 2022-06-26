<?php

namespace App\Http\Controllers;

use App\Http\Requests\AwoiLoginRequest;
use App\Models\Organization;
use Illuminate\Validation\ValidationException;
use function request;

class LoginWithOrgInnController extends Controller
{
    public function index()
    {
        return view('awoi.login');
    }

    /**
     * @throws ValidationException
     */
    public function login(AwoiLoginRequest $request)
    {
        $org = Organization::query()
            ->whereStir($request->stir)
            ->whereKtut($request->ktut)
            ->first();

        if (!$org) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        auth('org')->loginUsingId($org->id);

        return redirect()->route('dashboard');
    }
}
