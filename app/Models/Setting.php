<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['title', 'description', 'address'];
    protected $fillable = ['logo', 'favicon', 'facebook', 'twitter', 'instagram', 'phone', 'email', 'allow_comments', 'revise_comments'];

    static function handleSettings()
    {
        $settings = self::first();

        if(!$settings) {

            $data = [];
            foreach(config('app.languages') as $key=>$value) {

                $data[$key]['title'] = $value;
                $data[$key]['description'] = $value;
                $data[$key]['address'] = $value;
            }

            self::create($data);

            return self::first();
        }
        
        return $settings;
        
    }
}
