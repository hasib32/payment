<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PaymentDataRepository;

class PaymentDataController extends Controller
{
    /**
     * Instance of PaymentDataRepository
     *
     * @var PaymentDataRepository
     */
    private $paymentDataRepository;

    /**
     * Controller Constructor
     *
     * @param PaymentDataRepository $paymentDataRepository
     */
    public function __construct(PaymentDataRepository $paymentDataRepository)
    {
        $this->paymentDataRepository = $paymentDataRepository;
    }

    public function getPaymentInfo()
    {
        $paymentData = $this->paymentDataRepository->findBy(['physician_first_name' => 'SETH']);

        return response()->json($paymentData);
    }
}