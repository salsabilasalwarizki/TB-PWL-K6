<?php

namespace App\Observers;

use App\Models\Dataset;
use Illuminate\Support\Facades\Cache;

class DatasetObserver
{
    public function created(Dataset $dataset)
    {
        $this->clearHomeCache();
    }
    
    public function updated(Dataset $dataset)
    {
        $this->clearHomeCache();
    }
    
    public function deleted(Dataset $dataset)
    {
        $this->clearHomeCache();
    }
    
    protected function clearHomeCache(): void
    {
        Cache::forget('home_stats');
        Cache::forget('popular_datasets');
        Cache::forget('new_datasets');
    }
}