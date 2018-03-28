<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App/Libraries/ContentMigrationService;

class ContentMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:content {type="article"}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to migrate content from the old system to the new';

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
        //
        $type = $this->argument('type');

       $result = $this->migrate($type);

    }
}
