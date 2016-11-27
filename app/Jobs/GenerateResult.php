<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\ResultGenerator;
use App\Match;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateResult extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data = null;
    protected $hash = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $hash)
    {
        $this->data = $data;
        $this->hash = $hash;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ResultGenerator $gen)
    {
        $match = Match::where('hash', $this->hash)->first();
        if (is_null($match)) {
            $gen->setData($this->data);

            $gen->run();
            $mp = $gen->getMember();

            $match = new Match;
            $match->hash = $this->hash;
            $match->member_id = $mp->id;
            $match->match_details = 'none';

            $match->save();
        }
    }
}
