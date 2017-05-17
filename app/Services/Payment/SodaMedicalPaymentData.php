<?php

namespace App\Services\Payment;

use GuzzleHttp\Client;

class SodaMedicalPaymentData implements MedicalPaymentDataInterface
{
    const API_ENDPOINT = 'https://openpaymentsdata.cms.gov/resource/k8gn-hat5.json';

    /**
     * Instance of HTTP Client
     *
     * @var Client
     */
    private $httpClient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->httpClient = new Client();

    }

    /*
     * @inheritdoc
     */
    public function getData(array $params)
    {
        $url = $this->buildUrl($params);

        $response = $this->httpClient->get($url);

        return json_decode($response->getBody(), true);
    }

    /**
     * @inheritdoc
     */
    public function transformData(array $data)
    {
        $dateTime = new \DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        return [
            'provider_id'                       => $this->getValueIfExists($data, ':id'),
            'provider_created_at'               => $this->getValueIfExists($data, ':created_at'),
            'provider_updated_at'               => $this->getValueIfExists($data, ':updated_at'),
            'applicable_payment_country'        => $this->getValueIfExists($data, 'applicable_manufacturer_or_applicable_gpo_making_payment_country'),
            'applicable_payment_id'             => $this->getValueIfExists($data, 'applicable_manufacturer_or_applicable_gpo_making_payment_id'),
            'applicable_payment_name'           => $this->getValueIfExists($data, 'applicable_manufacturer_or_applicable_gpo_making_payment_name'),
            'applicable_payment_state'          => $this->getValueIfExists($data, 'applicable_manufacturer_or_applicable_gpo_making_payment_state'),
            'change_type'                       => $this->getValueIfExists($data, 'change_type'),
            'charity_indicator'                 => $this->getValueIfExists($data, 'charity_indicator'),
            'contextual_information'            => $this->getValueIfExists($data, 'contextual_information'),
            'covered_recipient_type'            => $this->getValueIfExists($data, 'covered_recipient_type'),
            'teaching_hospital_id'              => $this->getValueIfExists($data, 'teaching_hospital_id'),
            'teaching_hospital_name'            => $this->getValueIfExists($data, 'teaching_hospital_name'),
            'physician_name_suffix'             => $this->getValueIfExists($data, 'physician_name_suffix'),
            'teaching_hospital_ccn'             => $this->getValueIfExists($data, 'teaching_hospital_ccn'),
            'date_of_payment'                   => $this->getValueIfExists($data, 'date_of_payment'),
            'delay_in_publication_indicator'    => $this->getValueIfExists($data, 'delay_in_publication_indicator'),
            'dispute_status_for_publication'    => $this->getValueIfExists($data, 'dispute_status_for_publication'),
            'form_of_payment'                   => $this->getValueIfExists($data, 'form_of_payment_or_transfer_of_value'),
            'city_of_travel'                    => $this->getValueIfExists($data, 'city_of_travel'),
            'nature_of_payment'                 => $this->getValueIfExists($data, 'nature_of_payment_or_transfer_of_value'),
            'number_of_payments'                => $this->getValueIfExists($data, 'number_of_payments_included_in_total_amount'),
            'payment_publication_date'          => $this->getValueIfExists($data, 'payment_publication_date'),
            'physician_first_name'              => $this->getValueIfExists($data, 'physician_first_name'),
            'physician_last_name'               => $this->getValueIfExists($data, 'physician_last_name'),
            'physician_middle_name'             => $this->getValueIfExists($data, 'physician_middle_name'),
            'physician_license_state_code1'     => $this->getValueIfExists($data, 'physician_license_state_code1'),
            'physician_ownership_indicator'     => $this->getValueIfExists($data, 'physician_ownership_indicator'),
            'physician_primary_type'            => $this->getValueIfExists($data, 'physician_primary_type'),
            'physician_profile_id'              => $this->getValueIfExists($data, 'physician_profile_id'),
            'physician_specialty'               => $this->getValueIfExists($data, 'physician_specialty'),
            'product_indicator'                 => $this->getValueIfExists($data, 'product_indicator'),
            'program_year'                      => $this->getValueIfExists($data, 'program_year'),
            'recipient_city'                    => $this->getValueIfExists($data, 'recipient_city'),
            'recipient_country'                 => $this->getValueIfExists($data, 'recipient_country'),
            'recipient_street_address1'         => $this->getValueIfExists($data, 'recipient_primary_business_street_address_line1'),
            'recipient_street_address2'         => $this->getValueIfExists($data, 'recipient_primary_business_street_address_line2'),
            'recipient_state'                   => $this->getValueIfExists($data, 'recipient_state'),
            'recipient_zip_code'                => $this->getValueIfExists($data, 'recipient_zip_code'),
            'recipient_province'                => $this->getValueIfExists($data, 'recipient_province'),
            'recipient_postal_code'             => $this->getValueIfExists($data, 'recipient_postal_code'),
            'record_id'                         => $this->getValueIfExists($data, 'record_id'),
            'applicable_name'                   => $this->getValueIfExists($data, 'submitting_applicable_manufacturer_or_applicable_gpo_name'),
            'third_party_payment_recipient_indicator'   => $this->getValueIfExists($data, 'third_party_payment_recipient_indicator'),
            'name_of_associated_covered_device_or_medical_supply1'  => $this->getValueIfExists($data, 'name_of_associated_covered_device_or_medical_supply1'),
            'total_amount'                      => $this->getValueIfExists($data, 'total_amount_of_payment_usdollars'),
            'created_at'                        => $dateTime,
            'updated_at'                        => $dateTime
        ];
    }

    /**
     * Build URL
     *
     * @param array $params
     * @return string
     */
    protected function buildUrl(array $params)
    {
        return self::API_ENDPOINT.'?'.http_build_query($params);
    }

    /**
     * @param array $data
     * @param $key
     * @return null|string
     */
    protected function getValueIfExists(array $data, $key)
    {
        return isset($data[$key]) ? $data[$key] : null;
    }
}