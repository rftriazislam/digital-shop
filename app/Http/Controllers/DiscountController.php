<?php

namespace App\Http\Controllers;

use App\AdvertisementAccount;
use App\Category;
use App\DigitalWallet;
use App\Discount;
use App\GamesZone;
use App\GiftCard;
use App\InfluenceMarketing;
use App\MakePayment;
use App\SocialMedia;
use App\SocialMediaPromotion;
use App\Subscription;
use App\TopUpApps;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function discount()
    {
        $data = Discount::all();



        $discount = [];
        foreach ($data as $value) {
            $discount[] = array(
                'id' => $value->id,
                'form_name' => $value->form_name,
                'product_name' => ($value->form_name == 'social_media')
                    ? $value->social_info->social_name : (($value->form_name == 'make_payment')
                        ? $value->make_info->send_wallet : (($value->form_name == 'influence_marketing')
                            ? $value->influence_info->social_name : (($value->form_name == 'gift_card')
                                ? $value->gift_info->name : (($value->form_name == 'subscription')
                                    ? $value->subscription_info->name : (($value->form_name == 'digital_wallet')
                                        ? $value->digital_info->account_name : (($value->form_name == 'advertisement_account')
                                            ? $value->advertisement_info->account_name : (($value->form_name == 'social_media_promotion')
                                                ? $value->promotion_info->product_name : (($value->form_name == 'top_up_apps')
                                                    ? $value->top_info->product_name : (($value->form_name == 'games_zone')
                                                        ? $value->game_info->product_name : "others"))))))))),

                'title' => $value->title,
                'description' => $value->description,
                'product_id' => $value->product_id,
                'discount' => $value->discount,
                'status' => $value->status


            );
        }


        $set = 'add';
        $category = Category::where('status', 1)->get();
        return view('admin.pages.discount', compact('discount', 'set', 'category'));
    }



    public function add_discount(Request $request)
    {
        $data_save = new Discount();
        $data_save->form_name = $request->form_name;
        $data_save->title = $request->title;
        $data_save->description = $request->description;
        $data_save->discount = $request->discount;



        if ($request->form_name == 'social_media') {
            $data = SocialMedia::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'make_payment') {
            $data = MakePayment::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'influence_marketing') {
            $data = InfluenceMarketing::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'gift_card') {
            $data = GiftCard::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'subscription') {
            $data = Subscription::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'digital_wallet') {
            $data = DigitalWallet::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'advertisement_account') {
            $data = AdvertisementAccount::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'social_media_promotion') {
            $data = SocialMediaPromotion::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'top_up_apps') {
            $data = TopUpApps::where('id', $request->product_id)->first();
        } elseif ($request->form_name == 'games_zone') {
            $data = GamesZone::where('id', $request->product_id)->first();
        }

        if ($data) {
            $data_save->product_id = $request->product_id;
            $data_save->save();
            return back();
        } else {
            return back()->with('message', 'Invalid product');
        }
    }
}