<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'upload_id',
        'main_text',
        'more_text',
        'button',
        'button_url',
        'button_text',
        'uuid',
        'active',
    ];

    public function upload(){
        return $this->hasOne(ImageUpload::class, 'model_id', 'uuid');
    }

    public function getImageAttribute(){
        $upload = $this->upload;
        return !empty($upload)?$upload->photo():'';
    }

    public function getHasValidImageAttribute(){
        try{
            if(file_exists($this->upload->url)){
                return true;
            }
            return false;
        }catch (\Exception $e){
            return false;
        }
    }
}
