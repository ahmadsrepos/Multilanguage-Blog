<?php

namespace App\Http\Traits;

use Str;

trait MainHelpers
{
    public function uploadImage($image, $type='category')
    {
        $extension = $image->extension();
        $name = Str::random(10).'.'.$extension;

        switch ($type) 
        {
            case 'category':

                $image->move(public_path('/').'/images/categories/', $name);

                break;

            case 'post':
                
                $image->move(public_path('/').'/images/posts/', $name);

                break;
            
            default:
                abort(404);
                break;
        }

        return $name;
    }
}