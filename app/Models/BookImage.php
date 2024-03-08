<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SplFileInfo;

class BookImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_url',
        'is_main_image'
    ];

    public function resizedUrl()
    {
        $info = new SplFileInfo($this->image_url);
        return $info->getPath() . "/resized_" . $info->getFilename();
    }
}
