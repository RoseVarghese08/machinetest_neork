<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Define a one-to-many relationship with EmployeeProfile model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeeProfiles()
    {
        return $this->hasMany(EmployeeProfile::class, 'category_id');
    }

    /**
     * Define a many-to-many relationship with Hobby model through a pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hobbies()
    {
        return $this->belongsToMany(Hobby::class, 'category_hobby', 'category_id', 'hobby_id');
    }
}
