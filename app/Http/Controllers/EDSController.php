<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Http;
use Log;
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
        $this->state = Str::random(6);
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

        $response = Http::withBasicAuth(
            $this->client_id,
            $this->client_secret
        )->post("https://apiid.tdi.uz/oauth/token?grant_type=authorization_code&state={$state}&code={$code}");

        $data = $response->json('data');

        if ($data && isset($data['inn'])) {
            if (isset($data['eimzo_j_inn'])) {
                $org = Organization::whereStir($data['eimzo_j_inn'])->first();
                if ($org) {
                    auth('org')->loginUsingId($org->id);

                    return redirect()->route('dashboard');
                }
            }

            $org = Organization::whereStir($data['inn'])->first();
            if ($org) {
                auth('org')->loginUsingId($org->id);

                return redirect()->route('dashboard');
            } else {
                return view('eds.error-org');
            }
        }

        return view('eds.error-inn');
    }

    public function callback2()
    {
        $code = request('code');
        $state = request('state');
        $token = base64_encode("{$this->client_id}:{$this->client_secret}");

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiid.tdi.uz/oauth/token?grant_type=authorization_code&state={$state}&code={$code}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic NVhiMXF0VFpsTFNtRHdiVHFqQzQ6ZmRqa0JsQ2RkMHU5V2xiUWhRZzY='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
}
