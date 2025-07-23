<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Traits\HasConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateSale implements ShouldQueue
{
    use Queueable;
    use HasConfig;

    protected array $attributes;
    protected int $chunkSize;
    public function __construct($attributes, $chunkSize = 500)
    {
        $this->attributes = $attributes;

        $this->chunkSize = $chunkSize;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        collect($this->attributes)->chunk($this->chunkSize)->each(function ($chunk) {
            $dataToInsert = [];

            foreach ($chunk as $attribute) {
                $dataToInsert[] = $this->getSale($attribute);
            }

            DB::table('sales')->insert($dataToInsert);
        });
    }
}
