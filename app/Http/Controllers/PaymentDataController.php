<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PaymentDataRepository;
use Illuminate\Http\Request;

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

    /**
     * Get Payment Data from the DB
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPaymentInfo(Request $request)
    {
        // validate request
        $invalidParams = [];
        foreach ($request->all() as $key => $value) {
            if (!array_key_exists($key, $this->getValidParams())) {
                $invalidParams[$key] = 'Invalid Parameter';
            }
        }

        if (count($invalidParams)) {
            return response()->json((['status' => 400, 'invalid_parameters' => $invalidParams]), 400);
        }

        $paymentData = $this->paymentDataRepository->findBy($request->all());

        return response()->json($paymentData);
    }

    /**
     * Show company view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCompanyPaymentInfo()
    {
        return view('company');
    }

    /**
     * Show hospital view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHospitalPaymentInfo()
    {
        return view('hospital');
    }

    /**
     * Get Valid Parameter
     *
     * @return array
     */
    protected function getValidParams()
    {
        return [
            'physician_first_name'  => '',
            'applicable_name'       => '',
            'page'                  => '',
            'per_page'              => ''
        ];
    }
}