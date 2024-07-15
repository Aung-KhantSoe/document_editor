<?php

namespace App\Traits;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    public function author():User
    {
        return $this->authorRelation;
    }
    
    public function authorRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function isAuthorBy(User $user) : bool 
    {
        return $this->author()->mathches($user);
    }

    public function authorBy(User $author)
    {
        return $this->authorRelation()->associate($author);
    }
}
