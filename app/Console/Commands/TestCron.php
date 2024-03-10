<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $user = User::all();
        foreach ($user as $a) {
            Mail::raw("This is automatically generated Minute Update", function ($message) use ($a) {
                $message->from('devanshibhavsar018@gmail.com');
                $message->to($a->email)->subject('Every minute update');
            });
        }
        $this->info('Every Minute Update has been send successfully');
    }
}
