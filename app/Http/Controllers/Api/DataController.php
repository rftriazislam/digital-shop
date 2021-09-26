<?php

namespace App\Http\Controllers\Api;

use App\AdvertisementAccount;
use App\Category;
use App\DigitalWallet;
use App\GamesZone;
use App\GiftCard;
use App\Http\Controllers\Controller;
use App\InfluenceMarketing;
use App\MakePayment;
use App\SocialMedia;
use App\SocialMediaPromotion;
use App\Subcategory;
use App\Subscription;
use App\TopUpApps;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function categories()
    {
        $categories = Category::Select('id', 'name', 'form_name', 'status')
            ->with([
                'subcategory_info' => function ($query) {
                    $query->select('id', 'category_id', 'name', 'image', 'status');
                }

            ])->get();
        $img_path = 'public/back_end/category_images/';
        if (count($categories) > 0) {
            return response()->json(['success' => true, 'categories' => $categories, 'image_path' => $img_path], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'categories not found'], 400);
        }
    }



    public function allsubcategory($category_id)
    {
        $allsubcategories = Subcategory::Select(
            'id',
            'category_id',
            'name',
            'image',
            'status'
        )->with([

            'category_info' => function ($query) {
                $query->select('id', 'form_name');
            }
        ])->where('category_id', $category_id)->get();
        if (count($allsubcategories) > 0) {
            return response()->json(['success' => true, 'subcategory' => $allsubcategories], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'subcategories not found'], 400);
        }
    }


    public function allsingleproduct($form_name, $subcategory_id)
    {

        if ($form_name == 'social_media') {

            $data = SocialMedia::Select('id', 'social_name', 'price', 'post_id', 'category_id', 'subcategory_id')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'make_payment') {

            $data = MakePayment::Select('id', 'send_currency', 'send_amount', 'get_currency', 'get_wallet', 'unit_price', 'category_id', 'subcategory_id')
                ->with([

                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'influence_marketing') {


            $data = InfluenceMarketing::Select('id', 'social_name', 'hiring_time', 'last_engagement', 'price', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'gift_card') {


            $data = GiftCard::Select('id', 'name', 'price', 'qty', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'subscription') {


            $data = Subscription::Select('id', 'name', 'price', 'qty', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'digital_wallet') {


            $data = DigitalWallet::Select('id', 'account_name', 'price', 'country', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'advertisement_account') {


            $data = AdvertisementAccount::Select('id', 'account_name', 'price', 'country', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'social_media_promotion') {


            $data = SocialMediaPromotion::Select('id', 'product_name', 'unit_price', 'total_follower_subscriber', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'top_up_apps') {


            $data = TopUpApps::Select('id', 'product_name', 'unit_price', 'total_top_up', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } elseif ($form_name == 'games_zone') {


            $data = GamesZone::Select('id', 'product_name', 'unit_price', 'total_diamonds', 'post_id', 'category_id', 'subcategory_id')
                ->with([
                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])->where('subcategory_id', $subcategory_id)->where('status', 1)->paginate(10);
        } else {
            $data = [];
        }

        if (count($data) > 0) {
            return response()->json(['success' => true, 'form_name' => $form_name, 'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }
}