<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content']; 

    public function photos()
    {
        return $this->hasMany(PostPhoto::class); 
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class); 
    }

    public function topLevelComments() {
        return $this->hasMany(Comment::class)->whereNull('parent_comment_id');
        }
}
