<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ambulance extends Model
{
    public $table = "ambulance";
    protected $fillable = [
        'code_hopital','distance','position',];
}
