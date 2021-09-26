<?php

namespace App\Http\Controllers;

use App\AdvertisementAccount;
use App\Category;
use App\DigitalWallet;
use App\ExchangeRate;
use App\GamesZone;
use App\GiftCard;
use App\InfluenceMarketing;
use App\MakePayment;
use App\SellOrder;
use App\SocialMedia;
use App\SocialMediaPromotion;
use Illuminate\Http\Request;
use DB;
use App\Subcategory;
use App\Subscription;
use App\TopUpApps;
use App\User;
use App\WishList;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoadAjaxController extends Controller
{



	protected function calculate_currency($form_name, $product_id, $price)
	{

		$price = $price;
		$product_id = $product_id;

		if (Auth::user() == '') {
			$cahe =   Cache::get('data_currency');
			if ($cahe == null) {


				$p = $this->getUserIP();

				$data =   Http::get('https://ipapi.co/' .  '103.139.19.22' . '/json/')->json();
				$cahe =   Cache::put('data_currency',   $data);
				$currency_api = Cache::get('data_currency');

				$user = User::select('currency')->where('id', $product_id)->first();
				$currecny_user = $user->currency;

				$exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
				$price_user = $price / $exchange_user->money;

				$exchange = ExchangeRate::where('rates', $currency_api['currency'])->first();
				$prc = $price_user * $exchange->money;
				$price_product =  round($prc, 2) . ' ' . $exchange->rates;
			} else {

				$currency_api = Cache::get('data_currency');

				$user = User::select('currency')->where('id', $product_id)->first();

				$currecny_user = $user->currency;

				$exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
				$price_user = $price / $exchange_user->money;

				$exchange = ExchangeRate::where('rates', $currency_api['currency'])->first();
				$prc = $price_user * $exchange->money;
				$price_product =  round($prc, 2) . ' ' . $exchange->rates;
			}
		} else {

			$user = User::select('currency')->where('id', $product_id)->first();
			$currecny_user = $user->currency;

			$exchange_user = ExchangeRate::where('rates', $currecny_user)->first();
			$price_user = $price / $exchange_user->money;


			$social = User::select('currency')->where('id', Auth::user()->id)->first();
			$currecny = $social->currency;
			$exchange = ExchangeRate::where('rates', $currecny)->first();
			$prc = $price_user * $exchange->money;

			$price_product =  round($prc, 2) . ' ' .     $exchange->rates;
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



	function load_data(Request $request)
	{


		if ($request->ajax()) {
			if ($request->id > 0) {

				$i = $request->id;

				$sub = SocialMedia::where('status', 1)->get();

				$sy = [];
				foreach ($sub as $value) {
					$sy[] = array(
						'id' => $value->id,
						'post_id' => $value->post_id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->social_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}
				$make = MakePayment::where('status', 1)->get();

				$make_payment = [];
				foreach ($make as $value) {
					$make_payment[] = array(
						'id' => $value->id,
						'post_id' => $value->post_id,
						'price' => $value->unit_price . ' ' . $value->user_info->currency,
						'name' => $value->send_wallet,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$inf = InfluenceMarketing::where('status', 1)->get();
				$influence = [];
				foreach ($inf as $value) {
					$influence[] = array(
						'id' => $value->id,
						'post_id' => $value->post_id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->social_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$gift = GiftCard::where('status', 1)->orderByDesc('id')->take(6)->get();

				$giftcard = [];
				foreach ($gift as $value) {
					$giftcard[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$subs = Subscription::where('status', 1)->orderByDesc('id')->take(6)->get();

				$subscription = [];
				foreach ($subs as $value) {
					$subscription[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,

					);
				}
				$digital = DigitalWallet::where('status', 1)->orderByDesc('id')->take(6)->get();

				$digital_wallet = [];
				foreach ($digital as $value) {
					$digital_wallet[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->account_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$advertisment = AdvertisementAccount::where('status', 1)->orderByDesc('id')->take(6)->get();

				$advertisment_account = [];
				foreach ($advertisment as $value) {
					$advertisment_account[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->account_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,

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
						'subcategory_name' => $value->subcategory_info->name,
						'image' => $value->subcategory_info->image,
						'created_at' => $value->created_at,
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
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,

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
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				// $data = array([$influence, $make_payment, $sy]);
				$dataa = array_merge($make_payment, $sy, $influence, $giftcard, $subscription, $digital_wallet, $advertisment_account, $promotion, $topupapps, $gamezone);

				$collection = collect($dataa)->sortByDesc('created_at')->skip($i)->take(24);

				$collect = collect($dataa)->count();
			} else {
				$sub = SocialMedia::where('status', 1)->get();

				$sy = [];
				foreach ($sub as $value) {
					$sy[] = array(
						'id' => $value->id,
						'post_id' => $value->post_id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->social_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}
				$make = MakePayment::where('status', 1)->get();

				$make_payment = [];
				foreach ($make as $value) {
					$make_payment[] = array(
						'id' => $value->id,
						'post_id' => $value->post_id,
						'price' => $value->unit_price . ' ' . $value->user_info->currency,
						'name' => $value->send_wallet,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$inf = InfluenceMarketing::where('status', 1)->get();
				$influence = [];
				foreach ($inf as $value) {
					$influence[] = array(
						'id' => $value->id,
						'post_id' => $value->post_id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->social_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$gift = GiftCard::where('status', 1)->orderByDesc('id')->take(6)->get();

				$giftcard = [];
				foreach ($gift as $value) {
					$giftcard[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$subs = Subscription::where('status', 1)->orderByDesc('id')->take(6)->get();

				$subscription = [];
				foreach ($subs as $value) {
					$subscription[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,

					);
				}
				$digital = DigitalWallet::where('status', 1)->orderByDesc('id')->take(6)->get();

				$digital_wallet = [];
				foreach ($digital as $value) {
					$digital_wallet[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->account_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				$advertisment = AdvertisementAccount::where('status', 1)->orderByDesc('id')->take(6)->get();

				$advertisment_account = [];
				foreach ($advertisment as $value) {
					$advertisment_account[] = array(
						'id' => $value->id,
						'price' => $this->calculate_currency($value->category_info->form_name, $value->post_id, $value->price),
						'name' => $value->account_name,
						'form_name' => $value->category_info->form_name,
						'user_name' => $value->user_info->name,
						'flag' => $value->user_info->flag,
						'image' => $value->subcategory_info->image,
						'post_id' => $value->post_id,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,

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
						'subcategory_name' => $value->subcategory_info->name,
						'image' => $value->subcategory_info->image,
						'created_at' => $value->created_at,
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
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,

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
						'image' => $value->subcategory_info->image,
						'subcategory_name' => $value->subcategory_info->name,
						'created_at' => $value->created_at,
					);
				}

				// $data = array([$influence, $make_payment, $sy]);
				$dataa = array_merge($make_payment, $sy, $influence, $giftcard, $subscription, $digital_wallet, $advertisment_account, $promotion, $topupapps, $gamezone);

				$collection = collect($dataa)->sortByDesc('created_at')->take(24);

				$collect = collect($dataa)->count();


				$i = 0;
			}
			$output = '';
			$last_id = '';


			if (!$collection->isEmpty()) {


				foreach ($collection  as $v_item) {

					// $subcategory_image = Subcategory::where('id', $v_item->subcategory_id)->first();

					$output .= '
                
                
                <div class="col-xl-33 col-lg-2 col-md-4 col-sm-6 col-6 " style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
				<div class="ps-product height_335 ps_product_hover">
                <div class="ps-product__thumbnail height"><a href="' . route('addcart', [$v_item['id'], $v_item['form_name']]) . '">
				<img  src="' . asset('back_end/subcategory_images') . '/' . $v_item['image'] . '" alt="picture"></a>
			
				
				</div>
				<div class="ps-product__container">
				<img style="height: 18px;float: right;width: 31px;" src="' . asset('flags') . '/' . $v_item['flag'] . '.png">
				<p class="ps-product__price" style="font-size:13px"><b> ' . $v_item['subcategory_name'] . '</b></p>
				<div class="">
				<a class="ps-product__title" href="' . route('addcart', [$v_item['id'], $v_item['form_name']]) . '">' .

						((strlen($v_item['form_name']) >= 42) ? substr($v_item['name'], 0, 42) . '...'	: $v_item['name'])

						. '</a>
				<div class="ps-product__rating">
				</div>
				<p class="ps-product__price sale">' . $v_item['price'] . '</p>
				
				</div>
				<br/>
				
				

				</div>
				</div>
                </div>
                ';
					$last_id = $v_item['id'];
					$i = $i + 1;
				}

				$load =
					'
                <div class="row" id="load_more">
                    <button type="button" name="load_more_button" style="background:#f26437; width: 141px;margin: auto; margin-top: 17px;" 
                    class="btn btn-success form-control" data-id="' . $i . '" 
                    id="load_more_button">Load More</button>
                </div>
             
                ';
			}
		} else {
			$load = '';
			$load .= '
            
                <div id="load_more" style="background:red">
                    <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                </div>
            
            ';
		}



		$data = array(
			'item'  => $output,
			'load'  => $load,
			'currency' => $collect,

		);

		echo json_encode($data);
	}


	public function searchsuggetion(Request $request)
	{

		$key = $request->key;

		$ct = Category::Select(['id', 'name', 'created_at'])->where('status', 1)->where('name', 'like', "%{$key}%")->latest();
		$st = Subcategory::Select(['id', 'name', 'created_at'])->where('status', 1)->where('name', 'like', "%{$key}%")->latest();

		$mk = MakePayment::Select(['id', 'send_amount', 'created_at'])
			->with([
				'category_info' => function ($query) {
					$query->select('id', 'form_name');
				},
				'subcategory_info' => function ($query) {
					$query->select('id', 'image');
				}
			])
			->where('status', 1)
			->where('send_wallet', 'like', "%{$key}%")
			->orWhere('send_currency', 'like', "%{$key}%")
			->latest();

		$in =  InfluenceMarketing::Select(['id', 'social_name', 'created_at'])
			->with([
				'category_info' => function ($query) {
					$query->select('id', 'form_name');
				},
				'subcategory_info' => function ($query) {
					$query->select('id', 'image');
				}
			])
			->where('social_name', 'like', "%{$key}%")
			->orWhere('social_type', 'like', "%{$key}%")
			->where('status', 1)->latest();
		$gf =  GiftCard::Select(['id', 'name', 'created_at'])
			->with([
				'category_info' => function ($query) {
					$query->select('id', 'form_name');
				},
				'subcategory_info' => function ($query) {
					$query->select('id', 'image');
				}
			])
			->where('name', 'like', "%{$key}%")

			->where('status', 1)->latest();

		$sbs =  Subscription::Select(['id', 'name', 'created_at'])
			->with([
				'category_info' => function ($query) {
					$query->select('id', 'form_name');
				},
				'subcategory_info' => function ($query) {
					$query->select('id', 'image');
				}
			])
			->where('name', 'like', "%{$key}%")

			->where('status', 1)->latest();


		$data = SocialMedia::Select(['id', 'social_name as name', 'created_at'])
			->with([
				'category_info' => function ($query) {
					$query->select('id', 'form_name');
				},
				'subcategory_info' => function ($query) {
					$query->select('id', 'image');
				}
			])

			->where('status', 1)
			->where('social_name', 'like', "%{$key}%")
			->union($in)
			->union($mk)
			->union($ct)
			->union($st)
			->union($gf)
			->union($sbs)
			->orderByDesc('created_at')
			->get();



		if ($request->key) {

			$suggetiontext = '';
			foreach ($data->take(15) as $item) {

				$suggetiontext .= '<li style="color:rgb(0, 0, 0);padding-left: 18px;"><a href="#"><b style="font-size:18px">  ' . $item->name . ' </b> </a> </li>';
			}

			$data = array(
				'key'  => $suggetiontext,
				'message'  => 'true'
			);

			echo json_encode($data);
		} else {

			$data = array(
				'key'  => 'No data ',
				'message'  => 'false'
			);
			echo json_encode($data);
		}

		// $suggetiontext = '<li>' . $request->keyword . ' </li>';

	}
	public function wishlist(Request $request)
	{
		if (Auth::user() == '') {
			$data = array(
				'success' => false,
				'message' => 'login',
				'form_name' => $request->form_name . $request->product_id,
			);
		} else {
			$wishlist = WishList::where('product_id', $request->product_id)->where('form_name', $request->form_name)->get();

			if ($wishlist == '[]' || $wishlist == null) {

				$info = new WishList();
				$info->product_id = $request->product_id;
				$info->form_name = $request->form_name;
				$info->user_id = $request->user_id;

				if ($info->save()) {
					$data = array(
						'success' => true,
						'data' => 	$info,
						'message' => 'saved',
						'form_name' => $request->form_name . $request->product_id,
					);
				} else {
					$data = array(
						'success' => false,
						'data' => 	$info,
						'message' => 'error ',
						'form_name' => $request->form_name . $request->product_id,
					);
				}
			} else {
				$data = array(
					'success' => false,
					'message' => 'already add',
					'form_name' => $request->form_name . $request->product_id,
				);
			}
		}
		echo json_encode($data);
	}

	public function totalwish()
	{

		if (Auth::user() == '') {
			$total = '';
		} else {
			$total = WishList::where('user_id', Auth::user()->id)->get();
			$total = $total->count();
		}
		$data = array(
			'success' => true,
			'total' => $total
		);
		echo json_encode($data);
	}

	protected function price_convert($price, $form_name)
	{

		$exchange_user = ExchangeRate::where('rates', 'BDT')->first();
		$price_user = $price / $exchange_user->money;
		$exchange = ExchangeRate::where('rates', Auth::user()->currency)->first();
		$total_price = $price_user * $exchange->money;
		$commission_set = Category::select('id', 'company_commission', 'refer_commission', 'affilate_commission')->where('form_name', $form_name)->first();
		$total_percentage = $commission_set->company_commission + $commission_set->refer_commission + $commission_set->affilate_commission;
		$total_pr = ($total_price * $total_percentage) / 100;
		$total_price = $total_price - $total_pr;

		return $total_price;
	}

	public function total_balance()
	{


		$sell_item = SellOrder::where('seller_id', Auth::user()->id)->where('status', '!=', 2)->get();

		$sell_order = [];
		foreach ($sell_item as $item) {
			$sell_order[] = array(

				'price' => $this->price_convert($item->price, $item->form_name),

			);
		}

		$sum_price = collect($sell_order)->sum('price');

		if (count($sell_item) > 0) {
			$message = 'true';
			$total_balance = $sum_price;
			$pending_balance = '' . round($total_balance, 2) . '
				<b style="color:red;font-size: 11px;">' . Auth::user()->currency . '</b><sup style="color:black">pending</sup>';
		} else {
			$message = 'false';
			$pending_balance = 0 . '<b style="color:red;font-size: 11px;"> ' . Auth::user()->currency . '</b>';
		}

		$total_price = '' .  round(Auth::user()->balance, 2) . '
			 <b style="color:red;font-size: 13px;">' . Auth::user()->currency . '</b>';





		$data = array(
			'message' => $message,
			'total' => $total_price,
			'pending' => $pending_balance
		);

		echo json_encode($data);
	}
}