<?php

namespace App\Console\Commands;

use App\Models\Attendee;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class GenrateHashCodeForAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:hash {userId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate hash code for all or specific user';

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
     * @return mixed
     */
    public function handle()
    {
        if (! $this->argument('userId') ) {
            $attendees = Attendee::all();
        } else {
            $attendees = Attendee::where('id', $this->argument('userId'))->get();
        }

        foreach ($attendees as $attendee) {
            $attendee->hash_code = Uuid::uuid4();
            $attendee->hash_code_duration = now()->addDays(env('HASH_CODE_DURATION_IN_DAYS', 5));
            $attendee->save();
        }
    }
}
