<?php

namespace App\Console\Commands;

use App\Models\Rent;
use Illuminate\Console\Command;
use Carbon\Carbon;

class ReminderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addDays(330);
        $query = Rent::where('status', 'Unpaid')->whereBetween('due_date', [$startDate, $endDate])->get();

        foreach ($query as $q) {
            $message = "Dear " . getTenantdata($q->tenant_id, 'tenant_name') . ", Your Rent for the Month " . $q->rent_no . " is pending. Due Date is " . $q->due_date . " and Rent Amount is " . $q->amount;
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, 'https://api.paysmm.co.in/wapp/api/send?apikey=5359c713e91e46abb5329a01053e9904&mobile=' . getTenantdata($q->tenant_id, 'tenant_mobile') . '&msg=' . str_replace(" ", "+", $message));
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $buffer = curl_exec($curl_handle);
            curl_close($curl_handle);
        }
    }
}
