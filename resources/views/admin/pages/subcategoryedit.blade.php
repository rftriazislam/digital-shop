@extends('admin.dashboard')
@section('maincontent')

<section class="ps-dashboard ps-items-listing">
    <div class="ps-section__left">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Image</th>
                        <th>Publication status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subcategory_info as $v_subcategory)
                    <tr>
                        <td>{{ $v_subcategory->id }}</td>
                        <td><strong>{{ $v_subcategory->category_info->name}}</strong></td>

                        <td><strong>{{ $v_subcategory->name}}</strong></td>
                        <td><img  src="{{ asset('back_end/subcategory_images') }}/{{ $v_subcategory->image }}" style="width:60px;height:40px"></td>
                        <td>  
                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                                         
                               @if($v_subcategory->status==0)
                                <button type="button" style=" color:white ;background-color:red"
                                    class="btn ">
                                    <a style="color:white"
                                        href="{{url('/admin-sub-category-status')}}/{{$v_subcategory->status}}/{{$v_subcategory->id}}">Unpulished</a>
                                </button>
                                @else
                                <button type="button" style=" color:white ;background-color:green"
                                    class="btn ">
                                    <a style="color:white"
                                        href="{{url('/admin-sub-category-status')}}/{{$v_subcategory->status}}/{{$v_subcategory->id}}">Pulished</a>
                                </button>
                                @endif
                              
                            </div>
                           </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                          
                                    <button type="button" style=" color:white ;background-color:aqua"
                                        class="btn "><a style="color:white"
                                            href="{{url('/admin-sub-category-edit')}}/{{$v_subcategory->id}}">
                                            Updated/Edit</a></button>
                                    <button type="button" style="color:white  ;background-color:red"
                                        class="btn "><a style="color:white"
                                            href="{{url('/admin-sub-category-delete')}}/{{$v_subcategory->id}}">
                                            Delete</a></button>
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
            
            {{$subcategory_info->links()}}
        </div>

     
         
      
    </div>

    <div class="ps-section__right">
        <form class="ps-form ps-form--new" role="form" method="post" action="{{route('admin.subcategoryupdated')}}"
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
                <div class="form-group form-group--select">
                    <label>Category Name</label>
                    <div class="form-group__content">
                        <select class="ps-select" title="Parent" name="category_id">
                            @foreach ($category_info as $v_key)
                        
                            <option value="{{ $v_key->id }}"   {{$v_key->id == $subcategory_edit->category_id ? 'selected' : '' }}>{{ $v_key->name }}</option>

                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label>Subcategory Name<sup>*</sup>
                    </label>
                    <input class="form-control" name="name" value="{{ $subcategory_edit->name }}" required type="text" placeholder="Enter subcategory name" />
                    <input class="form-control" name="subcategory_id" value="{{ $subcategory_edit->id}}" required type="hidden" placeholder="Enter subcategory name" />
              
                </div>
                

                <div class="form-group">
                    <label>Image<sup>(Optional)</sup>
                    </label>
                    <input  type="file" name="image" value="{{ $subcategory_edit->image }}"  placeholder="Enter subcategory Image" />
                </div>
                
            </div>

            <div class="ps-form__bottom">
                <button class="ps-btn ps-btn--gray" ><a href="{{ route('admin.category') }}">Cancel </a></button>
                <button class="ps-btn ps-btn--sumbit success">Update</button>
            </div>
        </form>
    </div>
</section>
@endsection
