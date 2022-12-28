<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class RemoveExpiredToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokens:remove_all{--day=7 : the number of days to remain expired tokens}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove all expired tokens';

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
        $expiration = config('sanctum.expiration');
        if($expiration){

            $day = $this->option('day');
            $token = PersonalAccessToken::where('created_at', '<', now()->subMinute($expiration +($day * 24 * 60)));
            $token->delete();
            return 0;
        }
        $this->warn('Expire time is not set');
    }
}
