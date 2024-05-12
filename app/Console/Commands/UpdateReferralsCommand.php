<?php

namespace App\Console\Commands;

use App\Models\Referral\Referral;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateReferralsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-referrals-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $currentDate = Carbon::now();

       
        Referral::whereDate('referral_date', '<', $currentDate)->update(['statustype_id' => '2']);

    }
}
