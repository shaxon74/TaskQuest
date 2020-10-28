<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $table = 'tasks';
    // protected $primaryKey = 'id';
    // public $timestamps = true;

    // カラムのデフォルト値を設定
    protected $attributes = [
        'is_finished' => false,
        'is_activated' => true,
    ];
}
