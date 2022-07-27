<?php

namespace App\Http\Controllers;

use Str;

class EDSController extends Controller
{
    /**
     * @var string
     */
    private $id_tdi_url;
    /**
     * @var string
     */
    private $state;
    /**
     * @var string
     */
    private $client_id;
    /**
     * @var string
     */
    private $client_secret;

    public function __construct()
    {
        $this->id_tdi_url = env('ID_TDI_URL');
        $this->client_id = env('ID_TDI_CLIENT_ID');
        $this->client_secret = env('ID_TDI_CLIENT_SECRET');
        $this->state = Str::random();
    }

    public function redirect()
    {
        $url = "{$this->id_tdi_url}?client_id={$this->client_id}&state={$this->state}";
        return redirect()->to($url);
    }

    public function callback()
    {
        $code = request('code');
        $state = request('state');

        $client = \Http::withBasicAuth($this->client_id, $this->client_secret);
        $response = $client->post("https://apiid.tdi.uz/oauth/token?grand_type=authorization_code&state={$state}&code={$code}", []);

        dd($response);
    }
}
