<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PaymentDataRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $invalidParams = $this->hasInvalidParams($request);
        if (count($invalidParams)) {
            return response()->json((['status' => 400, 'invalid_parameters' => $invalidParams]), 400);
        }

        $paymentData = $this->paymentDataRepository->findBy($request->all());

        return response()->json($paymentData);
    }

    /**
     * Get typeHead search result
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTypeHeadResult(Request $request)
    {
        $invalidParams = $this->hasInvalidParams($request);
        if (count($invalidParams)) {
            return response()->json((['status' => 400, 'invalid_parameters' => $invalidParams]), 400);
        }

        $inputs = $request->all();
        $key = key($inputs);
        $value = $inputs[$key];
        $result = $this->paymentDataRepository->searchBy($key, $value);

        return response()->json($result);
    }

    /**
     * Export payment data as xls file
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function exportPaymentData(Request $request)
    {
        $invalidParams = $this->hasInvalidParams($request);
        if (count($invalidParams)) {
            return response()->json((['status' => 400, 'invalid_parameters' => $invalidParams]), 400);
        }

        $params = $request->all();
        $this->paymentDataRepository->exportData($params);
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
     * Check if Request has invalid params
     *
     * @param Request $request
     * @return array
     */
    protected function hasInvalidParams(Request $request)
    {
        $invalidParams = [];
        if (empty($request->all())) {
            return ['parameter_needed' => 'Please provide at least one valid parameter'];
        }

        foreach ($request->all() as $key => $value) {
            if (!array_key_exists($key, $this->getValidParams())) {
                $invalidParams[$key] = 'Invalid Parameter';
            }
        }

        return $invalidParams;
    }

    /**
     * Get Valid Parameter
     *
     * @return array
     */
    protected function getValidParams()
    {
        return [
            'physician_first_name'      => '',
            'physician_last_name'       => '',
            'applicable_name'           => '',
            'teaching_hospital_name'    => '',
            'page'                      => '',
            'per_page'                  => ''
        ];
    }
}