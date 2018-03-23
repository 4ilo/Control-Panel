<?php

namespace App\Console\Commands;

use App\Output;
use Illuminate\Console\Command;

class SetOutputMode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ovde:setPinMode';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the pin mode to output for all registered outputs';
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Output::all()->each->setPinMode();
    }
}
