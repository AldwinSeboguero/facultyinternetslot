<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['name', 'department_id','first_slot_id','second_slot_id','third_slot_id','forth_slot_id','fifth_slot_id'];
}
