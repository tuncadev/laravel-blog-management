<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PrepareTestEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:prepare-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare the test environment by ensuring the SQLite database file exists';

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
         // Force the application to use the testing environment
         config(['app.env' => 'testing']);
     
         // Ensure we are using the testing database configuration
         if (config('database.default') === 'sqlite') {
             $dbPath = database_path('tests.sqlite');
     
             if (!File::exists($dbPath)) {
                 File::put($dbPath, '');
                 $this->info('Test database file created: ' . $dbPath);
             } else {
                 $this->info('Test database file already exists.');
             }
         } else {
             $this->error('The database configuration is not set to SQLite.');
         }
     }
}
