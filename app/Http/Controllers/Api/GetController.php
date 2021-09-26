<?php

namespace App\Http\Controllers\Api;

use App\AdvertisementAccount;
use App\DigitalWallet;
use App\ExchangeRate;
use App\GamesZone;
use App\GiftCard;
use App\Http\Controllers\Controller;
use App\InfluenceMarketing;
use App\MakePayment;
use App\SellOrder;
use App\SocialMedia;
use App\SocialMediaPromotion;
use App\Subcategory;
use App\Subscription;
use App\TopUpApps;
use App\TutorialVideo;
use App\WishList;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class GetController extends Controller
{
    public function products()
    {


        $subcategory = Subcategory::where('status', 1)->get();


        $social_media = [];
        $make_payment = [];
        $influence_marketing = [];

        foreach ($subcategory as $items) {

            if ($items->category_info->form_name == 'social_media') {
                $social_media[$items->name] = SocialMedia::Select('id', 'price', 'category_id', 'subcategory_id')
                    ->with([
                        'category_info' => function ($query) {
                            $query->select('id', 'form_name');
                        },
                        'subcategory_info' => function ($query) {
                            $query->select('id', 'image');
                        }
                    ])
                    ->where('subcategory_id', $items->id)
                    ->where('status', 1)->get()->take(4);
            } elseif ($items->category_info->form_name == 'make_payment') {
                $make_payment[$items->name] = MakePayment::Select(['id', 'unit_price', 'category_id', 'subcategory_id'])
                    ->with([
                        'category_info' => function ($query) {
                            $query->select('id', 'form_name');
                        },
                        'subcategory_info' => function ($query) {
                            $query->select('id', 'image');
                        }
                    ])
                    ->where('subcategory_id', $items->id)->where('status', 1)->get()->take(4);
            } elseif ($items->category_info->form_name == 'influence_marketing') {
                $influence_marketing[$items->name] = InfluenceMarketing::Select(['id', 'price', 'category_id', 'subcategory_id'])
                    ->with([
                        'category_info' => function ($query) {
                            $query->select('id', 'form_name');
                        },
                        'subcategory_info' => function ($query) {
                            $query->select('id', 'image');
                        }
                    ])
                    ->where('subcategory_id', $items->id)->where('status', 1)->get()->take(4);
            }
        }





        if ($social_media != null || $make_payment != null || $influence_marketing != null) {
            return response()->json(['success' => true, 'social_media' => $social_media, 'make_payment' => $make_payment, 'influence_marketing' => $influence_marketing], 200);
        } else {
            return response()->json(['success' => true, 'message' => 'failed'], 400);
        }
    }
    public function all_products()
    {
        $mk = MakePayment::Select(['id', 'unit_price', 'send_amount', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])
            ->where('status', 1)->latest();

        $in =  InfluenceMarketing::Select(['id', 'price', 'social_name', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])
            ->where('status', 1)->latest();

        $gf =  GiftCard::Select(['id', 'price', 'name', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])
            ->where('status', 1)->latest();
        $sub =  Subscription::Select(['id', 'price', 'name', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])
            ->where('status', 1)->latest();

        $digi = DigitalWallet::Select('id',  'price', 'account_name', 'post_id', 'category_id', 'subcategory_id', 'created_at')
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])
            ->where('status', 1)->latest();


        $adv = AdvertisementAccount::Select('id',  'price', 'account_name', 'post_id', 'category_id', 'subcategory_id', 'created_at')
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])
            ->where('status', 1)->latest();
        $promo = SocialMediaPromotion::Select('id', 'unit_price', 'product_name', 'post_id', 'category_id',  'subcategory_id', 'created_at')
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])

            ->where('status', 1)->latest();

        $top = TopUpApps::Select('id', 'unit_price', 'product_name', 'post_id', 'category_id',  'subcategory_id', 'created_at')
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])

            ->where('status', 1)->latest();
        $gam = GamesZone::Select('id', 'unit_price', 'product_name', 'post_id', 'category_id',  'subcategory_id', 'created_at')
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])

            ->where('status', 1)->latest();

        $data = SocialMedia::Select(['id', 'price', 'social_name as name', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
            ->with([
                'user_info' => function ($query) {
                    $query->select('id', 'currency', 'flag');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])

            ->where('status', 1)
            ->union($in)
            ->union($mk)
            ->union($gf)
            ->union($sub)
            ->union($digi)
            ->union($adv)
            ->union($promo)
            ->union($top)
            ->union($gam)
            ->orderByDesc('created_at')->paginate(10);

        // ->paginate(10);



        // $dat = collect($data)->sortByDesc('created_at');

        if (count($data) > 0) {
            return response()->json(['success' => true, 'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'failed'], 400);
        }
    }

    public function socialproducts()
    {
        $social_media =   SocialMedia::Select('id', 'price', 'post_id', 'category_id', 'subcategory_id')
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

            ])->where('status', 1)->paginate(10);
        if ($social_media) {
            return response()->json(['success' => true,  'social_products' => $social_media], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }
    public function makepaymentproducts()
    {
        $makepaymentproducts =   MakePayment::Select(['id', 'unit_price', 'category_id', 'subcategory_id'])
            ->with([
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image');
                }
            ])->where('status', 1)->paginate(10);
        if ($makepaymentproducts) {
            return response()->json(['success' => true,  'make_payment_products' => $makepaymentproducts], 200);
        } else {
            return response()->json(['success' => true, 'message' => 'Not found'], 400);
        }
    }
    public function influenceproducts()
    {
        $influenceproducts =   InfluenceMarketing::Select(['id', 'price', 'post_id', 'category_id', 'subcategory_id'])
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
            ])
            ->where('status', 1)->paginate(10);
        if ($influenceproducts) {
            return response()->json(['success' => true,  'influence_products' => $influenceproducts], 200);
        } else {
            return response()->json(['success' => true, 'message' => 'Not found'], 400);
        }
    }
    public function giftcards()
    {
        $giftcard =   GiftCard::Select('id', 'price', 'post_id', 'category_id', 'subcategory_id')
            ->with([

                'user_info' => function ($query) {
                    $query->select('id', 'currency');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name', 'name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image', 'name');
                }

            ])->where('status', 1)->paginate(10);
        if ($giftcard) {
            return response()->json(['success' => true,  'giftcard_products' => $giftcard], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }
    public function subscriptions()
    {
        $subscriptions =   Subscription::Select('id', 'price', 'post_id', 'category_id', 'subcategory_id')
            ->with([

                'user_info' => function ($query) {
                    $query->select('id', 'currency');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name', 'name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image', 'name');
                }

            ])->where('status', 1)->paginate(10);
        if ($subscriptions) {
            return response()->json(['success' => true,  'subscription_products' => $subscriptions], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }


    public function digital_wallets()
    {
        $data =   DigitalWallet::Select('id', 'price', 'post_id', 'category_id', 'subcategory_id')
            ->with([

                'user_info' => function ($query) {
                    $query->select('id', 'currency');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name', 'name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image', 'name');
                }

            ])->where('status', 1)->paginate(10);
        if ($data) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }

    public function advertisement_accounts()
    {
        $data =   AdvertisementAccount::Select('id', 'price', 'post_id', 'category_id', 'subcategory_id')
            ->with([

                'user_info' => function ($query) {
                    $query->select('id', 'currency');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name', 'name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image', 'name');
                }

            ])->where('status', 1)->paginate(10);
        if ($data) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }
    public function socialmedia_promotions()
    {
        $data =   SocialMediaPromotion::Select('id', 'unit_price', 'post_id', 'category_id', 'subcategory_id')
            ->with([

                'user_info' => function ($query) {
                    $query->select('id', 'currency');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name', 'name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image', 'name');
                }

            ])->where('status', 1)->paginate(10);
        if ($data) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }



    public function toupapps()
    {
        $data =   TopUpApps::Select('id', 'unit_price', 'post_id', 'category_id', 'subcategory_id')
            ->with([

                'user_info' => function ($query) {
                    $query->select('id', 'currency');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name', 'name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image', 'name');
                }

            ])->where('status', 1)->paginate(10);
        if ($data) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }
    public function gameszons()
    {
        $data =   GamesZone::Select('id', 'unit_price', 'post_id', 'category_id', 'subcategory_id')
            ->with([

                'user_info' => function ($query) {
                    $query->select('id', 'currency');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name', 'name');
                },
                'subcategory_info' => function ($query) {
                    $query->select('id', 'image', 'name');
                }

            ])->where('status', 1)->paginate(10);
        if ($data) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }














    public function singleproduct($form_name, $product_id)
    {

        if ($form_name == 'social_media') {

            $data = SocialMedia::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'make_payment') {
            $data = MakePayment::Select('*')
                ->with([
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'influence_marketing') {
            $data = InfluenceMarketing::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'gift_card') {
            $data = GiftCard::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'subscription') {
            $data = Subscription::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'digital_wallet') {
            $data = DigitalWallet::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'advertisement_account') {
            $data = AdvertisementAccount::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'social_media_promotion') {
            $data = SocialMediaPromotion::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'top_up_apps') {
            $data = TopUpApps::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } elseif ($form_name == 'games_zone') {
            $data = GamesZone::Select('*')
                ->with([

                    'user_info' => function ($query) {
                        $query->select('id', 'currency');
                    },
                    'seller_info' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'category_info' => function ($query) {
                        $query->select('id', 'form_name');
                    },
                    'subcategory_info' => function ($query) {
                        $query->select('id', 'image');
                    }
                ])
                ->where('id', $product_id)->first();
        } else {
        }
        if ($data) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Not found'], 400);
        }
    }


    public function order_history($user_id)
    {

        $data = SellOrder::select('*')

            ->with([
                'seller_user_info' => function ($query) {
                    $query->select('id', 'name', 'email', 'phone');
                },
                'buyer_info' => function ($query) {
                    $query->select('id', 'name', 'email', 'phone');
                },
                'category_info' => function ($query) {
                    $query->select('id', 'form_name');
                },
            ])
            ->where('seller_id', $user_id)->orWhere('buyer_id', $user_id)->get();

        if ($data->count()) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No data found'], 200);
        }
    }


    public function order_image($order_id)
    {


        $data = SellOrder::select('*')->where('id', $order_id)->where('status', 2)->first();

        if (!empty($data)) {
            return response()->json(['success' => true,  'order_info' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No data found'], 200);
        }
    }


    public function searchproducts(Request $request)
    {
        $key = $request->key;
        $mk = MakePayment::Select(['id', 'post_id', 'unit_price', 'send_amount', 'send_currency', 'category_id', 'subcategory_id', 'created_at'])
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
            ])
            ->where('status', 1)
            ->where('send_wallet', 'like', "%{$key}%")
            ->orWhere('send_currency', 'like', "%{$key}%")
            ->orWhere('send_amount', 'like', "%{$key}%")
            ->latest();

        $in =  InfluenceMarketing::Select(['id', 'post_id', 'price', 'social_name', 'social_link', 'category_id', 'subcategory_id', 'created_at'])
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
            ])
            ->where('social_name', 'like', "%{$key}%")
            ->orWhere('social_type', 'like', "%{$key}%")
            ->where('status', 1)->latest();

        $data = SocialMedia::Select(['id', 'post_id', 'price', 'social_name as name', 'social_link as link', 'category_id', 'subcategory_id', 'created_at'])
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
            ])

            ->where('status', 1)
            ->where('social_name', 'like', "%{$key}%")
            ->union($in)
            ->union($mk)
            ->orderByDesc('created_at')
            ->paginate(10);

        if ($data->count()) {
            return response()->json(['success' => true,  'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No data found'], 200);
        }
    }

    public function moneyexchange(Request $request)
    {


        if ($request->currency) {
            $exchange = ExchangeRate::select('base', 'rates', 'money')->where('rates', $request->currency)->first();
        } else {
            $exchange = ExchangeRate::select('base', 'rates', 'money')->get();
        }




        if ($exchange) {
            return response()->json(['success' => true,  'Exchanges' => $exchange], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No data found'], 200);
        }
    }


    public function tutorial_video()
    {
        $data = TutorialVideo::select('id', 'youtube_title', 'youtube_id')->where('status', 1)->get();
        if ($data) {
            return response()->json(['success' => true,  'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'No data found'], 200);
        }
    }

    public function popular_products()
    {

        $mk = MakePayment::Select(['id', 'unit_price', 'send_amount', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
            ->with('sellorder')
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
            ])
            ->withCount('mk_sellorder_info')
            ->where('status', 1)->latest();

        $gf =  GiftCard::Select(['id', 'price', 'name', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
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
            ])
            ->withCount('gf_sellorder_info')
            ->where('status', 1)->latest();


        $promo = SocialMediaPromotion::Select('id', 'unit_price', 'product_name', 'post_id', 'category_id',  'subcategory_id', 'created_at')
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
            ])
            ->withCount('pomo_sellorder_info')
            ->where('status', 1)->latest();

        $top = TopUpApps::Select('id', 'unit_price', 'product_name', 'post_id', 'category_id',  'subcategory_id', 'created_at')
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
            ])
            ->withCount('top_sellorder_info')
            ->where('status', 1)->latest();
        $gam = GamesZone::Select('id', 'unit_price', 'product_name', 'post_id', 'category_id',  'subcategory_id', 'created_at')
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
            ])
            ->withCount('gam_sellorder_info')
            ->where('status', 1)->latest();


        $data =  Subscription::Select(['id', 'price', 'name as name', 'post_id', 'category_id', 'subcategory_id', 'created_at'])
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
            ])
            ->withCount('su_sellorder_info as orders')


            ->where('status', 1)->union($gam)->union($top)->union($promo)->union($mk)->union($gf)->orderByDesc('orders')->paginate(10);




        if ($data) {
            return response()->json(['success' => true, 'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'failed'], 400);
        }
    }


    public function favorite_products($id)
    {

        $data = WishList::select(['id', 'product_id', 'form_name'])->where('user_id', $id)->get();
        if (count($data) > 0) {
            return response()->json(['success' => true, 'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'failed'], 400);
        }
    }
    public function all_favorite_products($id)
    {

        // $data = WishList::select(['id', 'product_id', 'form_name'])->where('user_id', $id)->get();


        $social = DB::table('wish_lists')->where('user_id', $id)
            ->join('social_media', 'wish_lists.product_id', '=', 'social_media.id')->where('wish_lists.form_name', '=', 'social_media')
            ->join('users', 'social_media.post_id', '=', 'users.id')
            ->join('categories', 'social_media.category_id', '=', 'categories.id')
            ->join('subcategories', 'social_media.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'social_media.id as product_id',
                'social_media.price',
                'social_media.social_name as product_name',
                'social_media.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();


        $in = DB::table('wish_lists')->where('user_id', $id)
            ->join('influence_marketings', 'wish_lists.product_id', '=', 'influence_marketings.id')->where('wish_lists.form_name', '=', 'influence_marketing')
            ->join('users', 'influence_marketings.post_id', '=', 'users.id')
            ->join('categories', 'influence_marketings.category_id', '=', 'categories.id')
            ->join('subcategories', 'influence_marketings.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'influence_marketings.id as product_id',
                'influence_marketings.price',
                'influence_marketings.social_name as product_name',
                'influence_marketings.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $gf = DB::table('wish_lists')->where('user_id', $id)
            ->join('gift_cards', 'wish_lists.product_id', '=', 'gift_cards.id')->where('wish_lists.form_name', '=', 'gift_card')
            ->join('users', 'gift_cards.post_id', '=', 'users.id')
            ->join('categories', 'gift_cards.category_id', '=', 'categories.id')
            ->join('subcategories', 'gift_cards.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'gift_cards.id as product_id',
                'gift_cards.price',
                'gift_cards.name as product_name',
                'gift_cards.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $sub = DB::table('wish_lists')->where('user_id', $id)
            ->join('subscriptions', 'wish_lists.product_id', '=', 'subscriptions.id')->where('wish_lists.form_name', '=', 'subscription')
            ->join('users', 'subscriptions.post_id', '=', 'users.id')
            ->join('categories', 'subscriptions.category_id', '=', 'categories.id')
            ->join('subcategories', 'subscriptions.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'subscriptions.id as product_id',
                'subscriptions.price',
                'subscriptions.name as product_name',
                'subscriptions.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $digi = DB::table('wish_lists')->where('user_id', $id)
            ->join('digital_wallets', 'wish_lists.product_id', '=', 'digital_wallets.id')->where('wish_lists.form_name', '=', 'digital_wallet')
            ->join('users', 'digital_wallets.post_id', '=', 'users.id')
            ->join('categories', 'digital_wallets.category_id', '=', 'categories.id')
            ->join('subcategories', 'digital_wallets.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'digital_wallets.id as product_id',
                'digital_wallets.price',
                'digital_wallets.account_name as product_name',
                'digital_wallets.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $adv = DB::table('wish_lists')->where('user_id', $id)
            ->join('advertisement_accounts', 'wish_lists.product_id', '=', 'advertisement_accounts.id')->where('wish_lists.form_name', '=', 'advertisement_account')
            ->join('users', 'advertisement_accounts.post_id', '=', 'users.id')
            ->join('categories', 'advertisement_accounts.category_id', '=', 'categories.id')
            ->join('subcategories', 'advertisement_accounts.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'advertisement_accounts.id as product_id',
                'advertisement_accounts.price',
                'advertisement_accounts.account_name as product_name',
                'advertisement_accounts.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $promo = DB::table('wish_lists')->where('user_id', $id)
            ->join('social_media_promotions', 'wish_lists.product_id', '=', 'social_media_promotions.id')->where('wish_lists.form_name', '=', 'social_media_promotion')
            ->join('users', 'social_media_promotions.post_id', '=', 'users.id')
            ->join('categories', 'social_media_promotions.category_id', '=', 'categories.id')
            ->join('subcategories', 'social_media_promotions.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'social_media_promotions.id as product_id',
                'social_media_promotions.unit_price as price',
                'social_media_promotions.product_name as product_name',
                'social_media_promotions.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $top = DB::table('wish_lists')->where('user_id', $id)
            ->join('top_up_apps', 'wish_lists.product_id', '=', 'top_up_apps.id')->where('wish_lists.form_name', '=', 'top_up_apps')
            ->join('users', 'top_up_apps.post_id', '=', 'users.id')
            ->join('categories', 'top_up_apps.category_id', '=', 'categories.id')
            ->join('subcategories', 'top_up_apps.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'top_up_apps.id as product_id',
                'top_up_apps.unit_price as price',
                'top_up_apps.product_name as product_name',
                'top_up_apps.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $gam = DB::table('wish_lists')->where('user_id', $id)
            ->join('games_zones', 'wish_lists.product_id', '=', 'games_zones.id')->where('wish_lists.form_name', '=', 'games_zone')
            ->join('users', 'games_zones.post_id', '=', 'users.id')
            ->join('categories', 'games_zones.category_id', '=', 'categories.id')
            ->join('subcategories', 'games_zones.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'games_zones.id as product_id',
                'games_zones.unit_price as price',
                'games_zones.product_name as product_name',
                'games_zones.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])->latest();
        $data = DB::table('wish_lists')->where('user_id', $id)
            ->join('make_payments', 'wish_lists.product_id', '=', 'make_payments.id')->where('wish_lists.form_name', '=', 'make_payment')
            ->join('users', 'make_payments.post_id', '=', 'users.id')
            ->join('categories', 'make_payments.category_id', '=', 'categories.id')
            ->join('subcategories', 'make_payments.subcategory_id', '=', 'subcategories.id')
            ->select([
                'wish_lists.id',
                'make_payments.id as product_id',
                'make_payments.unit_price as price',
                'make_payments.send_amount as product_name',
                'make_payments.post_id',
                'users.name as user_name',
                'users.flag',
                'users.currency',
                'categories.id as category_id',
                'categories.form_name',
                'subcategories.id as subcategory_id',
                'subcategories.name as subcategory_name',
                'subcategories.image',
                'wish_lists.created_at',
            ])
            ->union($social)
            ->union($in)
            ->union($gf)
            ->union($sub)
            ->union($digi)
            ->union($adv)
            ->union($promo)
            ->union($top)
            ->union($gam)
            ->orderByDesc('created_at')->paginate(10);
        // $data =  collect($social, $mak);


        if (count($data) > 0) {
            return response()->json(['success' => true, 'products' => $data], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'failed'], 400);
        }
    }
}