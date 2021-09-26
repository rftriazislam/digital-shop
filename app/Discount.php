<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
  public function   social_info()
  {
    return $this->hasOne('App\SocialMedia', 'id', 'product_id');
  }

  public function   make_info()
  {
    return $this->hasOne('App\MakePayment', 'id', 'product_id');
  }
  public function   influence_info()
  {
    return $this->hasOne('App\InfluenceMarketing', 'id', 'product_id');
  }
  public function   gift_info()
  {
    return $this->hasOne('App\GiftCard', 'id', 'product_id');
  }
  public function   subscription_info()
  {
    return $this->hasOne('App\Subscription', 'id', 'product_id');
  }
  public function   digital_info()
  {
    return $this->hasOne('App\DigitalWallet', 'id', 'product_id');
  }
  public function   advertisement_info()
  {
    return $this->hasOne('App\AdvertisementAccount', 'id', 'product_id');
  }
  public function   promotion_info()
  {
    return $this->hasOne('App\SocialMediaPromotion', 'id', 'product_id');
  }
  public function   top_info()
  {
    return $this->hasOne('App\TopUpApps', 'id', 'product_id');
  }
  public function   game_info()
  {
    return $this->hasOne('App\GamesZone', 'id', 'product_id');
  }
}