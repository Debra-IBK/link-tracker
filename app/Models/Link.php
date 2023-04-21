<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    
    public function getLinkAttribute()
    {
        return url($this->code);
    }

    public function incrementClicks()
    {
        $this->clicks++;
        $this->save();
    }
}
