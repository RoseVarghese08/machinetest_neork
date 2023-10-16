<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = ['name'];

    // Define any relationships here, e.g., if hobbies are related to employee profiles
    public function employeeProfiles()
    {
        return $this->hasMany(EmployeeProfile::class, 'hobby_id');
    }
}
