<?php

namespace App\Jobs;

use App\Models\FuelIn;
use App\Traits\HasConfig;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CreateFuelIn implements ShouldQueue
{
    use Queueable;

    use HasConfig;

    protected array $attributes;
    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    public function handle(): void
    {
        foreach ($this->attributes as $attribute) {
            $data = $this->getFuelIn($attribute);

            FuelIn::create($data);
        }
    }
}
