<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Traits\HasConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateNewSale implements ShouldQueue
{
    use Queueable;
    use HasConfig;

    public $attributes;
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->attributes as $attribute) {
            // Get the current sale data
            $currentSale = $this->getNewSale($attribute);

            Sale::create($currentSale);
        }
    }
}
