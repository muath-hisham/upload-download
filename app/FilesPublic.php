<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilesPublic extends Model
{
    protected $table = 'filespublic';
    protected $fillable = ['title', 'file', 'des'];
}
