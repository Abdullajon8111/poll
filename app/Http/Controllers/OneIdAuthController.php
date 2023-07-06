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

    public function __construct()
    {
        $this->one_id_url = env('ONE_ID_URL');
        $this->client_id = env('ONE_ID_CLIENT_ID');
        $this->client_secret = env('ONE_ID_CLIENT_SECRET');
        $this->state = Str::random(6);
        $this->redirect_url = env('ONE_ID_REDIRECT_URL');
    }

    public function redirect()
    {
        $data = [
            'response_type' => 'one_code',
            'client_id' => $this->client_id,
            'state' => $this->state,
            'redirect_uri' => $this->redirect_url
        ];

        $query = http_build_query($data);
        $url = "{$this->one_id_url}?{$query}";

        return redirect()->to($url);
    }

    public function callback()
    {
        $code = request('code');
        $state = request('state');

        dd($code, $state);
    }
}
