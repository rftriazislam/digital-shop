@extends('admin.dashboard')
@section('maincontent')

<section class="ps-dashboard ps-items-listing">
    <div class="ps-section__left">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Form Name</th>
                        <th>Discount</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>title</th>
                        <th>Description</th>
                      
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($discount as $v_discount)
                    <tr>
                        <td>{{ $v_discount['id'] }}</td>
                        <td><strong>{{ $v_discount['form_name']}}</strong></td>
                        <td>{{ $v_discount['discount']}} %</td>
                        <td><strong>{{ $v_discount['product_id']}}</strong></td>
                        <td>{{ $v_discount['product_name']}} </td>
                        <td>{{ $v_discount['title']}} </td>
                        <td>{{ $v_discount['description']}}</td>

                      
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                          
                                    <button type="button" style=" color:white ;background-color:rgb(47, 15, 224)"
                                        class="btn "><a style="color:white"
                                            href="{{url('/admin-commission-set')}}/{{ $v_discount['id'] }}">
                                            Updated/Set</a>
                                        
                                    </button>
                                    <button type="button" style=" color:white ;background-color:rgb(247, 3, 3)"
                                    class="btn "><a style="color:white"
                                        href="{{url('/admin-commission-set')}}/{{ $v_discount['id'] }}">
                                        Off/delete</a>
                                    
                                </button>


                            </div>

                        </td>
                    </tr> 
                    @empty
                    <tr class='text-center' style="color:red">
                        <td colspan="12" style="text-align:center;">No available data</td>
                    </tr>
                    @endforelse
                  
                    
                    
                </tbody> 
        
            </table>
            
            {{-- {{$category_info->links()}} --}}
        </div>

     
         
      
    </div>
    @if($set=='add')
    <div class="ps-section__right">
        <form class="ps-form ps-form--new" role="form" method="post" action="{{route('admin.add_discount')}}"
        enctype="multipart/form-data">
                       @csrf

                            @if(session('message'))
                            <p style="color:rgb(255, 60, 0);" class="text-center">
                                {{session('message')}}
                            </p>
                            @endif
                            @foreach($errors->all() as $error)
                            <p style="color:red;" class="text-center">
                                {{$error}}
                            </p>
                            @endforeach

            <div class="ps-form__content">
                <h5>Add Discount</h5>
                <div class="form-group">
                    <label>Category<sup>*</sup>
                    </label>
                    <div class="form-group__content">
                        <select class="ps-select" required title="Status" name="form_name">
                            <option  value="">Select</option>
                            @foreach ($category as $item)
                            <option value="{{ $item->form_name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  
                </div>
                <div class="form-group">
                    <label>Product_id
                    </label>
                    <input class="form-control"  type="number" name="product_id"  placeholder="Enter product Id" />
                </div>
                <div class="form-group">
                    <label>Title
                    </label>
                    <input class="form-control"  type="text" name="title" placeholder="Enter title" />
                </div>
                <div class="form-group">
                    <label>Description
                    </label>
                    <input class="form-control"  type="text" name="description" placeholder="Enter Description" />
                </div>
                <div class="form-group">
                    <label>Discount
                    </label>
                    <input class="form-control"  type="number" name="discount" placeholder="Enter discount" />
                </div>
                
            </div>
            <div class="ps-form__bottom">
                <button class="ps-btn ps-btn--sumbit success">Add</button>
            </div>
        </form>
    </div>
    @elseif($set=='update')
    <div class="ps-section__right">
        <form class="ps-form ps-form--new" role="form" method="post" action="{{route('admin.discount_update')}}"
        enctype="multipart/form-data">
                       @csrf

                            @if(session('message'))
                            <p style="color:rgb(255, 60, 0);" class="text-center">
                                {{session('message')}}
                            </p>
                            @endif
                            @foreach($errors->all() as $error)
                            <p style="color:red;" class="text-center">
                                {{$error}}
                            </p>
                            @endforeach

            <div class="ps-form__content">
                <h5>Updated /Set</h5>
                <div class="form-group">
                    <label>Category Name<sup>*</sup>
                    </label>
                    <input class="form-control" disabled value="{{ $discount_edit->name}}" placeholder="Enter category name" />
                    <input class="form-control" name="category_id" required type="hidden" value="{{ $discount_edit->id}}" placeholder="Enter category name" />
                </div>
                <div class="form-group">
                    <label>Referral Commission
                    </label>
                    <input class="form-control"  type="number" name="refer_commission" value="{{ $discount_edit->refer_commission}}" placeholder="Enter category Image" />
                </div>
                <div class="form-group">
                    <label>Affiliate Commission
                    </label>
                    <input class="form-control"  type="number" name="affilate_commission" value="{{ $discount_edit->affilate_commission}}" placeholder="Enter category Image" />
                </div>
                <div class="form-group">
                    <label>Company Commission
                    </label>
                    <input class="form-control"  type="number" name="company_commission" value="{{ $discount_edit->company_commission}}" placeholder="Enter category Image" />
                </div>
                
            </div>
            <div class="ps-form__bottom">
                <button class="ps-btn ps-btn--gray" ><a href="{{ route('admin.commission') }}">Cancel </a></button>
                <button class="ps-btn ps-btn--sumbit success">Update</button>
            </div>
        </form>
    </div>
    @endif
</section>
@endsection
