<?php

namespace App\Http\Controllers;

use Str;

class OneIdAuthController extends Controller
{
    private $one_id_url;
    private $client_id;
    private $client_secret;
    private $state;
    private $redirect_url;
    private $scope;

    public function __construct()
    {
        $this->one_id_url = env('ONE_ID_URL');
        $this->client_id = env('ONE_ID_CLIENT_ID');
        $this->client_secret = env('ONE_ID_CLIENT_SECRET');
        $this->state = Str::random(6);
        $this->redirect_url = env('ONE_ID_REDIRECT_URL');
        $this->scope = env('ONE_ID_SCOPE');
    }

    public function redirect()
    {
        $data = [
            'response_type' => 'one_code',
            'client_id' => $this->client_id,
            'state' => $this->state,
            'redirect_uri' => $this->redirect_url,
            'scope' => $this->scope
        ];

        $query = http_build_query($data);
        $url = "{$this->one_id_url}?{$query}";

        return redirect()->to($url);
    }

    /**
     * @throws \Exception
     */
    public function callback()
    {
        $code = request('code');
        $state = request('state');

        dump($code);

        $data = [
            'grant_type' => 'one_authorization_code',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $code,
            'redirect_uri' => route('one-id.login.auth-callback')
        ];

        $req = \Http::post($this->one_id_url, $data);

//        if ($req->clientError()) {
//            throw new \Exception('One ID client error');
//        }
//
//        if ($req->serverError()) {
//            throw new \Exception('One ID server error');
//        }
//
//        if (!$req->json('access_token')) {
//            throw new \Exception('One ID access token not found');
//        }

        dump($req->body());

        $access_token = $req->json('access_token');
        $scope = $req->json('scope', $this->scope);

        $data = [
            'grant_type' => 'one_access_token_identify',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'access_token' => $access_token,
            'scope' => $scope
        ];

        $req = \Http::post($this->one_id_url, $data);

        dd($req->body());
    }

    public function authCallback(\Request $request)
    {

    }
}
