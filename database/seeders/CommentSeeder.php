<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableEnableForeignChecks;

class CommentSeeder extends Seeder
{
    use TruncateTable,DisableEnableForeignChecks;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->disableforeignchecks();
        $this->truncatetable('comments');
        Comment::factory(3)->create();
        $this->enableforeignchecks();
    }
}
