<?php

namespace App\Models;

use App\Casts\FileLocalNameCast;
use App\Models\Traits\RandomIntId;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperFile
 */
class File extends Model
{
    use HasFactory, RandomIntId, Filterable, SoftDeletes;

    protected $casts = [
        'name_local' => FileLocalNameCast::class,
    ];

    public $incrementing = false;

    protected $guarded = ['id'];

    protected function getIdLength(){
        // defaults to 12; make sure the id column is set to bigInt for >= 10 digits
        return 16;
    }


}
