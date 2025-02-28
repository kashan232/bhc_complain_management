<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','fathername','cnic','incorrect_cnic','correct_cnic','district','taluka','contact','nature_of_complaint','other_descrpition','date_of_birth','cnic_issuance_date','status','created_at', 'updated_at'];


}
