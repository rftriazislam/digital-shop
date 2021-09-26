@extends('customer.dashboard')
@section('maincontent')

 <section class="ps-dashboard ps-items-listing">
    <div class="ps-section__left">
@if($null=='false')
        <iframe type="text/html" width="400px" style="width:100%;" height="360px"
        src="{{ $youtube->youtube_embed_link }}"
        frameborder="0"></iframe>
@elseif($null=='true')
<iframe type="text/html" width="400px" style="width:100%;" height="360px"
src="{{ $youtube->youtube_embed_link }}"
frameborder="0"></iframe>
@endif

    </div>

    <div class="ps-section__right">
        <div class="table-responsive" style="width: 100%;height: 600px;overflow: scroll;">
            <table class="table ps-table">
            
                <tbody>
             
                    @foreach ($tutorial as $item)
                        
                  
                    <tr>
                        <td>
                            <a href="{{ url('/play-youtube') }}/{{ $item->id }}"> <img class="videoc"src="https://img.youtube.com/vi/{{ $item->youtube_id }}/default.jpg" alt="" ></a>
                        </td>
                        <td><h5><a href="{{ url('/play-youtube') }}/{{ $item->id }}"> {{ $item->youtube_title }}</a></h5></td>
                        <td><h3><a href="{{ url('/play-youtube') }}/{{ $item->id }}"> <span class="icon-next-circle"></span></a></h3></td>
                      

                       
                    </tr> 
                 
                     @endforeach
               
                  
                    
                    
                </tbody> 
        
            </table>
            
          
        </div>

    </div>

   

</section>
@endsection