<?php

namespace App\Http\Controllers;

use App\AdvertisementAccount;
use App\DigitalWallet;
use App\GamesZone;
use App\GiftCard;
use App\InfluenceMarketing;
use App\MakePayment;
use App\SellOrder;
use App\SocialMedia;
use App\SocialMediaPromotion;
use App\Subscription;
use App\TopUpApps;
use App\TransanctionHistory;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function paymentcompletedetails(Request $request)
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


        // echo  $response_data->bankTxID;
        // echo  $response_data->paymentOption;

        // exit();
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
        } else {

            $all_ready_exits = SellOrder::where('product_id', $trans_info->product_id)->where('form_name', $trans_info->form_name)->get();
        }
        if ($all_ready_exits) {
            return redirect()->route('home');
        } else {

            $sell_info = SellOrder::where('tx_id', $trans_info->tx_id)->first();
            if ($sell_info) {
                return redirect()->route('paymentissue', ['ms_to' => $tx_id, 'pid' => $trans_info->id]);
            } else {


                if ($response_data->spCode == '000') {


                    $sell_order = new SellOrder();
                    $sell_order->tx_id =   $trans_info->tx_id;
                    $sell_order->transanction_id =   $trans_info->id;

                    $sell_order->buyer_id = $trans_info->buyer_id;
                    $sell_order->seller_id =  $trans_info->seller_id;
                    $sell_order->product_id =   $trans_info->product_id;

                    $sell_order->product_name =   $trans_info->product_name;
                    $sell_order->form_name =   $trans_info->form_name;
                    $sell_order->quantity =   $trans_info->quantity;
                    $sell_order->price = $trans_info->price;

                    if ($sell_order->save()) {

                        // $commission = Category::select('id', 'company_commission', 'refer_commission', 'affilate_commission')->where('form_name', $request->form_name)->first();
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
                                    $update->update(['status' => 5]);
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

                        return redirect()->route('paymentissue', ['ms_to' => $tx_id, 'pid' => $trans_info->id]);
                    } else {

                        return redirect()->route('paymentissue', ['ms_to' => $tx_id, 'pid' => $trans_info->id]);
                    }
                } else {

                    return redirect()->route('paymentissue', ['ms_to' => $tx_id, 'pid' => $trans_info->id]);
                }
            }
        }
    }


    public function paymentissue(Request $request)
    {
        $data =   $request->ms_to;
        $trans_info = TransanctionHistory::where('id',  $request->pid)->where('tx_id', $data)->first();
        if ($trans_info) {
            if ($trans_info->transaction_status == 'Success') {
                $message = 'success';
                return view('frontend.home.page.paymentcomplete', compact('message'));
            } elseif ($trans_info->transaction_status == 'Fail') {
                $message = 'fail';
                return view('frontend.home.page.paymentcomplete', compact('message'));
            }
        } else {
            return redirect('/error');
        }
    }
}