<?php

namespace Database\Seeders\Traits;
use Illuminate\Support\Facades\DB;
    
trait TruncateTable
{
    function truncatetable($table) {
        DB::table($table)->truncate();
    }
}
