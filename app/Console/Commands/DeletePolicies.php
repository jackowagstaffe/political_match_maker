<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ConstructData\DataConstructor;

class DeletePolicies extends Command
{
    protected $dataConstructor = null;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:delete_policies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create policies and policy positions in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DataConstructor $data_constructor)
    {
        $this->dataConstructor = $data_constructor;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->dataConstructor->deletePolicies();
    }
}
