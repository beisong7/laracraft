<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'price',
        'is_new',
        'old_price',
        'category_id',
        'maker_id',
        'active',
        'pic1',
        'pic2',
        'pic3',
        'featured',
        'details',
        'view_count',
        'sold_count',
        'discount',
    ];

    public function category(){
        return $this->hasOne(Category::class, 'uuid', 'category_id');
    }

    public function producer(){
        return $this->hasOne(Maker::class, 'uuid', 'maker_id');
    }

    public function getpic1(){
        return !empty($this->pic1)?url($this->pic1):'';
    }

    public function getpic2(){
        return !empty($this->pic2)?url($this->pic2):'';
    }

    public function getpic3(){
        return !empty($this->pic3)?url($this->pic3):'';
    }

    public function uploads(){
        return $this->hasMany(ImageUpload::class, 'model_id', 'uuid');
    }

    public function getTwoImageAttribute(){

        $images = ImageUpload::where('model_id', $this->uuid)->take(2)->get();
        return !empty($images)?$images:[];
    }

    public function getImagesAttrubute(){
        return $this->uploads;
    }

    public function discount_old(){
        if(empty($this->oldprice)){
            return null;
        }else{
            return 'less %' .round((($this->oldprice - $this->price )/ $this->oldprice) * 100);
        }

    }

    public function discount(){
        if(!empty($this->oldprice)){
            $price = number_format($this->oldprice, 2);
            return "<s>$price</s>";
        }
        return null;
    }

    public function hits(){
        return !empty($this->view_count)?$this->view_count:0;
    }

    public function related(){
        if(!empty($this->category)){
            $catName = $this->category->name;
            if(!empty($this->producer)){
                $prodName = $this->producer->name;
                return Product::orderBy('view_count','desc')
                    ->whereHas('category', function (Builder $builder) use ($catName) {
                        $builder->where('name', $catName);})
                    ->orWhereHas('producer', function (Builder $builder) use ($prodName) {
                        $builder->where('name', $prodName);})
                    ->where('uuid', '!=', $this->uuid)
                    ->where('active', true)->take(6)->get();
            }else{

                return Product::orderBy('view_count','desc')
                    ->whereHas('category', function (Builder $builder) use ($catName) {
                        $builder->where('name', $catName);})
                    ->where('uuid', '!=', $this->uuid)
                    ->where('active', true)->take(6)->get();
            }
        }
        return [];


    }

    public function reviews(){
        return $this->hasMany(Review::class, 'product_key', 'uuid');
    }

    public function getOnePicAttribute(){
        $firstImg = $this->uploads->first();
        return !empty($firstImg)?$firstImg->url:'';
    }

    public function getReviewedAttribute(){
        return Review::where('product_key', $this->uuid)->where('active', true)->orderBy('id', 'desc')->get();
    }

    public function getSizesAttribute(){
        return SizeSet::where('product_id', $this->uuid)->get();
    }

    public function getColorsAttribute(){
        return ColorSet::where('product_id', $this->uuid)->get();
    }

    public function getIsNewAttribute(){
        $unix_created = strtotime($this->created_at);
        $range = $unix_created + 172800;
        if($range > time()){
            return true;
        }
        return false;
    }

    public function getRatedAttribute(){
        $star = "<li><a href='#'><i class='fa fa-star' aria-hidden='true'></i></a>";
        return "";
    }



}
