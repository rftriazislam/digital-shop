<?php

namespace App\Http\Controllers\Api;

use App\AdvertisementAccount;
use App\DigitalWallet;
use App\GamesZone;
use App\GiftCard;
use App\Http\Controllers\Controller;
use App\InfluenceMarketing;
use App\MakePayment;
use App\SellOrder;
use App\SocialMedia;
use App\SocialMediaPromotion;
use App\Subscription;
use App\TopUpApps;
use App\WishList;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    public  function socialproductadd(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'social_name' => 'required',
            'social_link' => 'required',
            'friends' => 'required',
            'followers' => 'required',
            // 'image' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $social_media_save = new SocialMedia();
        $social_media_save->post_id = $request->post_id;
        $social_media_save->category_id = $request->category_id;
        $social_media_save->subcategory_id = $request->subcategory_id;
        $social_media_save->social_name = $request->social_name;
        $social_media_save->social_link = $request->social_link;
        $social_media_save->friends = $request->friends;
        $social_media_save->followers = $request->followers;

        $social_media_save->price = $request->price;
        $social_media_save->description = $request->description;



        // if ($request->hasfile('image')) {
        //     $image = $request->file('image');
        //     $filename = time() . '.' . $image->getClientOriginalExtension();
        //     Image::make($image)->resize(1000, 600)->save(public_path('back_end/social_images/' . $filename));
        //     $social_media_save->image = $filename;
        // }

        if ($social_media_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }
    public  function makepaymentadd(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'send_currency' => 'required',
            'send_amount' => 'required',
            'send_wallet' => 'required',
            'send_account' => 'required',
            'get_currency' => 'required',
            'get_amount' => 'required',
            'get_wallet' => 'required',
            'get_account' => 'required',
            'unit_price' => 'required',
            'description' => 'required',
        ]);
        $make_money_save = new MakePayment();
        $make_money_save->post_id = $request->post_id;
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



        if ($make_money_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }

    public  function influencemarketing(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'social_name' => 'required',
            'social_link' => 'required',
            'hiring_time' => 'required',
            'last_engagement' => 'required',
            'social_type' => 'required',
            'country' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $influence_save = new InfluenceMarketing();
        $influence_save->post_id = $request->post_id;
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



        if ($influence_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }



    public function giftcard(Request $request)
    {

        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'name' => 'required',
            'qty' => 'required',

            'price' => 'required',
            'description' => 'required',
        ]);
        $info_save = new GiftCard();
        $info_save->post_id = $request->post_id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->name = $request->name;
        $info_save->qty = $request->qty;
        $info_save->price = $request->price;
        $info_save->description = $request->description;



        if ($info_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }



    public function subscription(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'name' => 'required',
            'qty' => 'required',

            'price' => 'required',
            'description' => 'required',
        ]);
        $info_save = new Subscription();
        $info_save->post_id = $request->post_id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->name = $request->name;
        $info_save->qty = $request->qty;
        $info_save->price = $request->price;
        $info_save->description = $request->description;



        if ($info_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }



    public function advertisementaccount(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'account_name' => 'required',
            'country' => 'required',
            'opening_year' => 'required',
            'is_verified' => 'required',
            'balance' => 'required',
            'account_currency' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $info_save = new AdvertisementAccount();
        $info_save->post_id = $request->post_id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->account_name = $request->account_name;
        $info_save->country = $request->country;
        $info_save->opening_year = $request->opening_year;
        $info_save->is_verified = $request->is_verified;
        $info_save->balance = $request->balance;
        $info_save->account_currency = $request->account_currency;
        $info_save->price = $request->price;
        $info_save->description = $request->description;



        if ($info_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }


    public function digital_wallet(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'account_name' => 'required',
            'country' => 'required',
            'opening_year' => 'required',
            'is_verified' => 'required',
            'account_currency' => 'required',
            'balance' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $info_save = new DigitalWallet();
        $info_save->post_id = $request->post_id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->account_name = $request->account_name;
        $info_save->country = $request->country;
        $info_save->opening_year = $request->opening_year;
        $info_save->is_verified = $request->is_verified;
        $info_save->balance = $request->balance;
        $info_save->account_currency = $request->account_currency;
        $info_save->price = $request->price;
        $info_save->description = $request->description;



        if ($info_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }



    public function social_media_promotion(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'product_name' => 'required',
            'follower_subscriber' => 'required',
            'total_follower_subscriber' => 'required',
            'unit_price' => 'required',
            'description' => 'required',
        ]);
        $info_save = new SocialMediaPromotion();
        $info_save->post_id = $request->post_id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->product_name = $request->product_name;
        $info_save->follower_subscriber = $request->follower_subscriber;
        $info_save->total_follower_subscriber = $request->total_follower_subscriber;
        $info_save->unit_price = $request->unit_price;
        $info_save->description = $request->description;



        if ($info_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }
    public function top_up(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'product_name' => 'required',
            'top_up' => 'required',
            'total_top_up' => 'required',
            'unit_price' => 'required',
            'description' => 'required',
        ]);
        $info_save = new TopUpApps();
        $info_save->post_id = $request->post_id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->product_name = $request->product_name;
        $info_save->top_up = $request->top_up;
        $info_save->total_top_up = $request->total_top_up;
        $info_save->unit_price = $request->unit_price;
        $info_save->description = $request->description;



        if ($info_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }

    public function games_zone(Request $request)
    {
        $validatedData =   $this->validate($request, [

            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'post_id' => 'required',
            'product_name' => 'required',
            'diamonds' => 'required',
            'total_diamonds' => 'required',
            'unit_price' => 'required',
            'description' => 'required',
        ]);
        $info_save = new GamesZone();
        $info_save->post_id = $request->post_id;
        $info_save->category_id = $request->category_id;
        $info_save->subcategory_id = $request->subcategory_id;
        $info_save->product_name = $request->product_name;
        $info_save->diamonds = $request->diamonds;
        $info_save->total_diamonds = $request->total_diamonds;
        $info_save->unit_price = $request->unit_price;
        $info_save->description = $request->description;



        if ($info_save->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not found'], 400);
        }
    }


    public function buy_product(Request $request)
    {

        $validatedData =   $this->validate($request, [
            'buyer_id' => 'required',
            'seller_id' => 'required',
            'product_id' => 'required',
            'form_name' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        if ($request->form_name == 'make_payment' || $request->form_name == 'Subscription' || $request->form_name == 'gift_card') {
            $all_ready_exits = '';
        } else {
            $all_ready_exits = SellOrder::where('product_id', $request->product_id)->where('form_name', $request->form_name)->get();
        }



        // \Cart::clear();

        if (!empty($all_ready_exits)) {
            return response()->json(['success' => false, 'message' => 'This product already Sold'], 200);
        } else {

            $sell_order = new SellOrder();
            $sell_order->buyer_id = $request->buyer_id;
            $sell_order->seller_id = $request->seller_id;
            $sell_order->product_id = $request->product_id;
            $sell_order->product_name = $request->product_name;
            $sell_order->form_name = $request->form_name;
            $sell_order->quantity = $request->quantity;

            $sell_order->price = ($request->price * $request->quantity) + 20;





            // $commission = Category::select('id', 'company_commission', 'refer_commission', 'affilate_commission')->where('form_name', $request->form_name)->first();



            if ($request->form_name == 'social_media') {
                $update = SocialMedia::where('id', $request->product_id)->first();
                if ($sell_order->save()) {
                    $update->update(['status' => 2]);
                } else {
                    $fails = false;
                }
            } elseif ($request->form_name == 'make_payment') {

                $update = MakePayment::where('id', $request->product_id)->first();
                $send_amount = $update->send_amount;
                $send_amount_udate = $send_amount - $request->quantity;

                if ($send_amount_udate >= 0) {


                    if ($sell_order->save()) {

                        $update->update(['send_amount' => $send_amount_udate]);
                    } else {
                        $fails = 'order not saved';
                    }
                } else {
                    $fails = 'Not enought money or qty';
                }
            } elseif ($request->form_name == 'influence_marketing') {
                $update = InfluenceMarketing::where('id', $request->product_id)->first();

                if ($sell_order->save()) {
                    $update->update(['status' => 2]);
                } else {
                    $fails = false;
                }
            } elseif ($request->form_name == 'gift_card') {
                $update = GiftCard::where('id', $request->product_id)->first();
                $qty = $update->qty;

                $qty_udate = $qty - $request->quantity;
                if ($qty_udate >= 0) {
                    if ($sell_order->save()) {
                        $update->update(['qty' => $qty_udate]);
                    } else {
                        $fails = 'order not saved';
                    }
                } else {
                    $fails = 'Not enought money or qty';
                }
            } elseif ($request->form_name == 'Subscription') {

                $update = Subscription::where('id', $request->product_id)->first();

                $qty = $update->qty;

                $qty_udate = $qty - $request->quantity;
                if ($qty_udate >= 0) {
                    if ($sell_order->save()) {
                        $update->update(['qty' => $qty_udate]);
                    } else {
                        $fails = 'order not saved';
                    }
                } else {
                    $fails = 'Not enought money or qty';
                }
            }
            if (!empty($fails)) {
                return response()->json(['success' => false, 'message' => $fails], 200);
            } else {
                return response()->json(['success' => true, 'message' => 'Success product buy'], 200);
            }
        }
    }

    public function order_comfirm_seller(Request $request)
    {

        $validatedData = $this->validate($request, [
            'order_id' => 'required',
            'document_image' => 'required',
        ]);


        $order_update = SellOrder::where('id', $request->order_id)->first();



        if (!empty($order_update)) {

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
                $filename =  $order_update->form_name . '/image3/' . $request->order_id . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(800, 600)->save(public_path('back_end/document_images/' . $filename));

                $order = $order_update->update([
                    $order_update->image3 = $filename,

                ]);
            }
            if ($order) {
                return response()->json(['success' => true,  'message' => 'Order Delivery Successsfully'], 200);
            } else {
                return response()->json(['success' => false,   'message' => 'Order Not Delivery'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalied Order id'], 400);
        }
    }
    public function order_comfirm_buyer(Request $request)
    {

        $validatedData = $this->validate($request, [
            'order_id' => 'required'
        ]);

        $order_update = SellOrder::where('id', $request->order_id)->first();

        $order = $order_update->update([
            $order_update->status = 2
        ]);
        if ($order) {
            return response()->json(['success' => true,  'message' => 'Order Successsfully get'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Delivery not compelete'], 400);
        }
    }
    public function report_order(Request $request)
    {

        $validatedData = $this->validate($request, [
            'order_id' => 'required',
            'report_description' => 'required'
        ]);

        $order_update = SellOrder::where('id', $request->order_id)->first();

        $order = $order_update->update([
            $order_update->report_description = $request->report_description,
            $order_update->status = 3
        ]);
        if ($order) {
            return response()->json(['success' => true,  'message' => 'Order Successsfully reported'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Delivery not reported'], 400);
        }
    }

    public function wishlist(Request $request)
    {

        $validatedData =   $this->validate($request, [
            'post_id' => 'required',
            'product_id' => 'required',
            'form_name' => 'required',

        ]);

        $info = new WishList();
        $info->product_id = $request->product_id;
        $info->form_name = $request->form_name;
        $info->user_id = $request->post_id;

        if ($info->save()) {
            return response()->json(['success' => true, 'message' => 'Successful add '], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not  add'], 400);
        }
    }


    public function wishlistremove(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $data = WishList::where('id', $request->id)
            ->delete();


        if ($data) {
            return response()->json(['success' => true, 'message' => 'Successful Delete'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'data not delete'], 400);
        }
    }
}