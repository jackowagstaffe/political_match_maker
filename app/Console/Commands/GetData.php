<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TheyWorkForYou;

class GetData extends Command
{
    protected $theyWorkForYou = null;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull data from they work for you';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TheyWorkForYou $they_work_for_you)
    {
        $this->theyWorkForYou = $they_work_for_you;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->theyWorkForYou->getMps();
        $this->theyWorkForYou->getMpInfo($this);
    }
}
