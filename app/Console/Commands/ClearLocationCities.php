<?php

namespace App\Console\Commands;

use App\Location;
use App\PostalAddress;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearLocationCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-location-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the city cache of each location';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('locations')->update(['city_cache' => null]);

        $this->info('🔥 City cache cleared for all locations!');
    }
}
