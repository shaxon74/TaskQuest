<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoneTask extends Model
{
    // protected $table = 'donetasks';
    // protected $primaryKey = 'id';
    // public $timestamps = true;
    protected $guarded = array('id');

    // カラムのデフォルト値を設定
    protected $attributes = [
        'is_done' => false,
    ];

}
