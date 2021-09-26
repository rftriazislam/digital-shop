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
use App\Subscription;
use App\TopUpApps;
use Illuminate\Http\Request;
use smasif\ShurjopayLaravelPackage\ShurjopayService;
use App\TransanctionHistory;
use App\User;

class PaymentController extends Controller
{
    protected $merchant_username;
    protected $merchant_password;
    protected $client_ip;
    protected $merchant_key_prefix;
    protected $tx_id;

    public function __construct()
    {
        $this->merchant_username = "unistag";
        $this->merchant_password = "miDXB57XSwBn";
        $this->client_ip = $this->getUserIP();

        // $this->client_ip = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        $this->merchant_key_prefix = "UNT";
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
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }




    public function generateTxId($unique_id = null)
    {
        if ($unique_id) {
            $tx_id = $this->merchant_key_prefix . $unique_id . 'UD' . uniqid();
        } else {
            $tx_id = $this->merchant_key_prefix . uniqid();
        }
        $this->tx_id = $tx_id;
        return $tx_id;
    }




    public function paymentresponse(Request $request)
    {
        $response_encrypted = $request->spdata;
        $response_decrypted = file_get_contents("https://shurjopay.com/merchant/decrypt.php?data=" . $response_encrypted);
        $response_data = simplexml_load_string($response_decrypted) or die("Error: Cannot create object");
        $success_url = $request->get('success_url');

        $tx_id = $response_data->txID;



        $trans_info = TransanctionHistory::where('tx_id', $tx_id)->first();

        // echo $response_data->bankTxStatus;
        // echo $response_data->txnAmount;
        // echo $response_data->spCode;
        // echo $response_data->spCodeDes;
        // echo $response_data->txID;

        $trans_info->update([
            'transaction_status' => ($response_data->spCode == '000') ? 'Success' : 'Fail'
        ]);

        if ($trans_info->form_name == 'social_media_promotion') {

            $all_ready_exits = [];
        } elseif ($trans_info->form_name == 'top_up_apps') {

            $all_ready_exits = [];
        } elseif ($trans_info->form_name == 'games_zone') {

            $all_ready_exits = [];
        } elseif ($trans_info->form_name == 'gift_card') {
            $all_ready_exits = [];
        } elseif ($trans_info->form_name == 'subscription') {
            $all_ready_exits = [];
        } elseif ($trans_info->form_name == 'make_payment') {
            $all_ready_exits = [];
        } else {

            $all_ready_exits = SellOrder::where('product_id', $trans_info->product_id)->where('form_name', $trans_info->form_name)->first();
        }




        if ($all_ready_exits) {
            return redirect()->route('payment_issue_apps', ['message' => 'fail', 'pid' => $trans_info->id]);
        } else {

            if ($response_data->spCode == '000') {


                $sell_info = SellOrder::where('tx_id', $trans_info->tx_id)->first();
                if ($sell_info) {
                    return redirect()->route('payment_issue_apps', ['message' => 'success', 'pid' => $trans_info->id]);
                } else {

                    $sell_order = new SellOrder();
                    $sell_order->tx_id = $trans_info->tx_id;
                    $sell_order->transanction_id = $trans_info->id;

                    $sell_order->buyer_id = $trans_info->buyer_id;
                    $sell_order->seller_id = $trans_info->seller_id;
                    $sell_order->product_id = $trans_info->product_id;

                    $sell_order->product_name = $trans_info->product_name;
                    $sell_order->form_name = $trans_info->form_name;
                    $sell_order->quantity = $trans_info->quantity;
                    $sell_order->price = $trans_info->price;
                    if ($sell_order->save()) {
                        if ($trans_info->form_name == 'social_media') {
                            $update = SocialMedia::where('id', $trans_info->product_id)->first();
                            $update->update(['status' => 2]);
                        } elseif ($trans_info->form_name == 'make_payment') {
                            $update = MakePayment::where('id', $trans_info->product_id)->first();

                            $quantity = $trans_info->quantity;
                            $send_amount = $update->send_amount;
                            $send_amount_udate = $send_amount - $quantity;
                            if ($send_amount_udate >= 0) {

                                $update->update(['send_amount' => $send_amount_udate]);
                                if ($send_amount_udate == 0) {
                                    $update->update(['status' => 5]); //out of stock
                                }
                            } else {
                                $update->update(['status' => 5]);
                            }

                            $update->update(['send_amount' => $send_amount_udate]);
                        } elseif ($trans_info->form_name == 'influence_marketing') {
                            $update = InfluenceMarketing::where('id', $trans_info->product_id)->first();
                            $update->update(['status' => 2]);
                        } elseif ($trans_info->form_name == 'gift_card') {
                            $update = GiftCard::where('id', $trans_info->product_id)->first();

                            $quantity = $trans_info->quantity;
                            $qty_st = $update->qty;
                            $qty_st_udate = $qty_st - $quantity;
                            if ($qty_st_udate >= 0) {

                                $update->update(['qty' => $qty_st_udate]);

                                if ($qty_st_udate == 0) {
                                    $update->update(['status' => 5]);
                                }
                            } else {
                                $update->update(['status' => 5]);
                            }
                        } elseif ($trans_info->form_name == 'subscription') {
                            $update = Subscription::where('id', $trans_info->product_id)->first();

                            $quantity = $trans_info->quantity;
                            $qty_st = $update->qty;
                            $qty_st_udate = $qty_st - $quantity;
                            if ($qty_st_udate >= 0) {

                                $update->update(['qty' => $qty_st_udate]);
                                if ($qty_st_udate == 0) {
                                    $update->update(['status' => 5]);
                                }
                            } else {
                                $update->update(['status' => 5]);
                            }
                        } elseif ($trans_info->form_name == 'digital_wallet') {
                            $update = DigitalWallet::where('id', $trans_info->product_id)->first();
                            $update->update(['status' => 2]);
                        } elseif ($trans_info->form_name == 'advertisement_account') {
                            $update = AdvertisementAccount::where('id', $trans_info->product_id)->first();
                            $update->update(['status' => 2]);
                        } elseif ($trans_info->form_name == 'social_media_promotion') {
                            $update = SocialMediaPromotion::where('id', $trans_info->product_id)->first();
                        } elseif ($trans_info->form_name == 'top_up_apps') {
                            $update = TopUpApps::where('id', $trans_info->product_id)->first();
                        } elseif ($trans_info->form_name == 'games_zone') {
                            $update = GamesZone::where('id', $trans_info->product_id)->first();
                        }

                        return redirect()->route('payment_issue_apps', ['message' => 'success', 'pid' => $trans_info->id]);
                    } else {

                        return redirect()->route('payment_issue_apps', ['message' => 'success', 'pid' => $trans_info->id]);
                        // return response()->json(
                        //     ['success' => true, 'message' => 'success add', 'ms_to' => $tx_id, 'pid' => $trans_info->id],
                        //     200
                        // );
                    }
                }
            } else {


                // return response()->json(
                //     ['success' => false, 'message' => 'Payment cancle', 'ms_to' => $tx_id, 'pid' => $trans_info->id],
                //     200
                // );
                return redirect()->route('payment_issue_apps', ['message' => 'fail', 'pid' => $trans_info->id]);
            }
        }
    }


    public function payment_issue(Request $request)
    {

        $message = $request->message;
        return view('payment_issue_app.payment', compact('message'));
    }


    protected function price_convert($price, $product_id, $form_name, $qty, $seller_id)
    {

        if ($form_name == 'make_payment') {

            $user_product = MakePayment::where('id', $product_id)->where('post_id', $seller_id)->first();

            if ($user_product->send_amount >= $qty) {
                $seller_currency = User::where('id', $seller_id)->first();
                $exchange_user = ExchangeRate::where('rates', $user_product->get_currency)->first();
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
        $validatedData =   $this->validate($request, [
            'buyer_id' => 'required',
            'seller_id' => 'required',
            'product_id' => 'required',
            'form_name' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);



        $prc = $this->price_convert($request->price, $request->product_id, $request->form_name, $request->quantity, $request->seller_id);



        if ($prc == 'false') {
            return response()->json(['success' => false, 'message' => 'Invalied Qty'], 400);
        } else {



            $price =  round($prc, 2);
            $shurjopay_service = new ShurjopayService();
            $tx_id = $this->generateTxId($request->product_id);
            // $success_route = 'paymentissue' . ',' . $tx_id;
            // $success_route =   route('paymentissue', $tx_id);
            // $p =  $shurjopay_service->sendPayment($price, $success_route);
            $return_url = 'https://unistag.xyz/api/payment-response';
            $xml_data = 'spdata=
        <?xml version="1.0" encoding="utf-8"?>
<shurjoPay>
    <merchantName>' . $this->merchant_username . '</merchantName>
    <merchantPass>' . $this->merchant_password . '</merchantPass>
    <userIP>' . $this->client_ip . '</userIP>
    <uniqID>' . $this->tx_id . '</uniqID>

    <totalAmount>' . $price . '</totalAmount>
    <paymentOption>shurjopay</paymentOption>
    <returnURL>' . $return_url . '</returnURL>
</shurjoPay>';


$ch = curl_init();
$url = "https://shurjopay.com/sp-data.php";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1); //0 for a get request
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$response = curl_exec($ch);
curl_close($ch);

$search_data_unique = substr($response, strpos($response, 'name="uniqID" value="') + 21);
$unique_id = substr($search_data_unique, 0, strpos($search_data_unique, '">'));


$search_data_order = substr($response, strpos($response, 'name="order_id" value="') + 23);
$order_id = substr($search_data_order, 0, strpos($search_data_order, '">'));

$search_data_amount = substr($response, strpos($response, 'name="txnAmount" value="') + 24);
$txAmount = substr($search_data_amount, 0, strpos($search_data_order, '">'));


$data = array(
'order_id' => $order_id,
'uniqID' => $unique_id,
'txnAmount' => $txAmount,
);

// dd($response);

// print_r($response);


// $shurjopay_service->sendPaymentapi($price);

$trans_order = new TransanctionHistory();
$trans_order->buyer_id = $request->buyer_id;
$trans_order->tx_id = $tx_id;
$trans_order->seller_id = $request->seller_id;
$trans_order->product_id = $request->product_id;
$trans_order->affiliate_id = 'NULL';
$trans_order->product_name = $request->product_name;
$trans_order->form_name = $request->form_name;
$trans_order->quantity = $request->quantity;
$trans_order->price = $price;
$trans_order->transaction_status = 'init';
$trans_order->save();

if ($data) {
return response()->json(['success' => true, 'data' => $data], 200);
} else {
return response()->json(['success' => false, 'message' => 'invalied transtion'], 400);
}
}
}
}