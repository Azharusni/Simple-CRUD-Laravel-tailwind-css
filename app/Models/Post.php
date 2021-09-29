<?php

namespace App\Models;

use App\Models\Traits\HashUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, HashUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'image', 'title', 'content',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $primaryKey = 'id';


}
