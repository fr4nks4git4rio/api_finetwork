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
    private $host = 'https://wss.bpodigital.com/llama_finetwork.php?';
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
        $input = $request->input();
        $url = $this->host;
        Log::info("Data Recibida de Facebook");
        Log::info($input);
        $url .= 'phone='.$input['data']['phone'].'&name='.$input['data_exten']['name'].'&email='.$input['data_exten']['email'];

        try{
            $r = $this->http->get($url, ['auth' => ['artemisa_leads', 'Rki4yjLk^L%8']]);
        }catch (GuzzleException $e){
//      return $this->sendError($e->getMessage());
            return json_encode(['error' => 'No se pudo comunicar con el servicio. Inténtelo mas tarde.']);
        }

        return json_encode(['success' => true, 'response' => 'ok']);
    }
}
