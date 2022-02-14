<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendKannelsConnectionDetailsMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_kannels_connection_details_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Kannels Connection Details Mail';

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
        app('App\Http\Controllers\KannelLogsController')->sendKannelsConnectionDetailsMail();

        echo "Kannel connection messages sent successfully";
    }
}
