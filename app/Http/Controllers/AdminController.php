<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\MakePayment;
use App\RejectMessage;
use App\SocialMedia;
use App\TutorialVideo;
use App\User;
use App\WithdrawMoney;
use Image;
//ggg
class AdminController extends Controller
{

    public function index()
    {
        return view('admin.pages.home');
    }
    public function myprofile()
    {
        return view('admin.pages.myprofile');
    }
    public function profile_update(Request $request)
    {
        $user_info = User::where('id', $request->user_id)->first();

        $user_info->update($request->all());

        return back();
    }




    public function permissionmakemoney()
    {
        $makemoney = MakePayment::all();
        return view('admin.pages.permission_makemoney', compact('makemoney'));
    }


    public function socialstatus($id, $status)
    {
        $status_update = SocialMedia::where('id', $id)->first();
        if ($status == 0) {
            $status_update->update(['status' => 1]);
        } else {
            $status_update->update(['status' => 0]);
        }
        return back();
    }






    public function makestatus($id, $status)
    {
        $status_update = MakePayment::where('id', $id)->first();
        if ($status == 0) {
            $status_update->update(['status' => 1]);
        } else {
            $status_update->update(['status' => 0]);
        }
        return back();
    }

    public function withdraw()
    {
        $withdraws = WithdrawMoney::latest()->paginate(14);
        return view('admin.pages.withdraw', compact('withdraws'));
    }
    public function  withdraw_view($id)
    {

        $withdraws_view = WithdrawMoney::where('id', $id)->with('user_info')->first();
        return view('admin.pages.withdraws_view', compact('withdraws_view'));
    }
    public function withdraw_save(Request $request)
    {

        $withdraw_update = WithdrawMoney::where('id', $request->withdraw_id)->first();

        if ($request->hasfile('image1')) {
            $image = $request->file('image1');
            $filename = 'image1/' . $request->withdraw_id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save(public_path('back_end/withdraw_images/' . $filename));

            $order = $withdraw_update->update([
                $withdraw_update->image1 = $filename,
                $withdraw_update->status = 1
            ]);
        }
        if ($request->hasfile('image2')) {
            $image = $request->file('image2');
            $filename = 'image2/' . $request->withdraw_id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save(public_path('back_end/withdraw_images/' . $filename));

            $order = $withdraw_update->update([
                $withdraw_update->image2 = $filename,

            ]);
        }
        if ($request->hasfile('image3')) {
            $image = $request->file('image3');
            $filename = 'image3/' . $request->withdraw_id . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 600)->save(public_path('back_end/withdraw_images/' . $filename));
            $order = $withdraw_update->update([
                $withdraw_update->image3 = $filename,

            ]);
        }

        if ($request->image1 == '') {
            $order = '';
        }

        if ($order) {
            return redirect()->route('admin.withdraw');
        } else {
            return back();
        }
    }


    public function tutorial_video()
    {

        $tutorial = TutorialVideo::paginate(10);
        return view('admin.pages.tutorial_video', compact('tutorial'));
    }


    public function save_tutorial(Request $request)
    {
        $title = $request->youtube_title;
        $url = $request->youtube_link;
        // preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/|embed|\/)[a-zA-Z0-9_-]{11}#", $url, $data);
        $p = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);

        if ($p == 1) {
            $youtube_id = $match[1];
            $tutorial = new TutorialVideo();
            $tutorial->youtube_title =  $title;
            $tutorial->youtube_link =   $url;
            $tutorial->youtube_embed_link = 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1&mute=1';
            $tutorial->youtube_id = $youtube_id;
            $tutorial->save();
            return back();
        } else {
            return back()->with('message', 'Your youtube link invalid');
        }
    }
    public function youtubestatus($id)
    {
        $status_update = TutorialVideo::where('id', $id)->first();

        if ($status_update->status == 0) {
            $status_update->update(['status' => 1]);
        } else {
            $status_update->update(['status' => 0]);
        }
        return back();
    }
    public function youtubedelete($id)
    {
        TutorialVideo::where('id', $id)->delete();
        return back();
    }

    public function youtubeedit($id)
    {
        $tutorial = TutorialVideo::paginate(10);
        $youtube = TutorialVideo::where('id', $id)->first();

        return view('admin.pages.youtube_edit', compact('youtube', 'tutorial'));
    }





    public function update_tutorial(Request $request)
    {
        $id = $request->id;
        $title = $request->youtube_title;
        $url = $request->youtube_link;
        // preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/|embed|\/)[a-zA-Z0-9_-]{11}#", $url, $data);
        $p = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);

        if ($p == 1) {
            $youtube_id = $match[1];
            $tutorial = TutorialVideo::where('id', $id)->first();
            $tutorial->update([
                'youtube_title' => $title,
                'youtube_link' => $url,
                'youtube_embed_link' => 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1&mute=1',
                'youtube_id' => $youtube_id,
            ]);
            return redirect()->route('tutorial_video');
        } else {
            return back()->with('message', 'Your youtube link invalid');
        }
    }


    public function commission()
    {
        $category_info = Category::OrderBy('id', 'desc')->paginate(10);
        $set = '';
        return view('admin.pages.commission', compact('category_info', 'set'));
    }


    public function commissionset($id)
    {
        $category_info = Category::OrderBy('id', 'desc')->paginate(10);
        $category_edit = Category::find($id);
        $set = 'true';
        return view('admin.pages.commission', compact('category_info', 'category_edit', 'set'));
    }

    public function commissionupdated(Request $request)
    {

        $category_update = Category::find($request->category_id);
        $category_update->refer_commission = $request->refer_commission;
        $category_update->affilate_commission = $request->affilate_commission;
        $category_update->company_commission = $request->company_commission;
        $category_update->save();

        return redirect()->route('admin.commission')->with('message', 'category updated');
    }

    public function reject_message(Request $request)
    {
        $reject_save = new RejectMessage();
        $reject_save->post_id = $request->post_id;
        $reject_save->product_id = $request->product_id;
        $reject_save->form_name = $request->form_name;
        $reject_save->message = $request->message;
        $reject_save->send_user = "Admin";
        $reject_save->save();
        return back();
    }

    public function customer_list()
    {
        $user_list = User::paginate(10);
        return view('admin.pages.user_list', compact('user_list'));
    }
}