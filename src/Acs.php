<?php

namespace Gdinko\Acs;

class Acs
{
    use MakesHttpRequests;
    use Actions\ManagesCalls;
    use Actions\ManagesHelp;

    public const SIGNATURE = 'CARRIER_ACS';

    /**
     * Acs API Key
     */
    protected $apiKey;

    /**
     * Acs Company data
     */
    protected $companyData;

    /**
     * Acs API Base URL
     */
    protected $baseUrl;

    /**
     * Acs API Request timeout
     */
    protected $timeout;

    public function __construct()
    {
        $this->apiKey = config('acs.api-key');

        $this->timeout = config('acs.timeout');

        $this->setCompanyData();

        $this->configBaseUrl();
    }

    /**
     * configBaseUrl
     *
     * @return void
     */
    public function configBaseUrl(): void
    {
        $this->baseUrl = config('acs.base-url');
    }

    /**
     * setApiKey
     *
     * @param  string $apiKey
     * @return void
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * getApiKey
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * setCompanyData
     *
     * @return void
     */
    public function setCompanyData(): void
    {
        $this->companyData = [
            'Company_ID' => config('acs.company-id'),
            'Company_Password' => config('acs.company-password'),
            'User_ID' => config('acs.user-id'),
            'User_Password' => config('acs.user-password'),
            'Billing_Code' => config('acs.billing-code'),
        ];
    }

    /**
     * getCompanyData
     *
     * @return array
     */
    public function getCompanyData(): array
    {
        return $this->companyData;
    }

    /**
     * getUserName
     *
     * @return string
     */
    public function getUserName(): string
    {
        return $this->getCompanyData()['User_ID'] ?? null;
    }

    /**
     * getPassword
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getCompanyData()['User_Password'] ?? null;
    }

    /**
     * getSignature
     *
     * @return string
     */
    public function getSignature(): string
    {
        return self::SIGNATURE;
    }

    /**
     * setBaseUrl
     *
     * @param  string $baseUrl
     * @return void
     */
    public function setBaseUrl(string $baseUrl): void
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * getBaseUrl
     *
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * setTimeout
     *
     * @param  int $timeout
     * @return void
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * getTimeout
     *
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }
}
