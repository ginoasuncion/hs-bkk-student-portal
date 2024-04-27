<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'photo_path']; 

    public function photos()
    {
        return $this->hasMany(PostPhoto::class); 
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class); 
    }
}
