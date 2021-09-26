<?php

namespace App\Http\Controllers;

use App\AdvertisementAccount;
use Illuminate\Http\Request;
use App\Category;
use App\Commission;
use App\DigitalWallet;
use App\ExchangeRate;
use App\GamesZone;
use App\GiftCard;
use App\User;
use App\InfluenceMarketing;
use App\MakePayment;
use App\Order;
use App\RejectMessage;
use App\SellOrder;
use App\SocialMedia;
use App\SocialMediaPromotion;
use App\Subcategory;
use App\Subscription;
use App\TopUpApps;
use App\TutorialVideo;
use App\WithdrawMoney;
use Image;
use Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function index()
    {
        $id = Auth::user()->id;
        $make_payment = SocialMedia::where('post_id', $id)->where('status', 1)->count();
        $social_media = MakePayment::where('post_id', $id)->where('status', 1)->count();
        $influence = InfluenceMarketing::where('post_id', $id)->where('status', 1)->count();



        $order = SellOrder::where('seller_id', $id)->get();

        $sell_item = SellOrder::where('seller_id', Auth::user()->id)->where('status', 0)->latest()->take(6)->get();
        $sell_order = [];
        foreach ($sell_item as $item) {
            $sell_order[] = array(
                'id' => $item->id,
                'product_name' => $item->product_name,
                'category' => $item->category_info->name,
                'user_name' => $item->user_info->name,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'price' => round($this->price_convert($item->price, $item->form_name, 'seller'), 2) . ' ' . Auth::user()->currency,
                'form_name' => $item->form_name,
                'product_id' => $item->product_id,
                'buyer_id' => $item->buyer_id,
                'order_id' => $item->id,
            );
        }



        $total_product = $make_payment +  $social_media +  $influence;

        if ($total_product == 0) {
            $order_percentage = 0;
            $compelete_order_percentage = 0;
            $report_order_percentage = 0;
        } else {
            $order_percentage = ($order->where('status', 0)->count() * 100) / $total_product;

            $order_percentage =  round(0, $order_percentage, 2);

            $compelete_order_percentage = round(0, ($order->where('status', 2)->count() * 100) / $total_product, 2);
            $report_order_percentage = round(0, ($order->where('status', 3)->count() * 100) / $total_product, 2);
        }

        return view('customer.pages.home', compact(

            'order',
            'total_product',
            'order_percentage',
            'compelete_order_percentage',
            'report_order_percentage',
            'sell_order'
        ));
    }

    public function myprofile()
    {
        return view('customer.pages.myprofile');
    }
    public function profile_update(Request $request)
    {
        $user_info = User::where('id', $request->user_id)->first();

        $user_info->update($request->all());

        return back();
    }





    public function product($form_name)
    {
        $category = Category::where('status', 1)->get();
        $social_media = SocialMedia::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $make_payment = MakePayment::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $subscription = Subscription::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $giftcard = GiftCard::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $influence = InfluenceMarketing::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $digital_wallet = DigitalWallet::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $advertisement = AdvertisementAccount::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $promotion = SocialMediaPromotion::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $topup = TopUpApps::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $game = GamesZone::where('post_id', Auth::user()->id)->latest()->paginate(13);
        $form_code = $form_name;



        return view('customer.pages.product', compact(
            'category',
            'social_media',
            'make_payment',
            'form_code',
            'subscription',
            'giftcard',
            'influence',
            'digital_wallet',
            'advertisement',
            'promotion',
            'topup',
            'game'
        ));
    }


    public function addproduct(Request $request)
    {
        $subcategory = Subcategory::where('id', $request->subcategory_id)->where('category_id', $request->category_id)->where('status', 1)->first();
        $currency_list = ExchangeRate::select(['rates'])->get();
        return view('customer.pages.add_product', compact('subcategory', 'currency_list'));
    }

    public function getsubcategory(Request $request)
    {
        $subcategory = Subcategory::where("category_id", $request->category_id)->where('status', 1)
            ->pluck("name", "id");

        return response()->json($subcategory);
    }

    //----------------------------------------------------------------------------social media------------------------------------------------------------

    public function savesocialmedia(Request $request)
    {

        // $p =   Validator::make($request->all(), [
        //     'category_id' => 'required',
        //     'subcategory_id' => 'required',
        //     'social_link' => 'unique:social_media,social_link',
        // ]);


        $social_media_save = new SocialMedia();
        $social_media_save->post_id = Auth::user()->id;
        $social_media_save->category_id = $request->category_id;
        $social_media_save->subcategory_id = $request->subcategory_id;
        $social_media_save->social_name = $request->social_name;
        $social_media_save->social_link = $request->social_link;
        $social_media_save->friends = $request->friends;
        $social_media_save->followers = $request->followers;

        $social_media_save->price = $request->price;
        $social_media_save->description = $request->description;
        $social_media_save->status = 0;



        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 500)->save(public_path('back_end/social_images/' . $filename));
            $social_media_save->image = $filename;
        }

        $social_media_save->save();
        return view('customer.pages.save_product');
    }
    public function socialdelete($id)
    {
        $data =   SocialMedia::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }



    //----------------------------------------------------------------------------social media------------------------------------------------------------
    //----------------------------------------------------------------------------make money--------------------------------------------------------------
    public function savemakepayment(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $make_money_save = new MakePayment();
        $make_money_save->post_id = Auth::user()->id;
        $make_money_save->category_id = $request->category_id;
        $make_money_save->subcategory_id = $request->subcategory_id;
        $make_money_save->send_currency = $request->send_currency;
        $make_money_save->send_amount = $request->send_amount;
        $make_money_save->send_wallet = $request->send_wallet;
        $make_money_save->send_account = $request->send_account;
        $make_money_save->get_currency = $request->get_currency;
        $make_money_save->get_amount = $request->get_amount;
        $make_money_save->get_wallet = $request->get_wallet;
        $make_money_save->get_account = $request->get_account;

        $make_money_save->unit_price = $request->unit_price;

        $make_money_save->description = $request->description;
        $make_money_save->save();
        return view('customer.pages.save_product');
    }


    public function makepaymentdelete($id)
    {
        $data =   MakePayment::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }

    //----------------------------------------------------------------------------make money--------------------------------------------------------------
    //---------------------------------------------------------------------------influence  Marketing -------------------------------------------------------------
    public function saveinfluence(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $influence_save = new InfluenceMarketing();
        $influence_save->post_id = Auth::user()->id;
        $influence_save->category_id = $request->category_id;
        $influence_save->subcategory_id = $request->subcategory_id;

        $influence_save->social_name = $request->social_name;
        $influence_save->social_link = $request->social_link;
        $influence_save->hiring_time = $request->hiring_time;
        $influence_save->last_engagement = $request->last_engagement;
        $influence_save->social_type = $request->social_type;
        $influence_save->country = $request->country;
        $influence_save->price = $request->price;
        $influence_save->description = $request->description;
        $influence_save->status = $request->status;
        $influence_save->save();
        return view('customer.pages.save_product');
    }


    public function influencedelete($id)
    {
        $data =   InfluenceMarketing::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }


    public function savegiftcard(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $giftcard_save = new GiftCard();
        $giftcard_save->post_id = Auth::user()->id;
        $giftcard_save->category_id = $request->category_id;
        $giftcard_save->subcategory_id = $request->subcategory_id;

        $giftcard_save->name = $request->name;
        $giftcard_save->qty = $request->qty;


        $giftcard_save->price = $request->price;
        $giftcard_save->description = $request->description;
        $giftcard_save->status = $request->status;
        $giftcard_save->save();
        return view('customer.pages.save_product');
    }

    public function giftcarddelete($id)
    {
        $data =   GiftCard::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }

    public function savesubscription(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $giftcard_save = new Subscription();
        $giftcard_save->post_id = Auth::user()->id;
        $giftcard_save->category_id = $request->category_id;
        $giftcard_save->subcategory_id = $request->subcategory_id;

        $giftcard_save->name = $request->name;
        $giftcard_save->qty = $request->qty;


        $giftcard_save->price = $request->price;
        $giftcard_save->description = $request->description;
        $giftcard_save->status = $request->status;
        $giftcard_save->save();
        return view('customer.pages.save_product');
    }


    public function subscriptiondelete($id)
    {
        $data =   Subscription::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }



    //-------------------------------------------------------digitalwallet--------------------------------------



    public function savedigitalwallet(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $info_save = new DigitalWallet();
        $info_save->post_id = Auth::user()->id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;

        $info_save->account_name = $request->account_name;
        $info_save->balance = $request->balance;
        $info_save->account_currency = $request->account_currency;
        $info_save->is_verified = $request->is_verified;
        $info_save->country = $request->country;
        $info_save->opening_year = $request->opening_year;


        $info_save->price = $request->price;
        $info_save->description = $request->description;
        $info_save->save();
        return view('customer.pages.save_product');
    }



    public function digitalwalletdelete($id)
    {
        $data =   DigitalWallet::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }

    //----------------------------------------------------------------------------saveadvertisementaccount---------------------

    public function saveadvertisementaccount(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $info_save = new AdvertisementAccount();
        $info_save->post_id = Auth::user()->id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;

        $info_save->account_name = $request->account_name;
        $info_save->balance = $request->balance;
        $info_save->account_currency = $request->account_currency;
        $info_save->is_verified = $request->is_verified;
        $info_save->country = $request->country;
        $info_save->opening_year = $request->opening_year;


        $info_save->price = $request->price;
        $info_save->description = $request->description;
        $info_save->save();
        return view('customer.pages.save_product');
    }


    public function advertisementaccountdelete($id)
    {
        $data =   AdvertisementAccount::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }


    public function savesocialmediapromotion(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $info_save = new SocialMediaPromotion();
        $info_save->post_id = Auth::user()->id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->product_name = $request->product_name;
        $info_save->follower_subscriber = $request->follower_subscriber;
        $info_save->total_follower_subscriber = $request->total_follower_subscriber;
        $info_save->unit_price = $request->unit_price;
        $info_save->description = $request->description;
        $info_save->save();
        return view('customer.pages.save_product');
    }


    public function socialmediapromotiondelete($id)
    {
        $data =   SocialMediaPromotion::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }
    public function savetopupapps(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $info_save = new TopUpApps();
        $info_save->post_id = Auth::user()->id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;

        $info_save->product_name = $request->product_name;

        $info_save->top_up = $request->top_up;
        $info_save->total_top_up = $request->total_top_up;

        $info_save->unit_price = $request->unit_price;
        $info_save->description = $request->description;
        $info_save->save();
        return view('customer.pages.save_product');
    }
    public function topupappsdelete($id)
    {
        $data =   TopUpApps::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }
    public function savegameszone(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

        ]);

        $info_save = new GamesZone();
        $info_save->post_id = Auth::user()->id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;

        $info_save->product_name = $request->product_name;

        $info_save->diamonds = $request->diamonds;
        $info_save->total_diamonds = $request->total_diamonds;

        $info_save->unit_price = $request->unit_price;
        $info_save->description = $request->description;
        $info_save->save();
        return view('customer.pages.save_product');
    }

    public function gameszonedelete($id)
    {
        $data =   GamesZone::where('post_id', Auth::user()->id)->where('id', $id)->delete();
        if ($data) {
            return back();
        } else {
            return back();
        }
    }



    protected function price_convert($price, $form_name, $type_order_person)
    {

        if ($type_order_person == 'seller') {
            $exchange_user = ExchangeRate::where('rates', 'BDT')->first();
            $price_user = $price / $exchange_user->money;
            $exchange = ExchangeRate::where('rates', Auth::user()->currency)->first();
            $total_price = $price_user * $exchange->money;
            $commission_set = Category::select('id', 'company_commission', 'refer_commission', 'affilate_commission')->where('form_name', $form_name)->first();
            $total_percentage = $commission_set->company_commission + $commission_set->refer_commission + $commission_set->affilate_commission;
            $total_pr = ($total_price * $total_percentage) / 100;
            $total_price = $total_price - $total_pr;
        } elseif ($type_order_person == 'buyer') {
            $exchange_user = ExchangeRate::where('rates', 'BDT')->first();
            $price_user = $price / $exchange_user->money;
            $exchange = ExchangeRate::where('rates', Auth::user()->currency)->first();
            $total_price = $price_user * $exchange->money;
        } else {
            $exchange_user = ExchangeRate::where('rates', 'BDT')->first();
            $price_user = $price / $exchange_user->money;
            $exchange = ExchangeRate::where('rates', Auth::user()->currency)->first();
            $total_price = $price_user * $exchange->money;
        }




        return $total_price;
    }


    public function sell_orders()
    {

        $sell_item = SellOrder::where('seller_id', Auth::user()->id)->get();
        $sell_order = [];
        foreach ($sell_item as $item) {
            $sell_order[] = array(
                'id' => $item->id,
                'product_name' => $item->product_name,
                'category' => $item->category_info->name,
                'user_name' => $item->user_info->name,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'price' => round($this->price_convert($item->price, $item->form_name, 'seller'), 2) . ' ' . Auth::user()->currency,
                'form_name' => $item->form_name,
                'product_id' => $item->product_id,
                'buyer_id' => $item->buyer_id,
                'order_id' => $item->id,
            );
        }


        return view('customer.pages.sell_orders', compact('sell_order'));
    }

    public function order_delivery(Request $request)
    {



        $form_name = $request->form_name;
        if ($form_name == 'social_media') {
            $product_info = SocialMedia::where('id', $request->product_id)->first();
        } elseif ($form_name == 'make_payment') {
            $product_info = MakePayment::where('id', $request->product_id)->first();
        } elseif ($form_name == 'influence_marketing') {
            $product_info = InfluenceMarketing::where('id', $request->product_id)->first();
        } elseif ($form_name == 'gift_card') {
            $product_info = GiftCard::where('id', $request->product_id)->first();
        } elseif ($form_name == 'subscription') {
            $product_info = Subscription::where('id', $request->product_id)->first();
        } elseif ($form_name == 'digital_wallet') {
            $product_info = DigitalWallet::where('id', $request->product_id)->first();
        } elseif ($form_name == 'advertisement_account') {
            $product_info = AdvertisementAccount::where('id', $request->product_id)->first();
        } elseif ($form_name == 'social_media_promotion') {
            $product_info = SocialMediaPromotion::where('id', $request->product_id)->first();
        } elseif ($form_name == 'top_up_apps') {
            $product_info = TopUpApps::where('id', $request->product_id)->first();
        } elseif ($form_name == 'games_zone') {
            $product_info = GamesZone::where('id', $request->product_id)->first();
        }



        $sell_order = SellOrder::where('id', $request->order_id)->first();


        $price = round($this->price_convert($sell_order->price, $sell_order->form_name, 'seller'), 2);

        $buyer_info = User::where('id', $request->buyer_id)->first();
        $order_id = $request->order_id;

        return view('customer.pages.order_delivery', compact('product_info', 'buyer_info', 'form_name', 'order_id', 'sell_order', 'price'));
    }


    public function delivery_confirm(Request $request)
    {

        $order_update = SellOrder::where('id', $request->order_id)->first();

        if ($request->hasfile('document_image')) {
            $image = $request->file('document_image');
            $filename =  $order_update->form_name . '/image1/' . $request->order_id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save(public_path('back_end/document_images/' . $filename));

            $order = $order_update->update([
                $order_update->document_image = $filename,
                $order_update->status = 1
            ]);
        }
        if ($request->hasfile('image2')) {
            $image = $request->file('image2');
            $filename =  $order_update->form_name . '/image2/' . $request->order_id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save(public_path('back_end/document_images/' . $filename));

            $order = $order_update->update([
                $order_update->image2 = $filename,

            ]);
        }
        if ($request->hasfile('image3')) {
            $image = $request->file('image3');
            $filename =  $order_update->form_name . '/image2/' . $request->order_id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save(public_path('back_end/document_images/' . $filename));
            $order = $order_update->update([
                $order_update->image3 = $filename,

            ]);
        }

        if ($order) {
            return redirect()->route('customer.sell_orders');
        } else {
            return redirect()->route('customer.sell_orders')->with('message', 'error');
        }
    }


    public function buyer_checking(Request $request)
    {


        $form_name = $request->form_name;
        $order_id = $request->order_id;

        $sell_order = SellOrder::where('id', $request->order_id)->first();


        return view('customer.pages.buyer_checking', compact('form_name', 'order_id', 'sell_order'));
    }
    protected function price_commission($price, $currency)
    {

        $exchange_user = ExchangeRate::where('rates', 'BDT')->first();
        $price_user = $price / $exchange_user->money;
        $exchange = ExchangeRate::where('rates', $currency)->first();
        $total_price = $price_user * $exchange->money;
        return $total_price;
    }

    public function buyer_comfirm(Request $request)
    {
        $check_commission = Commission::where('order_id', $request->pdo)->first();
        if ($check_commission) {
            $message = 'Already Confirm';
        } else {

            if ($request->message == 'true') {
                $message = $request->message;

                $order_update = SellOrder::where('id', $request->pdo)->first();

                if ($order_update->update(['status' => 2])) {

                    $refered_id = $order_update->seller_user_info->refered_id;
                    $form_name = $order_update->form_name;
                    $order_id = $request->pdo;
                    $price =   $order_update->price;
                    $commission_set = Category::select('id', 'company_commission', 'refer_commission', 'affilate_commission')->where('form_name', $form_name)->first();
                    $commission = new Commission();
                    $commission->order_id = $order_id;

                    if ($refered_id != null || $refered_id == 'NULL') {
                        $refer_balance_update = User::where('id', $refered_id)->first();
                        $price_re = ($price * $commission_set->refer_commission) / 100;
                        $commission->refer_id = $refered_id;
                        $commission->refer_commission = $price_re;
                        $refer_pre_balance = $refer_balance_update->balance;
                        $refer_new_balance =  $refer_pre_balance +  $this->price_commission($price_re, $refer_balance_update->currency);
                        $refer_balance_update->update([
                            'balance' => $refer_new_balance,
                        ]);
                    } else {
                        $commission->refer_id = null;
                        $commission->refer_commission = 0.00;
                    }

                    $affiliate_id = $order_update->transanction_affiliate->affiliate_id;
                    if ($affiliate_id != 'NULL') {
                        $commission->affilate_id = $affiliate_id;
                        $affiliate_balance_update = User::where('id', $affiliate_id)->first();
                        $price_aff = ($price *  $commission_set->affilate_commission) / 100;
                        $commission->affiliate_commission = $price_aff;
                        $affiliate_pre_balance = $affiliate_balance_update->balance;
                        $affiliate_new_balance =  $affiliate_pre_balance + $this->price_commission($price_re, $affiliate_balance_update->currency);
                        $affiliate_balance_update->update([
                            'balance' => $affiliate_new_balance,
                        ]);
                    } else {
                        $commission->affilate_id = null;
                        $commission->affiliate_commission = 0.00;
                    }

                    if ($request->affilate_id == null && $refered_id == null) {
                        $commission->company_commission = ($price *  $commission_set->company_commission) / 100 + ($price * $commission_set->refer_commission) / 100 + ($price *  $commission_set->affilate_commission) / 100;
                    } elseif ($request->affilate_id == null) {
                        $commission->company_commission = ($price *  $commission_set->company_commission) / 100 +  ($price *  $commission_set->affilate_commission) / 100;
                    } elseif ($refered_id == null) {
                        $commission->company_commission = ($price *  $commission_set->company_commission) / 100 + ($price * $commission_set->refer_commission) / 100;
                    } else {
                        $commission->company_commission = ($price *  $commission_set->company_commission) / 100;
                    }
                    $commission->save();

                    $pre_balance = $order_update->seller_user_info->balance;

                    $seller_update_balance =  ($price - (($price * $commission_set->refer_commission) / 100 + ($price *  $commission_set->affilate_commission) / 100 + ($price *  $commission_set->company_commission) / 100));

                    $seller_update_balance = $pre_balance + $this->price_commission($seller_update_balance, $order_update->seller_user_info->currency);



                    $order_update->seller_user_info->update([
                        'balance' => round($seller_update_balance, 2),
                    ]);
                }
            } else {
                $message = $request->message;
                $order_update = SellOrder::where('id', $request->pdo)->first();
                $order_update->update(['status' => 3]);
            }
        }

        return view('customer.pages.order_complete', compact('message'));
    }



    public function buy_orders()
    {

        $buy_item = SellOrder::where('buyer_id', Auth::user()->id)->get();
        $buy_order = [];
        foreach ($buy_item as $item) {
            $buy_order[] = array(
                'id' => $item->id,
                'product_name' => $item->product_name,
                'category' => $item->category_info->name,
                'user_name' => $item->seller_user_info->name,
                'quantity' => $item->quantity,
                'status' => $item->status,
                'price' => round($this->price_convert($item->price, $item->form_name, 'buyer'), 2) . ' ' . Auth::user()->currency,
                'form_name' => $item->form_name,
                'product_id' => $item->product_id,
                'buyer_id' => $item->buyer_id,
                'order_id' => $item->id,
            );
        }



        return view('customer.pages.buy_orders', compact('buy_order'));
    }

    protected function refer_commission($id)
    {
        $sell_order = SellOrder::where('seller_id', $id)->get();
        $price = 0;
        foreach ($sell_order as $item) {
            $amount = $item->commission_info->sum('refer_commission');
            $price = $price + $amount;
        }

        $exchange_user = ExchangeRate::where('rates', 'BDT')->first();
        $price_user = $price / $exchange_user->money;
        $exchange = ExchangeRate::where('rates', Auth::user()->currency)->first();
        $total_price = $price_user * $exchange->money;
        $total_price = round($total_price, 2);
        return $total_price;
    }


    public function referral_link()
    {
        $refer_id = Auth::user()->id;
        $referral = url('/refer/' . $refer_id);
        $referral_users = User::where('refered_id', $refer_id)->get();
        $referr_data = [];
        foreach ($referral_users as $item) {
            $referr_data[] = array(
                'name' => $item->name,
                'total_sell' => $item->sell_info->count(),
                'total_buy' => $item->buy_info->count(),
                'total_commission' => $this->refer_commission($item->id),
            );
        }
        return view('customer.pages.referral_link', compact('referral', 'referr_data'));
    }



    public function balance_withdraw()
    {

        $balance = User::where('id', Auth::user()->id)->first();
        $withdraws = WithdrawMoney::where('post_id', Auth::user()->id)->latest()->paginate(15);
        return view('customer.pages.withdraw', compact('balance', 'withdraws'));
    }

    public function withdraw(Request $request)
    {

        $form_name = $request->payment_method;


        $min_amount = 500;
        $exchange_user = ExchangeRate::where('rates', 'BDT')->first();
        $price_user = $min_amount / $exchange_user->money;
        $exchange = ExchangeRate::where('rates', Auth::user()->currency)->first();
        $min_price = $price_user * $exchange->money;

        $min_price = round(1, $min_price);

        return view('customer.pages.withdraw_page', compact('form_name', 'min_price'));
    }


    public function withdraw_compelete(Request $request)
    {


        $info = new WithdrawMoney();
        $info->post_id = Auth::user()->id;
        $info->payment_method = $request->payment_method;
        $info->payment_type = $request->payment_type;
        $info->account_name = $request->account_name;
        $info->account = $request->account;
        $info->amount = $request->amount;

        if ($info->save()) {
            $balance = User::where('id', Auth::user()->id)->first();
            $balance_u = ($balance->balance - $request->amount);
            $balance->update([
                'balance' => $balance_u
            ]);
        }


        return view('customer.pages.withdrawsuccess');
    }


    public function withdraw_checking($id)
    {
        $withdraws_view = WithdrawMoney::where('id', $id)->first();

        return view('customer.pages.withdraw_checking', compact('withdraws_view'));
    }


    public function validate_product(Request $request)
    {

        $datad = SocialMedia::where('post_id', Auth::user()->id)->where('social_link', $request->social_link)->first();



        $data = array(
            'validate'  => ($datad) ? 'Already Taken Please change' : 'Valid',
            'message'  => ($datad) ?  true : false,
        );

        echo json_encode($data);
    }


    public function tutorial()
    {

        $tutorial = TutorialVideo::where('status', 1)->get();
        $youtube = TutorialVideo::where('status', 1)->first();
        $null = 'false';
        return view('customer.pages.tutorial', compact('tutorial', 'youtube', 'null'));
    }

    public function playvideo($id)
    {
        $tutorial = TutorialVideo::where('status', 1)->get();
        $youtube = TutorialVideo::where('status', 1)->where('id', $id)->first();
        $null = 'true';
        return view('customer.pages.tutorial', compact('tutorial', 'youtube', 'null'));
    }


    public function apps()
    {

        return view('customer.pages.apps');
    }


    public function customer_reject($id, $form_name)
    {


        $form_name = $form_name;
        if ($form_name == 'social_media') {
            $data = SocialMedia::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'make_payment') {
            $data = MakePayment::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'influence_marketing') {
            $data = InfluenceMarketing::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'subscription') {
            $data = Subscription::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'gift_card') {
            $data = GiftCard::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'digital_wallet') {
            $data = DigitalWallet::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'advertisement_account') {
            $data = AdvertisementAccount::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'top_up_apps') {
            $data = TopUpApps::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'games_zone') {
            $data = GamesZone::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        } elseif ($form_name == 'social_media_promotion') {
            $data = SocialMediaPromotion::where('id', $id)->first();
            $message = RejectMessage::where('product_id', $id)->where('form_name', $form_name)->get();
        }
        if ($data) {
            return view('customer.pages.reject', compact('data', 'form_name', 'message'));
        } else {
            return back();
        }
    }


    public function reject_message(Request $request)
    {
        $reject_save = new RejectMessage();
        $reject_save->post_id = $request->post_id;
        $reject_save->product_id = $request->product_id;
        $reject_save->form_name = $request->form_name;
        $reject_save->message = $request->message;
        $reject_save->send_user = "user";
        $reject_save->save();
        return back();
    }

    public function customer_update($id, $form_name)
    {

        if ($form_name == 'social_media') {
            $data = SocialMedia::where('id', $id)->first();
        } elseif ($form_name == 'make_payment') {
            $data = MakePayment::where('id', $id)->first();
        } elseif ($form_name == 'influence_marketing') {
            $data = InfluenceMarketing::where('id', $id)->first();
        } elseif ($form_name == 'subscription') {
            $data = Subscription::where('id', $id)->first();
        } elseif ($form_name == 'gift_card') {
            $data = GiftCard::where('id', $id)->first();
        } elseif ($form_name == 'digital_wallet') {
            $data = DigitalWallet::where('id', $id)->first();
        } elseif ($form_name == 'advertisement_account') {
            $data = AdvertisementAccount::where('id', $id)->first();
        } elseif ($form_name == 'top_up_apps') {
            $data = TopUpApps::where('id', $id)->first();
        } elseif ($form_name == 'games_zone') {
            $data = GamesZone::where('id', $id)->first();
        } elseif ($form_name == 'social_media_promotion') {
            $data = SocialMediaPromotion::where('id', $id)->first();
        }
        $form_name = $form_name;
        $currency_list = ExchangeRate::select(['rates'])->get();
        return view('customer.pages.update_product', compact('data', 'currency_list', 'form_name'));
    }


    public function updateproduct(Request $request)
    {
        $form_name = $request->form_name;

        $id = $request->product_id;
        if ($form_name == 'social_media') {
            $data = SocialMedia::where('id', $id)->first();
            $data->update($request->all());
            $data->update(['status' => 7]);
        } elseif ($form_name == 'make_payment') {
            $data = MakePayment::where('id', $id)->first();
            $data->update($request->all());
            // $data->update(['status' => 7]);
        } elseif ($form_name == 'influence_marketing') {
            $data = InfluenceMarketing::where('id', $id)->first();
            $data->update($request->all());
            $data->update(['status' => 7]);
        } elseif ($form_name == 'subscription') {
            $data = Subscription::where('id', $id)->first();
            $data->update($request->all());
            // $data->update(['status' => 7]);
        } elseif ($form_name == 'gift_card') {
            $data = GiftCard::where('id', $id)->first();
            $data->update($request->all());
            // $data->update(['status' => 7]);
        } elseif ($form_name == 'digital_wallet') {
            $data = DigitalWallet::where('id', $id)->first();
            $data->update($request->all());
            $data->update(['status' => 7]);
        } elseif ($form_name == 'advertisement_account') {
            $data = AdvertisementAccount::where('id', $id)->first();
            $data->update($request->all());
            $data->update(['status' => 7]);
        } elseif ($form_name == 'top_up_apps') {
            $data = TopUpApps::where('id', $id)->first();
            $data->update($request->all());
            // $data->update(['status' => 7]);
        } elseif ($form_name == 'games_zone') {
            $data = GamesZone::where('id', $id)->first();
            $data->update($request->all());
            // $data->update(['status' => 7]);
        } elseif ($form_name == 'social_media_promotion') {
            $data = SocialMediaPromotion::where('id', $id)->first();
            $data->update($request->all());
            // $data->update(['status' => 7]);
        }
        return redirect()->route('customer.product', $form_name);
    }
}