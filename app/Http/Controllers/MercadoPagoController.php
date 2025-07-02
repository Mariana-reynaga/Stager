<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment\MPpayment;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

use MercadoPago\Exceptions\MPApiException;

class MercadoPagoController extends Controller
{
    public function checkout(){
        $items[] = [
            'title'=>'suscripción Premium',
            'unit_price'=>4000,
            'quantity'=> 1
        ];

        try {
            MercadoPagoConfig::setAccessToken(config('mercadopago.accessToken'));

            $preferenceFactory = new PreferenceClient;

            $preference = $preferenceFactory->create([
                'items' => $items,
                'back_urls'=> [
                    'success' => route('mercadopago.successProcess'),
                    'failure' => route('mercadopago.failed'),
                    'pending' => route('mercadopago.pending'),
                ],
                // 'auto_return' => 'approved'
            ]);

        } catch (\Throwable $th) {
            dd($th);
        }

        return view('test.index', [
            'preference' => $preference,
            'mpPublicKey' => config('mercadopago.publicKey')
        ]);
    }

    public function mercadopagoSuccess(){
        dd("SUCCESS");
    }
    public function mercadopagoFailed(){
        dd("FAILED");
    }
    public function mercadopagoPending(){
        dd("PENDING");
    }
}
