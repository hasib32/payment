<?php

namespace App\Http\Controllers;


class PaymentDataController extends Controller
{
    public function getPaymentInfo()
    {
        $filePath = public_path("payment.json");
        echo $filePath;
    }
}