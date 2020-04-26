<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   
protected $fillable = [ 'id',
'task_title',
'assigned_to',
'description',
'status',
'date',
'duration'];
protected $table = 'tasks';
}
