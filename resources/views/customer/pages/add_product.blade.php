@extends('customer.dashboard')
@section('maincontent')
<section class="ps-new-item">
    

    @if($subcategory->category_info->form_name =='social_media')
    <form name="myForm" class="ps-form ps-form--new-product" action="{{ route('customer.savesocialmedia') }}" onsubmit="return validate()" method="post"  enctype="multipart/form-data">
      @csrf
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>Social Media</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group form-group--select">
                                <label>Category Name</label>
                                <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>SubCategory Name </label>
                                <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            <div class="form-group">
                                <label>Social Media Name<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" required name="social_name" placeholder="Enter Social Media name..." />
                            </div>
                            <div class="form-group">
                                <label>Social Media Link<sup>Url Link</sup>
                                </label>
                               
                                <input id="social_link" class="form-control"  type="text" required  name="social_link"  placeholder="Enter your Social Media Url Link..." />
                             
                                <p id="text_message" style="text-align: center;" ></p>
                            </div>
                            <div class="form-group">
                                <label>Friends<sup>*</sup>
                                </label>
                                <input class="form-control" type="number"required name="friends" placeholder="Enter Friends.." />
                            </div>
                            <div class="form-group">
                                <label>Follows<sup>*</sup>
                                </label>
                                <input class="form-control" type="number"required name="followers" placeholder="Enter Followers.." />
                            </div>
                           
                           
                            
                        </div>
                    </figure>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>Social Media</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group">
                                <label>Social Media  icon/image</label>
                                <div class="form-group--nest">
                                    <input class=" mb-1" type="file" required name="image" placeholder="">
                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sell Price<sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="price"type="number" placeholder="" />
                            </div>
        
                            <div class="form-group">
                                <label>Description<sup>*</sup></label>
                                <textarea class="form-control" required rows="6" name="description"></textarea>
                            </div>
                            
                           
                        </div>
                    </figure>
                 
                   
                </div>
            </div>
        </div>
        <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
            <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>

            <button id="button" class="ps-btn" >Submit</button>
    

        </div>
    </form>
    @elseif($subcategory->category_info->form_name =='make_payment')
    <form class="ps-form ps-form--new-product" action="{{ route('customer.savemakepayment') }}" method="post">
        @csrf
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>Category</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group form-group--select">
                                <label>Category Name </label>
                                <input class="form-control" type="text" disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>SubCategory Name </label>
                                <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                        </div>
                    </figure>
                    <figure class="ps-block--form-box">
                        <figcaption>Send Information</figcaption>
                        <div class="form-group form-group--select">
                            <label>Currency</label>


                            {{-- <input class="form-control" type="text" required name="send_currency"  placeholder="Enter USD..." /> --}}
                            
                                      
                            <div class="form-group__content">
                                    <select class="ps-select" required title="Status" name="send_currency">
                                        <option value='' disabled selected>Select Send Currency</option>
                                        @foreach ($currency_list as $currency)
                                            <option value="{{ $currency->rates }}">{{ $currency->rates }}</option>
                                        @endforeach
                                        
                                        
                                    </select>
                                </div>

                        </div>
                        <div class="form-group form-group--select">
                            <label>Send Amount</label>
                            <input class="form-control" type="number" required name="send_amount"  placeholder="Enter currency..." />
                        </div>
                      
                        <div class="form-group form-group--select">
                            <label>A/C Wallet</label>
                            <input class="form-control" type="text" required name="send_wallet"  placeholder="Enter Wallet name..." />
                           
                        </div>
                        <div class="form-group form-group--select">
                            <label>Account No.</label>
                            <input class="form-control" type="text" required name="send_account"  placeholder="Enter Account..." />
                           
                        </div>
                    </figure>
                   
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>Get Information</figcaption>
                        <div class="form-group">
                            <label>Unit Price</label>
                            <div class="form-group--nest">
                                <input class="form-control mb-1" required type="number" value="1" min="1" name="unit_price" placeholder="">
                               
                            </div>
                        </div>
                        <div class="form-group form-group--select">
                            <label>Currency</label><sup>Unit price & Wallet</sup>
                            {{-- <input class="form-control" type="text" required name="get_currency"  placeholder="Enter Currency..." /> --}}
                            <div class="form-group__content">
                                <select class="ps-select" title="Status" required  name="get_currency">
                                    <option value='' disabled selected>SelectCurrency</option>
                                  
                                        <option value="USD">USD</option>
                                        <option value="BDT">BDT</option>
                                    
                                    
                                </select>
                            </div>

                            

                        </div>
                     
                        <div class="form-group form-group--select">
                            <label>A/C Wallet</label>
                            <input class="form-control" type="text" required name="get_wallet"  placeholder="Enter Wallet name..." />

                        </div>
                        <div class="form-group form-group--select">
                            <label>Account No.</label>
                            <input class="form-control" type="text" required name="get_account"  placeholder="Enter Account name..." />
                           
                        </div>
                    </figure>
                    
                    <figure class="ps-block--form-box">
                        <figcaption>Description</figcaption>
                        <div class="ps-block__content">
                           
                            
                            <div class="form-group">
                                <label>Description</label>
                                <div class="form-group--nest">
                                    <textarea class="form-control"required rows="6" name="description" placeholder="Enter product description..."></textarea>

                                   
                                </div>
                            </div>
                         

                        </div>
                    </figure>
                  

                   
                </div>
            </div>
        </div>
        <div class="ps-form__bottomd" style="text-align:center;"><a class="ps-btn ps-btn--black" href="products.html">Back</a>
            <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
            <button class="ps-btn">Submit</button>
        </div>
    </form>
    @elseif($subcategory->category_info->form_name =='influence_marketing')  
    <form class="ps-form ps-form--new-product" action="{{ route('customer.saveinfluence') }}" method="post">
        @csrf
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>Category</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group form-group--select">
                                <label>Category Name </label>
                                <input class="form-control" type="text" disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>SubCategory Name </label>
                                <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                        </div>
                    </figure>
                    <figure class="ps-block--form-box">
                        <figcaption></figcaption>
                        <div class="form-group form-group--select">
                            <label>Social Name</label>
                            <input class="form-control" type="text" required name="social_name"  placeholder="Enter Social Name..." />
                        </div>
                        <div class="form-group form-group--select">
                            <label>Social Link</label>
                            <input class="form-control" type="text" required name="social_link"  placeholder="Enter Social Link..." />
                        </div>
                       
                        <div class="form-group form-group--select">
                            <label>Last Engagement</label>
                            <input class="form-control" type="text" required name="last_engagement"  placeholder="Enter Last Engagement..." />
                           
                        </div>
                        <div class="form-group form-group--select">
                            <label>Social Type</label>
                            <input class="form-control" type="text" required name="social_type"  placeholder="Enter social type..." />
                           
                        </div>
                    </figure>
                   
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption></figcaption>
                        <div class="form-group">
                            <label>Hire Time</label>
                            <div class="form-group--nest">
                                <input class="form-control mb-1" required type="text" name="hiring_time" placeholder="Minimum 1 Day">
                               
                            </div>
                        </div>
                        <div class="form-group form-group--select">
                            <label>Country</label>
                            <input class="form-control" type="text" required name="country"  placeholder="Enter Country" />
                           
                        </div>
                     
                        <div class="form-group form-group--select">
                            <label>Price</label><sup>{{ Auth::user()->currency }}</sup>
                            <input class="form-control" type="number" required name="price"  placeholder="Enter price..." />
                           
                        </div>
                       
                    </figure>
                    
                    <figure class="ps-block--form-box">
                        <figcaption>Description</figcaption>
                        <div class="ps-block__content">
                           
                            
                            <div class="form-group">
                                <label>Description</label>
                                <div class="form-group--nest">
                                    <textarea class="form-control"required rows="6" name="description" placeholder="Enter  description..."></textarea>

                                   
                                </div>
                            </div>
                            <div class="form-group form-group--select">
                                <label>Publication Status
                                </label>
                                <div class="form-group__content">
                                    <select class="ps-select" title="Status" name="status">
                                        <option value="0">Now</option>
                                        <option value="0">Later</option>
                                     
                                    </select>
                                </div>
                            </div>

                        </div>
                    </figure>
                  

                   
                </div>
            </div>
        </div>
        <div class="ps-form__bottomd" style="text-align:center;"><a class="ps-btn ps-btn--black" href="products.html">Back</a>
            <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
            <button class="ps-btn">Submit</button>
        </div>
    </form>
    @elseif($subcategory->category_info->form_name =='gift_card')
    <form class="ps-form ps-form--new-product" action="{{ route('customer.savegiftcard') }}" method="post"  enctype="multipart/form-data">
      @csrf
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group form-group--select">
                                <label>Category Name</label>
                                <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>SubCategory Name </label>
                                <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            <div class="form-group">
                                <label>Name<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" required name="name" placeholder="Enter card name..." />
                            </div>
                            <div class="form-group">
                                <label>Sell Price unit <sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="price"type="text" placeholder="" />
                            </div>
        
 
                        </div>
                    </figure>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                        <div class="ps-block__content">
                          
                            <div class="form-group">
                                <label>Ouantity
                                </label>
                                <input class="form-control"required name="qty"type="number" placeholder="" />
                            </div>
        
                            <div class="form-group">
                                <label>Description<sup>*</sup></label>
                                <textarea class="form-control" required rows="6" name="description"></textarea>
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>Publication status</label>
                                <div class="form-group__content">
                                    <select  class="ps-select" title="Parent" name="status">
                                        <option value="0">Now</option>
                                        <option value="0" >Later</option>
                            
                                    </select>
                                </div>
                            </div>
                        </div>
                    </figure>
                 
                   
                </div>
            </div>
        </div>
        <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
            <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
            <button class="ps-btn">Submit</button>
        </div>
    </form>
    @elseif($subcategory->category_info->form_name =='subscription')
    <form class="ps-form ps-form--new-product" action="{{ route('customer.savesubscription') }}" method="post"  enctype="multipart/form-data">
      @csrf
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group form-group--select">
                                <label>Category Name</label>
                                <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>SubCategory Name </label>
                                <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            <div class="form-group">
                                <label>Name<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" required name="name" placeholder="Enter card name..." />
                            </div>
                            <div class="form-group">
                                <label>Sell Price unit <sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="price"type="number" placeholder="" />
                            </div>
        
 
                        </div>
                    </figure>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                        <div class="ps-block__content">
                          
                            <div class="form-group">
                                <label>Ouantity
                                </label>
                                <input class="form-control"required name="qty"type="number" placeholder="" />
                            </div>
        
                            <div class="form-group">
                                <label>Description<sup>*</sup></label>
                                <textarea class="form-control" required rows="6" name="description"></textarea>
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>Publication status</label>
                                <div class="form-group__content">
                                    <select  class="ps-select" title="Parent" name="status">
                                        <option value="0">Now</option>
                                        <option value="0" >Later</option>
                            
                                    </select>
                                </div>
                            </div>
                        </div>
                    </figure>
                 
                   
                </div>
            </div>
        </div>
        <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
            <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
            <button class="ps-btn">Submit</button>
        </div>
    </form>
    @elseif($subcategory->category_info->form_name =='digital_wallet')
    <form class="ps-form ps-form--new-product" action="{{ route('customer.savedigitalwallet') }}" method="post"  enctype="multipart/form-data">
      @csrf
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group form-group--select">
                                <label>Category Name</label>
                                <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            
                            <div class="form-group form-group--select">
                                <label>SubCategory Name </label>
                                <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                               
                            </div>
                            <div class="form-group">
                                <label>Account Name<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" required name="account_name" placeholder="Enter account name..." />
                            </div>
                            <div class="form-group">
                                <label>Country <sup>*</sup>
                                </label>
                                <input class="form-control"required name="country"type="text" placeholder="Your Accounts Country " />
                            </div>
                            <div class="form-group">
                                <label>Opening  Year <sup></sup>
                                </label>
                                <input class="form-control"required name="opening_year"type="date" placeholder="" />
                            </div>
                           
                        </div>
                    </figure>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                        <div class="ps-block__content">
                      
                            <div class="form-group " >
                                <label>Available Balance <sup></sup>
                                </label>
                                <input class="form-control"required name="balance"type="number" value="0" placeholder="" />
                            </div>
                            <div class="form-group__content" >
                                <label>Stock Balance Currency</label>
                                <select  class="ps-select" title="Parent" name="account_currency">
                                    <option value="USD">USD</option>
                                    <option value="SGD" >SGD</option>
                        
                                </select>
                            </div>
                          
                             <div class="form-group form-group--select">
                                <label>Account Verified </label>
                                <div class="form-group__content">
                                    <select  class="ps-select" title="Parent" name="is_verified">
                                        <option value="1">Verified </option>
                                        <option value="0" >Unvarified </option>
                            
                                    </select>
                                </div>
                              </div>
                           
                            <div class="form-group">
                                <label>Sell Price <sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="price"type="text" placeholder="Price in {{ Auth::user()->currency }}" />
                            </div>
                            <div class="form-group">
                                <label>Description<sup>*</sup></label>
                                <textarea class="form-control" required rows="6" name="description"></textarea>
                            </div>
                            
                          
                        </div>
                    </figure>
                 
                   
                </div>
            </div>
        </div>
        <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
            <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
            <button class="ps-btn">Submit</button>
        </div>
    </form>
    @elseif($subcategory->category_info->form_name =='advertisement_account')
    <form class="ps-form ps-form--new-product" action="{{ route('customer.saveadvertisementaccount') }}" method="post"  enctype="multipart/form-data">
        @csrf
          <div class="ps-form__content">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                              <div class="form-group form-group--select">
                                  <label>Category Name</label>
                                  <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              
                              <div class="form-group form-group--select">
                                  <label>SubCategory Name </label>
                                  <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              <div class="form-group">
                                  <label>Account Name<sup>*</sup>
                                  </label>
                                  <input class="form-control" type="text" required name="account_name" placeholder="Enter account name..." />
                              </div>
                              <div class="form-group">
                                  <label>Country <sup>*</sup>
                                  </label>
                                  <input class="form-control"required name="country"type="text" placeholder="Your Accounts Country " />
                              </div>
                              <div class="form-group">
                                  <label>Opening  Year <sup></sup>
                                  </label>
                                  <input class="form-control"required name="opening_year"type="date" placeholder="" />
                              </div>
                            
   
                          </div>
                      </figure>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                            <div class="form-group">
                                <label>Available Balance <sup></sup>
                                </label>
                                <input class="form-control"required name="balance"type="number" value="0"placeholder="" />
                            </div>
                            <div class="form-group__content" >
                                <label>Stock Balance Currency</label>
                                <select  class="ps-select" title="Parent" name="account_currency">
                                    <option value="USD">USD</option>
                                    <option value="SGD" >SGD</option>
                        
                                </select>
                            </div>
                            <div class="form-group form-group--select">
                                <label>Account Verified </label>
                                <div class="form-group__content">
                                    <select  class="ps-select" title="Parent" name="is_verified">
                                        <option value="1">Verified </option>
                                
                            
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                  <label>Sell Price <sup>{{ Auth::user()->currency }}</sup>
                                  </label>
                                  <input class="form-control"required name="price"type="number" placeholder="Price in {{ Auth::user()->currency }}" />
                              </div>
                              <div class="form-group">
                                  <label>Description<sup>*</sup></label>
                                  <textarea class="form-control" required rows="6" name="description"></textarea>
                              </div>
                              
                            
                          </div>
                      </figure>
                   
                     
                  </div>
              </div>
          </div>
          <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
              <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
              <button class="ps-btn">Submit</button>
          </div>
      </form>
    @elseif($subcategory->category_info->form_name =='social_media_promotion')
      <form class="ps-form ps-form--new-product" action="{{ route('customer.savesocialmediapromotion') }}" method="post"  enctype="multipart/form-data">
        @csrf
          <div class="ps-form__content">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                              <div class="form-group form-group--select">
                                  <label>Category Name</label>
                                  <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              
                              <div class="form-group form-group--select">
                                  <label>SubCategory Name </label>
                                  <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              <div class="form-group">
                                  <label>Product Name<sup>*</sup>
                                  </label>
                                  <input class="form-control" type="text" required name="product_name" placeholder="Enter product name..." />
                              </div>
                              <div class="form-group">
                                  <label>Follower/Subscribers Views <sup>*</sup>
                                  </label>
                                  <input class="form-control"required name="follower_subscriber"type="text" placeholder="100 k " />
                              </div>
                              <div class="form-group">
                                <label>Sell Unit Price <sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="unit_price"type="text" placeholder="300  {{ Auth::user()->currency }}" />
                            </div>
                             
                          </div>
                      </figure>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                        

                             
                              <div class="form-group">
                                <label> Total Follower/Subscribers Views <sup>*</sup>
                                </label>
                                <input class="form-control"required name="total_follower_subscriber"type="text" placeholder="11m " />
                              </div>
                              <div class="form-group">
                                  <label>Description<sup>*</sup></label>
                                  <textarea class="form-control" required rows="6" name="description"></textarea>
                              </div>
                              
                            
                          </div>
                      </figure>
                   
                     
                  </div>
              </div>
          </div>
          <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
              <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
              <button class="ps-btn">Submit</button>
          </div>
      </form>
      @elseif($subcategory->category_info->form_name =='top_up_apps')
      <form class="ps-form ps-form--new-product" action="{{ route('customer.savetopupapps') }}" method="post"  enctype="multipart/form-data">
        @csrf
          <div class="ps-form__content">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                              <div class="form-group form-group--select">
                                  <label>Category Name</label>
                                  <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              
                              <div class="form-group form-group--select">
                                  <label>SubCategory Name </label>
                                  <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              <div class="form-group">
                                  <label>Product Name<sup>*</sup>
                                  </label>
                                  <input class="form-control" type="text" required name="product_name" placeholder="Enter product name..." />
                              </div>
                              <div class="form-group">
                                  <label>Diamonds/UC/Gems/Coin/Top Up <sup>*</sup>
                                  </label>
                                  <input class="form-control"required name="top_up"type="text" placeholder="100 k " />
                              </div>
                              <div class="form-group">
                                <label>Sell Unit Price <sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="unit_price"type="text" placeholder="300  {{ Auth::user()->currency }}" />
                            </div>
                             
                          </div>
                      </figure>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                        

                             
                              <div class="form-group">
                                <label> Total Diamonds/UC/Gems/Coin/Top UP<sup>*</sup>
                                </label>
                                <input class="form-control"required name="total_top_up"type="text" placeholder="11m " />
                              </div>
                              <div class="form-group">
                                  <label>Description<sup>*</sup></label>
                                  <textarea class="form-control" required rows="6" name="description"></textarea>
                              </div>
                              
                            
                          </div>
                      </figure>
                   
                     
                  </div>
              </div>
          </div>
          <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
              <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
              <button class="ps-btn">Submit</button>
          </div>
      </form>
      @elseif($subcategory->category_info->form_name =='games_zone')
      <form class="ps-form ps-form--new-product" action="{{ route('customer.savegameszone') }}" method="post"  enctype="multipart/form-data">
        @csrf
          <div class="ps-form__content">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                              <div class="form-group form-group--select">
                                  <label>Category Name</label>
                                  <input class="form-control" type="text"  disabled value="{{ $subcategory->category_info->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="category_id" value="{{ $subcategory->category_info->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              
                              <div class="form-group form-group--select">
                                  <label>SubCategory Name </label>
                                  <input class="form-control" type="text"disabled value="{{ $subcategory->name }}" placeholder="Enter product name..." />
                                  <input class="form-control" type="hidden" name="subcategory_id" value="{{ $subcategory->id }}" placeholder="Enter product name..." />
                                 
                              </div>
                              <div class="form-group">
                                  <label>Product Name<sup>*</sup>
                                  </label>
                                  <input class="form-control" type="text" required name="product_name" placeholder="Enter product name..." />
                              </div>
                              <div class="form-group">
                                  <label>Diamonds/UC/Gems/Coin <sup>*</sup>
                                  </label>
                                  <input class="form-control"required name="diamonds"type="text" placeholder="100 k " />
                              </div>
                              <div class="form-group">
                                <label>Sell Unit Price <sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="unit_price"type="text" placeholder="300  {{ Auth::user()->currency }}" />
                            </div>
                             
                          </div>
                      </figure>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $subcategory->category_info->name }}</figcaption>
                          <div class="ps-block__content">
                        

                             
                              <div class="form-group">
                                <label> Total Diamonds/UC/Gems/Coin<sup>*</sup>
                                </label>
                                <input class="form-control"required name="total_diamonds"type="text" placeholder="11m " />
                              </div>
                              <div class="form-group">
                                  <label>Description<sup>*</sup></label>
                                  <textarea class="form-control" required rows="6" name="description"></textarea>
                              </div>
                              
                            
                          </div>
                      </figure>
                   
                     
                  </div>
              </div>
          </div>
          <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="{{ route('customer.product',$subcategory->category_info->form_name) }}">Back</a>
              <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
              <button class="ps-btn">Submit</button>
          </div>
      </form>
      @else   
     <form class="ps-form ps-form--new-product" action="index.html" method="get">
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>General</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group">
                                <label>Product Name<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" placeholder="Enter product name..." />
                            </div>
                            <div class="form-group">
                                <label>Reference<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" placeholder="Enter product Reference..." />
                            </div>
                            <div class="form-group">
                                <label>Product Summary<sup>*</sup>
                                </label>
                                <textarea class="form-control" rows="6" placeholder="Enter product description..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Regular Price<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label>Sale Price<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label>Sale Quantity<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label>Sold Items<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label>Product Description<sup>*</sup></label>
                                <textarea id="summernote" rows="6" name="editordata"></textarea>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>Product Images</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group">
                                <label>Product Thumbnail</label>
                                <div class="form-group--nest">
                                    <input class="form-control mb-1" type="text" placeholder="">
                                    <button class="ps-btn ps-btn--sm">Choose</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Product Gallery</label>
                                <div class="form-group--nest">
                                    <input class="form-control mb-1" type="text" placeholder="">
                                    <button class="ps-btn ps-btn--sm">Choose</button>
                                </div>
                            </div>
                            <div class="form-group form-group--nest">
                                <input class="form-control mb-1" type="text" placeholder="">
                                <button class="ps-btn ps-btn--sm">Choose</button>
                            </div>
                            <div class="form-group">
                                <label>Video (optional)
                                </label>
                                <input class="form-control" type="text" placeholder="Enter video URL" />
                            </div>
                        </div>
                    </figure>
                    <figure class="ps-block--form-box">
                        <figcaption>Inventory</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group">
                                <label>SKU<sup>*</sup>
                                </label>
                                <input class="form-control" type="text" placeholder="" />
                            </div>
                            <div class="form-group form-group--select">
                                <label>Status
                                </label>
                                <div class="form-group__content">
                                    <select class="ps-select" title="Status">
                                        <option value="1">Status 1</option>
                                        <option value="2">Status 2</option>
                                        <option value="3">Status 3</option>
                                        <option value="4">Status 4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </figure>
                    <figure class="ps-block--form-box">
                        <figcaption>Meta</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group form-group--select">
                                <label>Brand
                                </label>
                                <div class="form-group__content">
                                    <select class="ps-select" title="Brand">
                                        <option value="1">Brand 1</option>
                                        <option value="2">Brand 2</option>
                                        <option value="3">Brand 3</option>
                                        <option value="4">Brand 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tags
                                </label>
                                <input class="form-control" type="text" />
                            </div>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
        <div class="ps-form__bottom"><a class="ps-btn ps-btn--black" href="products.html">Back</a>
            <button class="ps-btn ps-btn--gray">Cancel</button>
            <button class="ps-btn">Submit</button>
        </div>
    </form>
   @endif
</section>



<script>  

    $(document).ready(function(){


$("#social_link").keyup(function(){
    //  console.log($(this).val())
  var key=$(this).val();
          $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "POST",
          url: "{{ route('validate_product') }}",
          data:'social_link='+$(this).val(),
          dataType:"json",
          success: function(data){
        //  console.log(data.validate)
        if(data.message == true){
          $("#text_message").show();
          $("#text_message").html(data.validate);
          $("#text_message").css("color", "red"); 
          $("#button").hide();
        }else{
        $("#text_message").html(data.validate);
        $("#text_message").css("color", "green");
        $("#button").show();
        }      
          }
      }); 
      });  

     


    });


</script>


@endsection