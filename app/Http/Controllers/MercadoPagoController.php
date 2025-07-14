<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment\MPpayment;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

use Illuminate\Auth\Events\Registered;

use DateTime;
use DateInterval;

use App\Models\Plans;
use App\Models\User;

use MercadoPago\Exceptions\MPApiException;

class MercadoPagoController extends Controller
{
    public function checkout(int $plan_id){
        $plan = Plans::find($plan_id);

        if ($plan->plan_name === 'Prueba' ) {
            $user = User::find(auth()->user()->user_id);

            $user->update(['plan_id_fk'=>$plan->plan_id]);

            event(new Registered($user));

            return redirect()->route('espacio.trabajo', ['user_id' => $user->user_id]);
        }

        $items[] = [
            'title'=>'Suscripción Premium a Stager',
            'unit_price'=>$plan->plan_price,
            'quantity'=> 1
        ];

        $endSubDate = new DateTime();
        $endSubDate->add(new DateInterval('P30D'));
        $endSubDate = date_format($endSubDate, 'd/m');

        try {
            MercadoPagoConfig::setAccessToken(config('mercadopago.accessToken'));

            $preferenceFactory = new PreferenceClient;

            $preference = $preferenceFactory->create([
                'items' => $items,
                'back_urls'=> [
                    'success' => route('mercadopago.success', ['plan_id'=>$plan_id]),
                    'failure' => route('mercadopago.failed',  ['plan_id'=>$plan_id]),
                    'pending' => route('mercadopago.pending', ['plan_id'=>$plan_id]),
                ],
                'auto_return' => 'approved'
            ]);

        } catch (\Throwable $th) {
            dd($th);
        }

        return view('plan.checkout', [
            'plan' => $plan,
            'endDate' => $endSubDate,
            'preference' => $preference,
            'mpPublicKey' => config('mercadopago.publicKey')
        ]);
    }

    public function mercadopagoSuccess(int $plan_id){
        $user = User::find(auth()->user()->user_id);

        $today = Date('Y-m-d');

        $endSubDate = new DateTime();
        $endSubDate->add(new DateInterval('P30D'));
        $endSubDate = date_format($endSubDate, 'Y-m-d');

        $user->update(['plan_id_fk'=>$plan_id, 'sub_at'=> $today, 'end_sub'=> $endSubDate]);

        event(new Registered($user));

        return redirect()->route('espacio.trabajo', ['user_id' => $user->user_id]);
    }

    public function mercadopagoFailed(int $plan_id){
        return redirect()->route('checkout', ['plan_id'=>$plan_id])->with('failure.msg', 'El pago no se pudo realizar, por favor, intente de vuelta.');
    }

    public function mercadopagoPending(int $plan_id){
        $user = User::find(auth()->user()->user_id);

        $today = Date('Y-m-d');

        $endSubDate = new DateTime();
        $endSubDate->add(new DateInterval('P30D'));
        $endSubDate = date_format($endSubDate, 'Y-m-d');

        $user->update(['plan_id_fk'=>$plan_id, 'sub_at'=> $today, 'end_sub'=> $endSubDate]);

        event(new Registered($user));

        return redirect()->route('espacio.trabajo', ['user_id' => $user->user_id]);
    }
}
