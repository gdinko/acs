<?php

namespace Gdinko\Acs\Commands;

use Gdinko\Acs\Events\CarrierAcsTrackingEvent;
use Gdinko\Acs\Exceptions\AcsImportValidationException;
use Gdinko\Acs\Facades\Acs;
use Gdinko\Acs\Models\CarrierAcsTracking;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

abstract class TrackCarrierAcsBase extends Command
{
    protected $parcels = [];

    protected $muteEvents = false;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acs:track
                            {--clear= : Clear Database table from records older than X days}
                            {--timeout=20 : Acs API Call timeout}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track Acs parcels';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('-> Carrier Acs Parcel Tracking');

        try {
            $this->setup();

            $this->clear();

            Acs::setTimeout(
                $this->option('timeout')
            );

            $this->track();

            $this->newLine(2);
        } catch (AcsImportValidationException $eive) {
            $this->newLine();
            $this->error(
                $eive->getMessage()
            );
            $this->info(
                print_r($eive->getData(), true)
            );
            $this->error(
                print_r($eive->getErrors(), true)
            );
        } catch (\Exception $e) {
            $this->newLine();
            $this->error(
                $e->getMessage()
            );
        }

        return 0;
    }

    /**
     * setup
     *
     * @return void
     */
    abstract protected function setup();

    /**
     * clear
     *
     * @return void
     */
    protected function clear()
    {
        if ($days = $this->option('clear')) {
            $clearDate = Carbon::now()->subDays($days)->format('Y-m-d H:i:s');

            $this->info("-> Carrier Acs Parcel Tracking : Clearing entries older than: {$clearDate}");

            CarrierAcsTracking::where('created_at', '<=', $clearDate)->delete();
        }
    }

    /**
     * track
     *
     * @return void
     */
    protected function track()
    {
        $bar = $this->output->createProgressBar(
            count($this->parcels)
        );

        $bar->start();

        if (! empty($this->parcels)) {
            foreach ($this->parcels as $parcel) {
                $trackingInfo = Acs::ACS_Trackingsummary(
                    $this->prepareParcelRequest($parcel)
                )['ACSOutputResponce']['ACSTableOutput']['Table_Data'][0] ?? [];

                $trackingInfo['operations'] = Acs::ACS_TrackingDetails(
                    $this->prepareParcelRequest($parcel)
                )['ACSOutputResponce']['ACSTableOutput']['Table_Data'] ?? [];

                if (! empty($trackingInfo)) {
                    $this->processTracking($trackingInfo);
                }

                $bar->advance();
            }
        }

        $bar->finish();
    }

    /**
     * prepareParcelRequest
     *
     * @param  string $parcel
     * @return array
     */
    protected function prepareParcelRequest(string $parcel): array
    {
        return [
            'Voucher_No' => $parcel,
        ];
    }

    /**
     * processTracking
     *
     * @param  array $trackingInfo
     * @return void
     */
    protected function processTracking(array $trackingInfo)
    {
        CarrierAcsTracking::updateOrCreate(
            [
                'parcel_id' => $trackingInfo['voucher_no'],
            ],
            [
                'carrier_signature' => Acs::getSignature(),
                'carrier_account' => Acs::getUserName(),
                'meta' => $trackingInfo['operations'],
            ]
        );

        if (! $this->muteEvents) {
            CarrierAcsTrackingEvent::dispatch(
                array_pop($trackingInfo['operations']),
                Acs::getUserName()
            );
        }
    }
}
