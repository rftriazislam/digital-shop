<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\MakePayment;
use App\SocialMedia;

class Cartcontroller extends Controller
{
    public function addtocart(Request $request)
    {
        $category = Category::where('id', $request->category_id)->first();
        $form_name = $category->form_name;
        // \Cart::clear();

        if ($form_name == 'social_media') {


            $product = SocialMedia::findOrFail($request->input('product_id'));

            // \Cart::clear();
            $unique_id = $request->category_id . $product->id;

            $data_id = \Cart::get($unique_id);


            if ($data_id == null) {

                \Cart::add(array(
                    'id' =>  $request->category_id . $product->id,
                    'name' => $product->social_name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $product->subcategory_info->image,
                        'subcategory_id' => $product->subcategory_id,
                        'category_id' => $product->category_id,
                        'form_name' => $form_name,
                        'product_id' =>  $product->id,
                    ),

                ));


                $data =  \Cart::getContent();
                $total = $data->count();
                $msg = 'New add';
                
                return response()->json(['data' => $data, 'total' => $total, 'message' => $msg], 200);


                // \Cart::clear();
            } else {

                $data =  \Cart::getContent();
                $total = $data->count();
                $msg = 'already add';

                return response()->json(['data' => $data, 'total' => $total, 'message' => $msg], 200);
                // return response($data, $msg);
            }
        } elseif ($form_name == 'make_payment') {

            $product = MakePayment::findOrFail($request->input('product_id'));
            // \Cart::clear();

            $unique_id = $request->category_id . $product->id;

            $summedPrice = \Cart::get($unique_id);

            ($summedPrice != null) ?  $summedPrice = $summedPrice->quantity :  $summedPrice = 0;


            // return response($summedPrice);
            // exit();
            if ($product->send_amount > $summedPrice) {
                \Cart::add(array(

                    'id' => $request->category_id . $product->id,
                    'name' => 'gg',
                    'price' => $product->unit_price,
                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $product->subcategory_info->image,
                        'subcategory_id' => $product->subcategory_id,
                        'category_id' => $product->category_id,
                        'form_name' => $form_name,
                        'product_id' => $product->id,
                    ),

                ));

                $data =  \Cart::getContent();

                $msg = 'New add';

                return response()->json(['data' => $data, 'message' => $msg], 200);

                // return response($data, $msg);
                // \Cart::clear();
            } else {
                $data =  \Cart::getContent();
                $msg = 'no money';
                return response()->json(['data' => $data, 'message' => $msg], 200);
                // return response($data, $msg);
            }
        } elseif ($form_name == 'influence_marketing') {
        }
        // $data =  \Cart::getContent();
        // $total = $data->count();
        // \Cart::clear();
        return view('frontend.home.page.cart', compact('data', 'total'));
    }




    public function addtoocart($id)
    {

        $product = SocialMedia::findOrFail($id);

        $data_id = \Cart::get($id);
        if ($data_id == null) {
            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->social_name,
                'price' => $product->price,
                'image' => '55',
                'quantity' => 1,
                'attributes' => array(
                    'image' => $product->subcategory_info->image,
                ),
                'model' => $product
            ));
        }

        return redirect()->route('cartpage');
    }




    public function cartdata()
    {



        $datar =  \Cart::getContent();

        $total = $datar->count();

        $total_price = \Cart::getTotal();


        if ($total != null) {



            $output = '    <div class="ps-cart__items"style="overflow: scroll;width:100%;height:260px;">
     ';

            foreach ($datar as $row) {

                $output .= '    <div class="ps-product--cart-mobile">
             <div class="ps-product__thumbnail"><a href="#"><img src="' . asset('back_end/subcategory_images') . '/' .  $row->attributes->image . '" alt=""></a></div>
               <div class="ps-product__content" >
             <a class="ps-product__remove" href=""><i class="icon-cross "></i></a> 
                <a href="product-default.html">' . $row->name . '</a>
              <p><strong>Quantity:</strong> <small style="float:right;">' . $row->quantity . '</small></p>
                <p><strong>Price:</strong> <small style="float:right;">$' . $row->price . '</small></p>
              <p><strong>Subtotal:</strong> <small style="float:right;">$' . $row->getPriceSum() . '</small></p>
              </div>
             </div>';
            }

            $output .= ' </div>';

            $output .= ' <div class="ps-cart__footer">

          <h3> Total Price:<strong>
' . $total_price . '
             

              </strong></h3>
          <figure><a class="ps-btn" href="' .
                route('cartpage') . ' 
        ">View Cart</a><a class="ps-btn" href="' . route('checkout') . '">Checkout</a></figure>
       
          </div> ';
        } else {



            $output = ' <div class="ps-cart__footer">

        <h3 style="text-align:center;color:red"> No product  <strong>
            </strong></h3>
        </div> ';
        }


        $data = array(
            'cart_details'  => $output,
            'total_item'  => $total
        );

        echo json_encode($data);
    }

    public function jscartpage()
    {
        $output = '   <table class="table ps-table--shopping-cart">
    <thead>
      <tr>
        <th>ID</th>
        <th>Product name</th>
        <th>PRICE</th>
        <th>QUANTITY</th>
        <th>TOTAL PRICE</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>';
        $cart = \Cart::getContent();
        foreach ($cart as $item) {
            $output .= ' <tr>
    <td>' . $item->attributes->product_id . '</td>
    <td>
        <div class="ps-product--cart">
            <div class="ps-product__thumbnail"><a href="product-default.html"><img
                        src="' . asset('back_end/subcategory_images') . '/' . $item->attributes->image . '" alt=""></a></div>
            <div class="ps-product__content">
                <a href="product-default.html">' . $item->name . '</a>

            </div>
        </div>
    </td>
    <td class="price">$' . $item->price . '</td>
    ';
            if ($item->attributes->form_name == 'make_payment') {
                $output .= '
  <td>
            <div class="form-group--number">
            <input class="form-control update" type="number"   placeholder="1" id="' . $item->id . '"  min="1" value="' . $item->quantity . '">
          </div>
        </td> 
';
            } elseif ($item->attributes->form_name == 'social_media') {
                $output .= '
    <td>' . $item->quantity . '</td>';
            }
            $output .= '
    <td>$' . $item->getPriceSum() . '</td>
    <td><a href="#"><i class="icon-cross delete" id="' . $item->id . '"></i></a></td>
</tr>';
        }
        $output .= '
</tbody>
</table>';
        $carttotal = '   
<div class="ps-block__header">
<p>Subtotal <span>' . \Cart::getSubTotal() . '</span></p>
</div>
<h3>Total <span>$' . \Cart::getTotal() . '</span></h3>';
        $data = array(
            'cartpage'  => $output,
            'data' => $cart,
            'carttotal' => $carttotal,
        );


        echo json_encode($data);
    }

    public function singleproductremove(Request $request)
    {

        $product_id =   $request->product_id;
        \Cart::remove($product_id);
    }

    public function  cartupdate(Request $request)
    {
        $product_id =   $request->product_id;

        $product_quantity = $request->product_quantity;

        if ($product_quantity > 0) {
            \Cart::update($product_id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $product_quantity
                ),
            ));
        }
    }
}