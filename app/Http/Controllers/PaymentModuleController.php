<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Exception;

class PaymentModuleController extends Controller
{
    public function manageAndroidWebhookEvents(Request $request_body)
    {
        try {

            $request = json_decode($request_body->getContent());
            Log::info('manageAndroidWebhookEvents :', ['request' => $request]);

            //-- FOR LOCAL SERVER NGROK
	    //$response = Http::post('https://cf30-49-36-80-194.ngrok-free.app/ob_qr_menu_maker/public/api/manageAndroidWebhookEvents', [$request]);

            //-- FOR STAGING SERVER TEST
            $response = Http::post('https://115d-43-249-231-219.ngrok-free.app/ob_cds/public/api/manageAndroidWebhookEvents', [$request]);

            //-- FOR LIVE SERVER
            //$response = Http::post('https://lisi.menu/api/manageAndroidWebhookEvents', [$request]);

            $response = Response::json(array('code' => 200, 'message' => 'Webhook called successfully', 'data' => json_decode("{}")));

        } catch (Exception $e) {
            Log::error("manageAndroidWebhookEvents : ", ["Exception" => $e->getMessage(), "\nTraceAsString" => $e->getTraceAsString()]);
            $response = Response::json(array('code' => 201, 'message' => 'ob_qr_menu_maker is unable to manage webhook data.', 'cause' => $e->getMessage(), 'data' => json_decode("{}")));
        }
        return $response;
    }
}
