<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment\MPpayment;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

use Illuminate\Auth\Events\Registered;

use App\Actions\MercadoPagoActions;
use App\Models\Plans;
use App\Models\User;
use App\Models\SubscriptionHistory;

use MercadoPago\Exceptions\MPApiException;

class MercadoPagoController extends Controller
{
    public function checkout(int $plan_id, Request $request){
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

        $action = new MercadoPagoActions;
        $endSubDate = $action->CheckOutAdd30days();

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

        $request->session()->put('mp_id', $preference->id);

        return view('plan.checkout', [
            'plan' => $plan,
            'endDate' => $endSubDate,
            'preference' => $preference,
            'mpPublicKey' => config('mercadopago.publicKey')
        ]);
    }

    public function mercadopagoSuccess(int $plan_id, Request $request){
        $user = User::find(auth()->user()->user_id);

        $today = Date('Y-m-d');

        $action = new MercadoPagoActions;
        $endSubDate = $action->add30days();

        if (auth()->user()->end_sub != NULL) {
            event(new Registered($user));
        }

        $user->update(['plan_id_fk'=>$plan_id, 'sub_at'=> $today, 'end_sub'=> $endSubDate]);

        $payRecord = SubscriptionHistory::create([
            'MP_payment_id' => session()->get('mp_id'),
            'sub_start'     => $today,
            'sub_end'       => $endSubDate,
            'status'        => 'success',
            'user_id_fk'    => $user->user_id
        ]);

        $request->session()->forget('mp_id');

        return redirect()->route('espacio.trabajo', ['user_id' => $user->user_id]);
    }

    public function mercadopagoFailed(int $plan_id){
        return redirect()->route('checkout', ['plan_id'=>$plan_id])->with('failure.msg', 'El pago no se pudo realizar, por favor, intente de vuelta.');
    }

    public function mercadopagoPending(int $plan_id, Request $request){
        $user = User::find(auth()->user()->user_id);

        $today = Date('Y-m-d');

        $action = new MercadoPagoActions;
        $endSubDate = $action->add30days();

        if (auth()->user()->end_sub != NULL) {
            event(new Registered($user));
        }

        $user->update(['plan_id_fk'=>$plan_id, 'sub_at'=> $today, 'end_sub'=> $endSubDate]);

        $payRecord = SubscriptionHistory::create([
            'MP_payment_id' => session()->get('mp_id'),
            'sub_start'     => $today,
            'sub_end'       => $endSubDate,
            'status'        => 'pending',
            'user_id_fk'    => $user->user_id
        ]);

        $request->session()->forget('mp_id');

        return redirect()->route('espacio.trabajo', ['user_id' => $user->user_id]);
    }
}
