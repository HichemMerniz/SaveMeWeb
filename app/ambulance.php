<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ambulance extends Model
{
    protected $fillable = [
        'code_hopital','distance','position',];
}
