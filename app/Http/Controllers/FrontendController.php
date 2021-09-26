<?php


namespace App\Http\Controllers;

use App\AdvertisementAccount;
use App\Category;
use App\Checkout;
use App\DigitalWallet;
use App\ExchangeRate;
use App\GamesZone;
use App\GiftCard;
use App\User;
use App\InfluenceMarketing;
use App\MakePayment;
use App\SocialMedia;
use App\Subcategory;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\SellOrder;
use App\SocialMediaPromotion;
use App\Subscription;
use App\TopUpApps;
use App\TransanctionHistory;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Http;
use \Carbon\Carbon;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use smasif\ShurjopayLaravelPackage\ShurjopayService;
use Symfony\Component\HttpFoundation\IpUtils;

// use Cart;


class FrontendController extends Controller
{

    protected function calculate_currency($form_name, $post_id, $price)
    {

        $price = $price;

        if (Auth::user() == '') {
            $cahe =   Cache::get('data_currency');

            if ($cahe == null) {

                $p = $this->getUserIP();

                $data =   Http::get('https://ipapi.co/' . '92.38.148.61' . '/json/')->json();

                $cahe =   Cache::put('data_currency',   $data);

                $currency_api = Cache::get('data_currency');

                if ($form_name == "make_payment") {
                    $user = MakePayment::where('post_id', $post_id)->first();
                    $currecny_user = $user->get_currency;

                    $exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
                    $price_user = $price / $exchange_user->money;
                    $exchange = ExchangeRate::where('rates', $currency_api['currency'])->first();
                    $prc = $price_user * $exchange->money;
                    $price_product =  round($prc, 2) . ' ' . $exchange->rates;
                } else {
                    $user = User::select('currency')->where('id', $post_id)->first();
                    $currecny_user = $user->currency;
                    $exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
                    $price_user = $price / $exchange_user->money;
                    $exchange = ExchangeRate::where('rates', $currency_api['currency'])->first();
                    $prc = $price_user * $exchange->money;
                    $price_product =  round($prc, 2) . ' ' . $exchange->rates;
                }
            } else {

                $currency_api = Cache::get('data_currency');

                if ($form_name == "make_payment") {

                    $user = MakePayment::where('post_id', $post_id)->first();
                    $currecny_user = $user->get_currency;

                    $exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
                    $price_user = $price / $exchange_user->money;
                    $exchange = ExchangeRate::where('rates', $currency_api['currency'])->first();
                    $prc = $price_user * $exchange->money;
                    $price_product =  round($prc, 2) . ' ' . $exchange->rates;
                } else {
                    $user = User::select('currency')->where('id', $post_id)->first();
                    $currecny_user = $user->currency;
                    $exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
                    $price_user = $price / $exchange_user->money;
                    $exchange = ExchangeRate::where('rates', $currency_api['currency'])->first();
                    $prc = $price_user * $exchange->money;
                    $price_product =  round($prc, 2) . ' ' . $exchange->rates;
                }
            }
        } else {

            if ($form_name == "make_payment") {

                $user = MakePayment::where('post_id', $post_id)->first();

                $currecny_user = $user->get_currency;

                $exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
                $price_user = $price / $exchange_user->money;

                $social = User::select('currency')->where('id', Auth::user()->id)->first();
                $currecny = $social->currency;
                $exchange = ExchangeRate::where('rates', $currecny)->first();
                $prc = $price_user * $exchange->money;

                $price_product =  round($prc, 2) . ' ' .     $exchange->rates;
            } else {
                $user = User::select('currency')->where('id', $post_id)->first();
                $currecny_user = $user->currency;

                $exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
                $price_user = $price / $exchange_user->money;



                $social = User::select('currency')->where('id', Auth::user()->id)->first();

                $currecny = $social->currency;
                $exchange = ExchangeRate::where('rates', $currecny)->first();
                $prc = $price_user * $exchange->money;

                $price_product =  round($prc, 2) . ' ' .     $exchange->rates;
            }
        }


        return $price_product;
    }
    public  function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }



    public function home()
    {


        $category = Category::Select(['id', 'name', 'form_name', 'image'])->where('status', 1)->get();

        $subcategory = Subcategory::select(['*'])->where('status', 1)->orderByDesc('id')->take(16)->get();

        $sub = SocialMedia::where('status', 1)->orderByDesc('id')->take(6)->get();

        $social_media = [];
        foreach ($sub as $value) {
            $social_media[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                'friends' => ($value->friends > 1000) ? (round(($value->friends / 1000), 1) . 'k') : $value->friends,
                'followers' => ($value->followers > 1000) ? (round(($value->followers / 1000), 1) . 'k') : $value->followers,
                'social_name' => $value->social_name,
                'post_id' => $value->post_id,
                'user_name' => $value->user_info->name,
                'form_name' => $value->category_info->form_name,
                'flag' => $value->user_info->flag,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name
            );
        }




        $make_payment_item = MakePayment::where('status', 1)->orderByDesc('id')->take(6)->get();
        $make_payment = [];
        foreach ($make_payment_item as $value) {
            $make_payment[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                'send_amount' => $value->send_amount,
                'send_wallet' => $value->send_wallet,
                'send_currency' => $value->send_currency,
                'post_id' => $value->post_id,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'form_name' => $value->category_info->form_name,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name
            );
        }



        $inf = InfluenceMarketing::where('status', 1)->orderByDesc('id')->take(6)->get();

        $influence = [];
        foreach ($inf as $value) {
            $influence[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                'social_name' => $value->social_name,
                'form_name' => $value->category_info->form_name,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name,
                'hiring_time' => $value->hiring_time,
                'post_id' => $value->post_id,
                'last_eng' => $value->last_engagement,
            );
        }

        $gift = GiftCard::where('status', 1)->orderByDesc('id')->take(6)->get();

        $giftcard = [];
        foreach ($gift as $value) {
            $giftcard[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                'name' => $value->name,
                'qty' => $value->qty,
                'form_name' => $value->category_info->form_name,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'image' => $value->subcategory_info->image,
                'post_id' => $value->post_id,
                'subcategory_name' => $value->subcategory_info->name,
            );
        }

        $subs = Subscription::where('status', 1)->orderByDesc('id')->take(6)->get();

        $subscription = [];
        foreach ($subs as $value) {
            $subscription[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                'qty' => $value->qty,
                'name' => $value->name,
                'form_name' => $value->category_info->form_name,
                'flag' => $value->user_info->flag,
                'user_name' => $value->user_info->name,
                'image' => $value->subcategory_info->image,
                'post_id' => $value->post_id,
                'subcategory_name' => $value->subcategory_info->name,

            );
        }

        $digital = DigitalWallet::where('status', 1)->orderByDesc('id')->take(6)->get();

        $digital_wallet = [];
        foreach ($digital as $value) {
            $digital_wallet[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                'name' => $value->account_name,
                'currency' => $value->account_currency,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'balance' => $value->balance,
                'post_id' => $value->post_id,
                'form_name' => $value->category_info->form_name,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name,

            );
        }

        $advertisment = AdvertisementAccount::where('status', 1)->orderByDesc('id')->take(6)->get();

        $advertisment_account = [];
        foreach ($advertisment as $value) {
            $advertisment_account[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                'name' => $value->account_name,
                'post_id' => $value->post_id,
                'form_name' => $value->category_info->form_name,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'currency' => $value->account_currency,
                'balance' => $value->balance,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name,


            );
        }

        $socialpromotion = SocialMediaPromotion::where('status', 1)->orderByDesc('id')->take(6)->get();

        $promotion = [];
        foreach ($socialpromotion as $value) {
            $promotion[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                'name' => $value->product_name,
                'post_id' => $value->post_id,
                'form_name' => $value->category_info->form_name,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'total_subscriber' => $value->total_follower_subscriber,
                'subscriber' => $value->follower_subscriber,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name,


            );
        }

        $top_up = TopUpApps::where('status', 1)->orderByDesc('id')->take(6)->get();

        $topupapps = [];
        foreach ($top_up as $value) {
            $topupapps[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                'name' => $value->product_name,
                'post_id' => $value->post_id,
                'form_name' => $value->category_info->form_name,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'total_top_up' => $value->total_top_up,
                'top_up' => $value->top_up,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name,


            );
        }


        $game_zone = GamesZone::where('status', 1)->orderByDesc('id')->take(6)->get();

        $gamezone = [];
        foreach ($game_zone as $value) {
            $gamezone[] = array(
                'id' => $value->id,
                'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                'name' => $value->product_name,
                'post_id' => $value->post_id,
                'form_name' => $value->category_info->form_name,
                'user_name' => $value->user_info->name,
                'flag' => $value->user_info->flag,
                'total_diamonds' => $value->total_diamonds,
                'diamonds' => $value->diamonds,
                'image' => $value->subcategory_info->image,
                'subcategory_name' => $value->subcategory_info->name,

            );
        }

        return view('frontend.home.page.maincontent', compact(
            'category',
            'subcategory',

            'make_payment',
            'influence',
            'giftcard',
            'subscription',
            'social_media',
            'digital_wallet',
            'advertisment_account',
            'promotion',
            'topupapps',
            'gamezone'

        ));
    }


    public function category($category_name)
    {
        $form_name = $category_name;

        if ($form_name == 'social_media') {
            $social = SocialMedia::where('status', 1)->get();
            $data = [];
            foreach ($social as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'friends' => ($value->friends > 1000) ? (round(($value->friends / 1000), 1) . 'k') : $value->friends,
                    'followers' => ($value->followers > 1000) ? (round(($value->followers / 1000), 1) . 'k') : $value->followers,
                    'social_name' => $value->social_name,
                    'post_id' => $value->post_id,
                    'user_name' => $value->user_info->name,
                    'form_name' => $value->category_info->form_name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name
                );
            }
        } elseif ($form_name == 'make_payment') {

            // $data = MakePayment::where('status', 1)->get();
            $make_payment_item = MakePayment::where('status', 1)->orderByDesc('id')->get();
            $data = [];
            foreach ($make_payment_item as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'send_amount' => $value->send_amount,
                    'send_wallet' => $value->send_wallet,
                    'send_currency' => $value->send_currency,
                    'post_id' => $value->post_id,
                    'user_name' => $value->user_info->name,
                    'form_name' => $value->category_info->form_name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name
                );
            }
        } elseif ($form_name == 'influence_marketing') {


            $inf = InfluenceMarketing::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($inf as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'social_name' => $value->social_name,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,
                    'hiring_time' => $value->hiring_time,
                    'post_id' => $value->post_id,
                    'last_eng' => $value->last_engagement,
                );
            }
        } elseif ($form_name == 'gift_card') {

            $gift = GiftCard::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($gift as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'name' => $value->name,
                    'qty' => $value->qty,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'image' => $value->subcategory_info->image,
                    'post_id' => $value->post_id,
                    'subcategory_name' => $value->subcategory_info->name,
                );
            }
        } elseif ($form_name == 'subscription') {
            $subs = Subscription::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($subs as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'qty' => $value->qty,
                    'name' => $value->name,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'image' => $value->subcategory_info->image,
                    'post_id' => $value->post_id,
                    'subcategory_name' => $value->subcategory_info->name,

                );
            }
        } elseif ($form_name == 'digital_wallet') {

            $digital = DigitalWallet::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($digital as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'name' => $value->account_name,
                    'currency' => $value->account_currency,
                    'user_name' => $value->user_info->name,
                    'balance' => $value->balance,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,

                );
            }
        } elseif ($form_name == 'advertisement_account') {



            $advertisment = AdvertisementAccount::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($advertisment as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'name' => $value->account_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'currency' => $value->account_currency,
                    'balance' => $value->balance,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,


                );
            }
        } elseif ($form_name == 'social_media_promotion') {
            $socialpromotion = SocialMediaPromotion::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($socialpromotion as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'name' => $value->product_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'total_subscriber' => $value->total_follower_subscriber,
                    'subscriber' => $value->follower_subscriber,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,


                );
            }
        } elseif ($form_name == 'games_zone') {

            $game_zone = GamesZone::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($game_zone as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'name' => $value->product_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'total_diamonds' => $value->total_diamonds,
                    'diamonds' => $value->diamonds,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,

                );
            }
        } elseif ($form_name == 'top_up_apps') {
            $top_up = TopUpApps::where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($top_up as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'name' => $value->product_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'total_top_up' => $value->total_top_up,
                    'top_up' => $value->top_up,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,


                );
            }
        }


        return view('frontend.home.page.category', compact('form_name', 'data'));
    }


    public function subcategory()
    {

        $data = Subcategory::where('status', 1)->get();

        return view('frontend.home.page.subcategory', compact('data'));
    }


    public function singlesubcategory($subcategory_id, $form_name)
    {


        $form_name = $form_name;


        if ($form_name == 'social_media') {
            $social = SocialMedia::where('subcategory_id', $subcategory_id)->where('status', 1)->get();
            $data = [];
            foreach ($social as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'friends' => ($value->friends > 1000) ? (round(($value->friends / 1000), 1) . 'k') : $value->friends,
                    'followers' => ($value->followers > 1000) ? (round(($value->followers / 1000), 1) . 'k') : $value->followers,
                    'social_name' => $value->social_name,
                    'post_id' => $value->post_id,
                    'user_name' => $value->user_info->name,
                    'form_name' => $value->category_info->form_name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name
                );
            }
        } elseif ($form_name == 'make_payment') {

            // $data = MakePayment::where('status', 1)->get();
            $make_payment_item = MakePayment::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();
            $data = [];
            foreach ($make_payment_item as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'send_amount' => $value->send_amount,
                    'send_wallet' => $value->send_wallet,
                    'send_currency' => $value->send_currency,
                    'post_id' => $value->post_id,
                    'user_name' => $value->user_info->name,
                    'form_name' => $value->category_info->form_name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name
                );
            }
        } elseif ($form_name == 'influence_marketing') {


            $inf = InfluenceMarketing::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($inf as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'social_name' => $value->social_name,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,
                    'hiring_time' => $value->hiring_time,
                    'post_id' => $value->post_id,
                    'last_eng' => $value->last_engagement,
                );
            }
        } elseif ($form_name == 'gift_card') {

            $gift = GiftCard::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($gift as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'name' => $value->name,
                    'qty' => $value->qty,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'image' => $value->subcategory_info->image,
                    'post_id' => $value->post_id,
                    'subcategory_name' => $value->subcategory_info->name,
                );
            }
        } elseif ($form_name == 'subscription') {
            $subs = Subscription::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($subs as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'qty' => $value->qty,
                    'name' => $value->name,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'image' => $value->subcategory_info->image,
                    'post_id' => $value->post_id,
                    'subcategory_name' => $value->subcategory_info->name,

                );
            }
        } elseif ($form_name == 'digital_wallet') {

            $digital = DigitalWallet::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($digital as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'name' => $value->account_name,
                    'currency' => $value->account_currency,
                    'user_name' => $value->user_info->name,
                    'balance' => $value->balance,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,

                );
            }
        } elseif ($form_name == 'advertisement_account') {



            $advertisment = AdvertisementAccount::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($advertisment as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
                    'name' => $value->account_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'currency' => $value->account_currency,
                    'balance' => $value->balance,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,


                );
            }
        } elseif ($form_name == 'social_media_promotion') {
            $socialpromotion = SocialMediaPromotion::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($socialpromotion as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'name' => $value->product_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'total_subscriber' => $value->total_follower_subscriber,
                    'subscriber' => $value->follower_subscriber,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,


                );
            }
        } elseif ($form_name == 'games_zone') {

            $game_zone = GamesZone::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($game_zone as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'name' => $value->product_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'total_diamonds' => $value->total_diamonds,
                    'diamonds' => $value->diamonds,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,

                );
            }
        } elseif ($form_name == 'top_up_apps') {
            $top_up = TopUpApps::where('subcategory_id', $subcategory_id)->where('status', 1)->orderByDesc('id')->get();

            $data = [];
            foreach ($top_up as $value) {
                $data[] = array(
                    'id' => $value->id,
                    'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->unit_price),
                    'name' => $value->product_name,
                    'post_id' => $value->post_id,
                    'form_name' => $value->category_info->form_name,
                    'user_name' => $value->user_info->name,
                    'total_top_up' => $value->total_top_up,
                    'top_up' => $value->top_up,
                    'image' => $value->subcategory_info->image,
                    'subcategory_name' => $value->subcategory_info->name,


                );
            }
        }

        return view('frontend.home.page.singlesubcategory', compact('form_name', 'data'));
    }

    public function addcartpage($id, $form_name, Request $request)
    {


        $form_name = $form_name;

        if ($form_name == 'social_media') {
            $data = SocialMedia::where('id', $id)->where('status', 1)->first();
            if (empty($data)) {
            } else {
                $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->price);

                $related_products = SocialMedia::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }
            //    'http://127.0.0.1:8000/add-cart/67/social_media';

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'make_payment') {

            $data = MakePayment::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->unit_price);
            if (empty($data)) {
            } else {
                $related_products = MakePayment::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'influence_marketing') {

            $data = InfluenceMarketing::where('id', $id)->where('status', 1)->first();

            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->price);
            if (empty($data)) {
            } else {


                $related_products = InfluenceMarketing::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'gift_card') {

            $data = GiftCard::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->price);
            if (!empty($data)) {
                $related_products = GiftCard::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'subscription') {

            $data = Subscription::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->price);
            if (!empty($data)) {
                $related_products = Subscription::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'advertisement_account') {

            $data = AdvertisementAccount::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->price);
            if (!empty($data)) {
                $related_products = AdvertisementAccount::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'digital_wallet') {

            $data = DigitalWallet::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->price);
            if (!empty($data)) {
                $related_products = DigitalWallet::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'social_media_promotion') {


            $data = SocialMediaPromotion::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->unit_price);
            if (!empty($data)) {
                $related_products = SocialMediaPromotion::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'top_up_apps') {

            $data = TopUpApps::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->unit_price);
            if (!empty($data)) {
                $related_products = TopUpApps::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        } elseif ($form_name == 'games_zone') {

            $data = GamesZone::where('id', $id)->where('status', 1)->first();
            $price = $this->calculate_currency($data->category_info->form_name, $data->post_id, $data->unit_price);
            if (!empty($data)) {
                $related_products = GamesZone::where('subcategory_id', $data->subcategory_id)->where('status', 1)->latest()->get();
            }

            if (Auth::user() == '') {
                $affiliate_link = '';
            } else {
                // $affiliate_link = url('-affiliate-' . $id . '-' . $form_name . '?affiliate=' . Auth::user()->id);
                $ran_number = rand(5, 12345);
                $affiliate_id = 'get-affiliate/"' . Auth::user()->id . '"/only-for-you' . '/' . $ran_number;
                $decrypt_result = base64_encode($affiliate_id);
                $affiliate_link = route('affiliate_link', [$id, $form_name, 'affiliate' => $decrypt_result, 'unique' => $ran_number]);
            }
        }

        $affiliate_id = $this->affiliate($request->affiliate);



        if (empty($data)) {
            return redirect()->route('home');
        } else {
            return view('frontend.home.page.addtocart', compact(
                'data',
                'form_name',
                'price',
                'related_products',
                'affiliate_link',
                'affiliate_id'
            ));
        }
    }

    protected function affiliate($affiliate)
    {
        if ($affiliate) {
            $result = base64_decode($affiliate);
            $search_data = substr($result, strpos($result, 'get-affiliate/"') + 15);
            $txid = substr($search_data, 0, strpos($search_data, '"/only-for-you/'));

            if ($txid) {
                $use_id = $txid;
                $user_id = User::where('id', $use_id)->first();
                if ($user_id) {

                    if (Auth::user() == '') {
                        $affiliate_id = $txid;
                    } else {
                        Auth::user()->id == $use_id ? $affiliate_id = '' : $affiliate_id = $use_id;
                    }
                } else {
                    $affiliate_id = '';
                }
            } else {
                $affiliate_id = '';
            }
        } else {
            $affiliate_id = '';
        }

        return $affiliate_id;
    }


    public function cartpage()
    {

        return view('frontend.home.page.cartpage');
    }
    protected function checkout_price($currecny, $price)
    {

        $buyer_currency = User::where('id', Auth::user()->id)->first();

        $exchange_user = ExchangeRate::where('rates', $currecny)->first();
        $price_user = $price / $exchange_user->money;

        $exchange = ExchangeRate::where('rates', $buyer_currency->currency)->first();
        $total_price = $price_user * $exchange->money;
        return $total_price;
    }


    public function checkout(Request $request)
    {
        $form_name = $request->form_name;

        if (Auth::user() == '') {
            return redirect()->route('login');
        } else {

            $affilate = $request->affiliate_id;
            if ($form_name == 'social_media') {
                // $all_ready_exits = SocialMedia::where('id', $request->product_id)->where('status',2)->get();
                $data = SocialMedia::where('id', $request->product_id)->where('status', 1)->first();
                if (empty($data)) {
                } else {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->price);
                }
            } elseif ($form_name == 'make_payment') {
                $data = MakePayment::where('id', $request->product_id)->where('status', 1)->first();
                if (empty($data)) {
                } else {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->get_currency, $data->unit_price);
                    $price = round($price, 2);
                }
            } elseif ($form_name == 'influence_marketing') {

                $data = InfluenceMarketing::where('id', $request->product_id)->where('status', 1)->first();
                if (empty($data)) {
                } else {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->price);
                }
            } elseif ($form_name == 'gift_card') {

                $data = GiftCard::where('id', $request->product_id)->where('status', 1)->first();
                if (!empty($data)) {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->price);
                }
            } elseif ($form_name == 'subscription') {

                $data = Subscription::where('id', $request->product_id)->where('status', 1)->first();
                if (!empty($data)) {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->price);
                }
            } elseif ($form_name == 'advertisement_account') {

                $data = AdvertisementAccount::where('id', $request->product_id)->where('status', 1)->first();
                if (!empty($data)) {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->price);
                }
            } elseif ($form_name == 'digital_wallet') {

                $data = DigitalWallet::where('id', $request->product_id)->where('status', 1)->first();
                if (!empty($data)) {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->price);
                }
            } elseif ($form_name == 'social_media_promotion') {

                $data = SocialMediaPromotion::where('id', $request->product_id)->where('status', 1)->first();
                if (!empty($data)) {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->unit_price);
                }
            } elseif ($form_name == 'games_zone') {

                $data = GamesZone::where('id', $request->product_id)->where('status', 1)->first();
                if (!empty($data)) {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->unit_price);
                }
            } elseif ($form_name == 'top_up_apps') {

                $data = TopUpApps::where('id', $request->product_id)->where('status', 1)->first();
                if (!empty($data)) {
                    $qty = $request->qty;
                    $price = $qty * $this->checkout_price($data->user_info->currency, $data->unit_price);
                }
            }
            if (empty($data)) {

                return redirect()->route('home');
            } else {

                return view('frontend.home.page.payment', compact('data', 'qty', 'price', 'form_name', 'affilate'));
            }
        }
    }

    protected function price_convert($price, $product_id, $form_name, $qty, $seller_id)
    {


        if ($form_name == 'make_payment') {

            $user_product = MakePayment::where('id', $product_id)->where('post_id', $seller_id)->first();

            if ($user_product->send_amount >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->unit_price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } elseif ($form_name == 'gift_card') {
            $user_product = GiftCard::where('id', $product_id)->where('post_id', $seller_id)->first();
            if ($user_product->qty >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } elseif ($form_name == 'subscription') {
            $user_product = Subscription::where('id', $product_id)->where('post_id', $seller_id)->first();
            if ($user_product->qty >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else if ($form_name == 'social_media') {
            $user_product = SocialMedia::where('id', $product_id)->where('post_id', $seller_id)->first();
            if (1 >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else if ($form_name == 'influence_marketing') {
            $user_product = InfluenceMarketing::where('id', $product_id)->where('post_id', $seller_id)->first();
            if (1 >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else if ($form_name == 'digital_wallet') {
            $user_product = DigitalWallet::where('id', $product_id)->where('post_id', $seller_id)->first();
            if (1 >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else if ($form_name == 'advertisement_account') {
            $user_product = AdvertisementAccount::where('id', $product_id)->where('post_id', $seller_id)->first();
            if (1 >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else if ($form_name == 'social_media_promotion') {
            $user_product = SocialMediaPromotion::where('id', $product_id)->where('post_id', $seller_id)->first();
            if (1 >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->unit_price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else if ($form_name == 'top_up_apps') {
            $user_product = TopUpApps::where('id', $product_id)->where('post_id', $seller_id)->first();
            if (1 >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->unit_price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else if ($form_name == 'games_zone') {
            $user_product = GamesZone::where('id', $product_id)->where('post_id', $seller_id)->first();
            if (1 >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $seller_currency->currency)->first();
                $price_user = $user_product->unit_price / $exchange_user->money;
                $exchange = ExchangeRate::where('rates', 'BDT')->first();
                $total_price = $price_user * $exchange->money;
                $total_price = $total_price * $qty;
            } else {
                $total_price = 'false';
            }
        } else {
            $total_price = 'false';
        }

        return  $total_price;
    }

    public function paymentcomplete(Request $request)
    {

        $prc = $this->price_convert($request->price, $request->product_id, $request->form_name, $request->qty, $request->seller_id);

        $price =  round($prc, 2);
        $shurjopay_service = new ShurjopayService();
        $tx_id = $shurjopay_service->generateTxId($request->product_id);
        // $success_route = 'paymentissue' . ',' . $tx_id;
        // $success_route =   route('paymentissue', $tx_id);
        // $p =  $shurjopay_service->sendPayment($price, $success_route);

        $shurjopay_service->sendPayment($price);

        $trans_order = new TransanctionHistory();
        $trans_order->buyer_id = Auth::user()->id;
        $trans_order->tx_id = $tx_id;
        $trans_order->seller_id = $request->seller_id;
        $trans_order->product_id = $request->product_id;
        $trans_order->affiliate_id = $request->affiliate_id ? $request->affiliate_id : 'NULL';
        $trans_order->product_name = $request->product_name;
        $trans_order->form_name = $request->form_name;
        $trans_order->quantity = $request->qty;
        $trans_order->price = $price;
        $trans_order->transaction_status = 'init';
        $trans_order->save();
    }

    public function login()
    {
        return view('auth.login');
    }

    public function  loginpopup(Request $request)
    {
        $errors = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($errors)) {
            return back()->with('errors', 'Email or password invalied');
        } else {
            return back();
        }
    }



    public function checkoutsave(Request $request)
    {

        $insert_checkout = new Checkout();
        $insert_checkout->user_name = $request->user_name;
        $insert_checkout->email = $request->email;
        $insert_checkout->phone = $request->phone;
        $insert_checkout->account_name = $request->account_name;
        $insert_checkout->account_no = $request->account_no;
        $insert_checkout->save();
        $name = $request->user_name;
        $phone = $request->phone;
        $email = $request->email;
        return view('frontend.home.page.payment', compact('email', 'name', 'phone'));
    }
    public function product()
    {

        return view('frontend.home.page.product');
    }



    public function refer($refer_id)
    {

        $data = User::where('id', $refer_id)->first();

        if (!empty($data)) {
            $refer_id = $data->id;
        } else {

            $refer_id = null;
        }

        return view('auth.register', compact('refer_id'));
    }

    public function search_product(Request $request)
    {
        $mk = MakePayment::Select(['id', 'send_amount', 'created_at'])
            ->where('status', 1)
            ->where('send_wallet', 'like', "%{$request->key}%")
            ->orWhere('send_currency', 'like', "%{$request->key}%")
            ->latest();

        $in =  InfluenceMarketing::Select(['id', 'social_name', 'created_at'])
            ->where('social_name', 'like', "%{$request->key}%")
            ->orWhere('social_type', 'like', "%{$request->key}%")
            ->where('status', 1)->latest();
        $gf =  GiftCard::Select(['id', 'name', 'created_at'])
            ->where('name', 'like', "%{$request->key}%")
            ->where('status', 1)->latest();

        $sbs =  Subscription::Select(['id', 'name', 'created_at'])
            ->where('name', 'like', "%{$request->key}%")
            ->where('status', 1)->latest();

        $data = SocialMedia::Select(['id', 'social_name as name', 'created_at'])
            ->where('status', 1)
            ->where('social_name', 'like', "%{$request->key}%")
            ->union($in)
            ->union($mk)
            ->union($gf)
            ->union($sbs)
            ->orderByDesc('created_at')
            ->paginate(48);

        if (count($data) > 0) {
            return view('frontend.home.page.search_product', ['data' => $data]);
        } else {
        }
    }
    public function terms_conditions()
    {

        return view('frontend.home.page.terms_conditions');
    }

    public function privacy_policy()
    {
        return view('frontend.home.page.privacy_policy');
    }

    public function invalid()
    {
        return view('frontend.home.page.invalid_page');
    }


    public function data(Request $r)
    {
        return $r->course_id;
    }
}