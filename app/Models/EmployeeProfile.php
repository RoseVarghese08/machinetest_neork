<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $fillable = [
        'name',
        'contact_number',
        'hobby_id',
        'category_id',
        'profile_picture',
    ];

    // Define relationships with the Hobby and Category models if needed
    public function hobby()
    {
        return $this->belongsTo(Hobby::class, 'hobby_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
