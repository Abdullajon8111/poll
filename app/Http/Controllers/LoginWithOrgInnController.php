<?php

namespace App\Http\Controllers;

use App\Http\Requests\AwoiLoginRequest;
use App\Models\Organization;
use function request;

class LoginWithOrgInnController extends Controller
{
    public function index()
    {
        return view('awoi.login');
    }

    public function info()
    {
        return view('awoi.info', [
            'org' => Organization::getByKtutAndStir(request('stir'), request('ktut'))
        ]);
    }

    public function login(AwoiLoginRequest $request)
    {
        $org = Organization::getByKtutAndStir($request->stir, $request->ktut);

        if ($org) {
            auth('org')->loginUsingId($org->id);
        }

    }
}
