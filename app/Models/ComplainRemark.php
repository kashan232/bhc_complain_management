<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplainRemark extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['complain_id', 'complain_cnic', 'remark', 'status'];
}
