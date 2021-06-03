<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollTitle extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    protected $table = 'poll_titles';
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}