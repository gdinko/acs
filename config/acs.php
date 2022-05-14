<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /**
     * Set ACS API Key
     */
    'api-key' => env('ACS_API_KEY'),

    /**
     * ACS Company Id
     */
    'company-id' => env('ACS_COMPANY_ID'),

    /**
     * ACS Company Password
     */
    'company-password' => env('ACS_COMPANY_PASSWORD'),

    /**
     * ACS User Id
     */
    'user-id' => env('ACS_USER_ID'),

    /**
     * ACS User Password
     */
    'user-password' => env('ACS_USER_PASSWORD'),

    /**
     * Acs Billing Code
     */
    'billing-code' => env('ACS_BILLING_CODE'),

    /**
     * Default ACS base url
     */
    'base-url' => rtrim(env('ACS_API_BASE_URL', 'https://webservices.acscourier.net/ACSRestServices/api/'), '/'),

    /**
     * Set Request timeout
     */
    'timeout' => env('ACS_API_TIMEOUT', 5),
];
