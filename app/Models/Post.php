<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ["user", "category", "photos"];

    //accessor
    protected function time(): Attribute
    {
        return Attribute::make(
           // get: fn ($value) => ucfirst($value),
        get: fn () => "<span>
                            <i class='bi bi-calendar-date'></i>
                            {$this->created_at->format('M d, Y')}
                        </span>
                        <br>
                        <span>
                            <i class='bi bi-clock'></i>
                            {$this->created_at->format('H : m')}
                        </span>
                            "
        );
    }

    //laravel 8 method
    // public function getTimeAttribute() {
    //     return " <span>
    //                 <i class='bi bi-calendar-date'></i>
    //                 {$this->created_at->format('M d, Y')}
    //             </span>
    //             <br>
    //             <span>
    //                 <i class='bi bi-clock'></i>
    //                 {$this->created_at->format('H : m')}
    //             </span>
    //             ";
    // }

        //mutator
    public function setTitleAttribute($value)
    {
       $this->attributes['title'] = strtoupper($value);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function photos() {
        return $this->hasMany(Photo::class);
    }
    public function scopeSearch($query) {
        return $query->when(request('keyword'), function($q) {
            $keyword = request('keyword');
            $q->where('title', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
        });
    }
}
