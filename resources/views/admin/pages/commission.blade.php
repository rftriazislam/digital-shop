@extends('admin.dashboard')
@section('maincontent')

<section class="ps-dashboard ps-items-listing">
    <div class="ps-section__left">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Refer_com</th>
                        <th>Affiliate_com</th>
                        <th>Company_com</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category_info as $v_category)
                    <tr>
                        <td>{{ $v_category->id }}</td>
                        <td><strong>{{ $v_category->name}}</strong></td>
                        <td>{{ $v_category->refer_commission}} %</td>
                        <td>{{ $v_category->affilate_commission}} %</td>
                        <td>{{ $v_category->company_commission}} %</td>

                      
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                          
                                    <button type="button" style=" color:white ;background-color:rgb(47, 15, 224)"
                                        class="btn "><a style="color:white"
                                            href="{{url('/admin-commission-set')}}/{{$v_category->id}}">
                                            Updated/Set</a>
                                        
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
            
            {{$category_info->links()}}
        </div>

     
         
      
    </div>
    @if($set)
    <div class="ps-section__right">
        <form class="ps-form ps-form--new" role="form" method="post" action="{{route('admin.commissionupdated')}}"
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
                    <input class="form-control" disabled value="{{ $category_edit->name}}" placeholder="Enter category name" />
                    <input class="form-control" name="category_id" required type="hidden" value="{{ $category_edit->id}}" placeholder="Enter category name" />
                </div>
                <div class="form-group">
                    <label>Referral Commission
                    </label>
                    <input class="form-control"  type="number" name="refer_commission" value="{{ $category_edit->refer_commission}}" placeholder="Enter category Image" />
                </div>
                <div class="form-group">
                    <label>Affiliate Commission
                    </label>
                    <input class="form-control"  type="number" name="affilate_commission" value="{{ $category_edit->affilate_commission}}" placeholder="Enter category Image" />
                </div>
                <div class="form-group">
                    <label>Company Commission
                    </label>
                    <input class="form-control"  type="number" name="company_commission" value="{{ $category_edit->company_commission}}" placeholder="Enter category Image" />
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
