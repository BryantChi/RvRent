<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RentOrderInfo as Order;

class DataReconciliationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:dataclear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order&Stock DataReconciliation';

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
        // return 0;
        $checkDataReconciliation = Order::setDataReconciliation();
        if ($checkDataReconciliation) {
            \Log::info('Cron Job has been sucessed.');
        } else {
            \Log::info('Cron Job has fail.');
        }
        // \Log::info('Cron Job has been executed.');
    }
}
