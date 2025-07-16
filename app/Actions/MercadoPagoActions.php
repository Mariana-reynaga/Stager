<?php

namespace App\Actions;

use DateTime;
use DateInterval;

class MercadoPagoActions
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function CheckOutAdd30days(){
        if (auth()->user()->end_sub != NULL) {
            $oldEndDate = auth()->user()->end_sub;
            $oldEndDate->add(new DateInterval('P30D'));

            $after30days = date_format($oldEndDate, 'd/m');

            return $after30days;
        }

        $after30days = new DateTime();
        $after30days->add(new DateInterval('P30D'));
        $after30days = date_format($after30days, 'd/m');

        return $after30days;
    }

    public function add30days(){
        if (auth()->user()->end_sub != NULL) {
            $oldEndDate = auth()->user()->end_sub;
            $oldEndDate->add(new DateInterval('P30D'));

            $after30days = date_format($oldEndDate, 'Y-m-d');

            return $after30days;
        }

        $after30days = new DateTime();
        $after30days->add(new DateInterval('P30D'));
        $after30days = date_format($after30days, 'Y-m-d');

        return $after30days;
    }

}
