<?php
namespace Database\Seeders\Traits;
use Illuminate\Support\Facades\DB;

    trait DisableEnableForeignChecks
    {
        function enableforeignchecks() {
            DB::statement('SET foreign_key_checks=1');
        }
        function disableforeignchecks() {
            DB::statement('SET foreign_key_checks=0');
        }
    }
    
