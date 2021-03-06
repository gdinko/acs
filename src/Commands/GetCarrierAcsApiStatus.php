<?php

namespace Gdinko\Acs\Commands;

use Gdinko\Acs\Facades\Acs;
use Gdinko\Acs\Models\CarrierAcsApiStatus;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GetCarrierAcsApiStatus extends Command
{
    public const API_STATUS_OK = 200;
    public const API_STATUS_NOT_OK = 404;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acs:api-status
                            {--clear= : Clear Database table from records older than X days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets Acs API Status and saves it in database';

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
        $this->info('-> Carrier Acs Api Status');

        try {
            $this->clear();

            $contentTypes = Acs::ACS_Get_Content_Types();

            if (! empty($contentTypes['ACSOutputResponce']['ACSTableOutput']['Table_Data'])) {
                CarrierAcsApiStatus::create([
                    'code' => self::API_STATUS_OK,
                ]);

                $this->info('Status: ' . self::API_STATUS_OK);
            }
        } catch (\Exception $e) {
            CarrierAcsApiStatus::create([
                'code' => self::API_STATUS_NOT_OK,
            ]);

            $this->newLine();
            $this->error('Status: ' . self::API_STATUS_NOT_OK);
            $this->error(
                $e->getMessage()
            );
        }

        return 0;
    }

    /**
     * clear
     *
     * @return void
     */
    protected function clear()
    {
        if ($days = $this->option('clear')) {
            $clearDate = Carbon::now()->subDays($days)->format('Y-m-d H:i:s');

            $this->info("-> Carrier Acs Api Status : Clearing entries older than: {$clearDate}");

            CarrierAcsApiStatus::where('created_at', '<=', $clearDate)->delete();
        }
    }
}
