<?php

namespace App\Http\Controllers\Admin;

use App\AdvertisementAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Category;
use App\DigitalWallet;
use App\GamesZone;
use App\GiftCard;
use App\InfluenceMarketing;
use App\MakePayment;
use App\RejectMessage;
use App\SocialMedia;
use App\SocialMediaPromotion;
use App\Subcategory;
use App\Subscription;
use App\TopUpApps;

class ProductPermissionController extends Controller
{


    public function productpermission($form_name)
    {
        $form_code = $form_name;
        $category = Category::all();
        if ($form_name == 'null') {
            $data = '';
        } elseif ($form_name == 'social_media') {
            $data = SocialMedia::latest()->paginate(13);
        } elseif ($form_name == 'make_payment') {
            $data = MakePayment::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'influence_marketing') {
            $data = InfluenceMarketing::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'subscription') {
            $data = Subscription::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'gift_card') {
            $data = GiftCard::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'digital_wallet') {
            $data = DigitalWallet::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'advertisement_account') {
            $data = AdvertisementAccount::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'top_up_apps') {
            $data = TopUpApps::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'games_zone') {
            $data = GamesZone::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        } elseif ($form_name == 'social_media_promotion') {
            $data = SocialMediaPromotion::where('status', 0)->orwhere('status', 1)->latest()->paginate(13);
        }
        return view('admin.pages.productpermission', compact('data', 'form_code', 'category'));
    }

    public function productstatus($id, $status, $form_name)
    {
        if ($form_name == 'social_media') {
            $status_update = SocialMedia::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'make_payment') {
            $status_update = MakePayment::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'influence_marketing') {
            $status_update = InfluenceMarketing::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'subscription') {
            $status_update = Subscription::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'gift_card') {
            $status_update = GiftCard::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'digital_wallet') {
            $status_update = DigitalWallet::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'advertisement_account') {
            $status_update = AdvertisementAccount::where('id', $id)->first();;
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'top_up_apps') {
            $status_update = TopUpApps::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'games_zone') {
            $status_update = GamesZone::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        } elseif ($form_name == 'social_media_promotion') {
            $status_update = SocialMediaPromotion::where('id', $id)->first();
            if ($status == 0) {
                $status_update->update(['status' => 1]);
            } else if ($status == 9) {
                $status_update->update(['status' => 1]);
            } else if ($status == 8) {
                $status_update->update(['status' => 8]);
            } else {
                $status_update->update(['status' => 0]);
            }
        }


        return back();
    }
    public function productview($id, $form_name)

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
            return view('admin.pages.singleproductview', compact('data', 'form_name', 'message'));
        } else {
            return back();
        }
    }

    public function productdecline(Request $request)
    {
        $reject_save = new RejectMessage();
        $reject_save->post_id = $request->post_id;
        $reject_save->product_id = $request->product_id;
        $reject_save->form_name = $request->form_name;
        $reject_save->message = $request->message;
        $reject_save->send_user = "Admin";
        $reject_save->save();



        $form_name = $request->form_name;
        $id = $request->product_id;

        if ($form_name == 'social_media') {
            $status_update = SocialMedia::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'make_payment') {
            $status_update = MakePayment::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'influence_marketing') {
            $status_update = InfluenceMarketing::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'subscription') {
            $status_update = Subscription::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'gift_card') {
            $status_update = GiftCard::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'digital_wallet') {
            $status_update = DigitalWallet::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'advertisement_account') {
            $status_update = AdvertisementAccount::where('id', $id)->first();;
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'top_up_apps') {
            $status_update = TopUpApps::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'games_zone') {
            $status_update = GamesZone::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        } elseif ($form_name == 'social_media_promotion') {
            $status_update = SocialMediaPromotion::where('id', $id)->first();
            $status_update->update(['status' => 9]);
        }


        return  back();
    }














    public function  productdelete($id, $status, $form_name)
    {
        // $status_update = SocialMedia::where('id', $id)->first();
        // if ($status == 0) {
        //     $status_update->update(['status' => 1]);
        // } else {
        //     $status_update->update(['status' => 0]);
        // }
        return back();
    }
}