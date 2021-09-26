
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
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tutorial as $item)
                        
                    
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><strong>{{ $item->youtube_title }}</strong></td>
                        <td><img  src="https://img.youtube.com/vi/{{ $item->youtube_id }}/default.jpg" style="width:60px;height:40px"></td>
                   
                
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" style=" color:white ;background-color:rgb(175, 21, 206)"
                                class="btn ">
                                <a style="color:white"
                                    href="{{url('/admin-youtube-status')}}/{{ $item->id }}">{{ $item->status==0? 'Unpulished':'Published'}}</a>
                               </button>
                                    <button type="button" style=" color:white ;background-color:aqua"
                                        class="btn "><a style="color:white"
                                            href="{{url('/admin-youtube-edit')}}/{{ $item->id  }}">
                                            Updated/Edit</a></button>


                                       <button type="button" style="color:white  ;background-color:red"
                                        class="btn "><a style="color:white"
                                            href="{{url('/admin.youtube.delete')}}/{{ $item->id  }}">
                                            Delete</a>
                                      </button>
                                </div>

                        </td>
                    </tr> 
                  @endforeach
                    
                </tbody> 
        
            </table>
            
          
        </div>

        {{ $tutorial->links() }}
         
      
    </div>

    <div class="ps-section__right">
       
        <form role="form" action="{{ route('update_tutorial') }}" method="post">
            <h4>Update</h4>
            @if(session('message'))
            <p style="color:red;" class="text-center">
                {{session('message')}}
            </p>
            @endif

            @csrf
                        <div class="card-body">
                            <div class="form-group">
                            <label for="exampleInputPassword1">Title Name</label>
                            <input type="text" class="form-control" required name="youtube_title"  value="{{ $youtube->youtube_title }}"
                                placeholder="Youtube Title">
                                <input type="hidden" class="form-control" required name="id"  value="{{ $youtube->id }}"
                                placeholder="Youtube Title">
                        </div>
           
                        <div class="form-group">
                            <label for="exampleInputPassword1">Youtube Url Link</label>
                            <input type="text" class="form-control"name="youtube_link" placeholder="Video URL / Playlist URL"
                                type="url" required value="{{ $youtube->youtube_link }}">
                        </div>
           
                <div class="ps-form__bottom">
                    <button class="ps-btn ps-btn--sumbit success">update Link</button>
                </div>
        </form>

<br>
<br>
        <iframe type="text/html" width="400"  height="360"
        src="{{ $youtube->youtube_embed_link }}"
        frameborder="0"></iframe>


    </div>
</section>


@endsection