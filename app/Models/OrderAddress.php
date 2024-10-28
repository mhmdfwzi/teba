<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class OrderAddress extends Model
{
    use HasFactory;

    public $timestamps = false;


   protected $fillable = [
    'order_id','type','first_name','last_name','phone_number',
    'governorate_id','city_id' ,'neighborhood_id', 'street_address'
   ];

   public function getNameAttribute(){
    return $this->first_name . ' ' . $this->last_name;
   }

   public function getCountryNameAttribute(){
    return Countries::getName($this->country);
   }

}