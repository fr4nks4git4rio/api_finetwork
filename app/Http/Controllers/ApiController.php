<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    private $host = 'https://lepho20.aviloncenter.com/Artemisa/leads.php?';
    private $http;

    /**
     * DefaultController constructor.
     * @param $http
     */
    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    public function recibirInfoFacebook(Request $request)
    {
        $url = $this->prepareData($request);
        $url .= 'id_cargue=8';

        try {
            $r = $this->http->get($url, ['auth' => ['artemisa_leads', 'Rki4yjLk^L%8']]);
        } catch (GuzzleException $e) {
//            return $e->getMessage();
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'response' => 'No se pudo comunicar con el servicio. Intentelo mas tarde. Error: '.$e->getMessage()]);
        }

        Log::info("Petición correcta!");
        return response()->json(['success' => true, 'response' => 'ok']);
    }

    public function recibirInfoFacebookRepsol(Request $request)
    {
        $url = $this->prepareData($request);
        $url .= 'id_cargue=85';

        try {
            $r = $this->http->get($url, ['auth' => ['artemisa_leads', 'Rki4yjLk^L%8']]);
        } catch (GuzzleException $e) {
//            return $e->getMessage();
            Log::info($e->getMessage());
            return response()->json(['success' => false, 'response' => 'No se pudo comunicar con el servicio. Intentelo mas tarde. Error: '.$e->getMessage()]);
        }

        Log::info("Petición correcta!");
        return response()->json(['success' => true, 'response' => 'ok']);
    }

    /**
     * @param Request $request
     * @return string
     */
    private function prepareData(Request $request): string
    {
        if (is_string($request->data))
            $input = json_decode($request->data, true);
        else
            $input = $request->data;
        $url = $this->host;
        Log::info("Data Recibida de Facebook");
        Log::info($input);
        $url .= 'phone=' . $input['data']['phone'] . '&name=' . $input['data']['name'] . '&email=' . $input['data']['email'] . '&';
        return $url;
    }
}
