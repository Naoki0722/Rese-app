<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\RemindMail;
use App\Models\Reserve;

class ReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send_remind_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'リマインドメールを送ります';

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
        $this->info('start');
        $today = Carbon::today()->format('Y-m-d');
        $reserves = Reserve::where('date', 'LIKE', "%{$today}%")->with('user', 'shop')->get();
        foreach ($reserves as $reserve) {
            Mail::to($reserve->user->email)->send(new RemindMail($reserve));
        }
        $this->info('Complete');
    }
}
