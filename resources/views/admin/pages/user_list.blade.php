@extends('admin.dashboard')
@section('maincontent')
<section class="ps-infos-listing">
    <h2 style="text-align-last: center">User Information</h2>
    <hr>
    

   <div class="ps-section__content">
    <div class="table-responsive">
        <table class="table ps-table">
            <thead>
                <tr>
                    <th  style="background: #673ab7;color:white">ID</th>
                    <th  style="background: #673ab7;color:white">User Name</th>
                    {{-- <th  style="background: #673ab7;color:white">Image</th> --}}
                    <th  style="background: #673ab7;color:white">Email</th>
                    <th  style="background: #673ab7;color:white">Role</th>
                    <th  style="background: #673ab7;color:white">Country</th>
                    <th  style="background: #673ab7;color:white">State</th>
                    <th  style="background: #673ab7;color:white">Code</th>
                    <th  style="background: #673ab7;color:white">Currency</th>
                    <th  style="background: #673ab7;color:white">Phone</th>
                    <th  style="background: #673ab7;color:white">Address</th>
                    <th  style="background: #673ab7;color:white">Varifycode</th>
                    <th  style="background: #673ab7;color:white">Balance</th>
                    <th  style="background: #673ab7;color:white">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_list as $info)
                <tr>
                    <td>{{ $info->id }}</td>
                    <td>{{ $info->name }}</td>
{{--                   
                    <td><a href="{{ asset('profile_image') }}/{{ $info->image }}"> <img style="height: 50px;width: 54px;" src="{{ asset('profile_image') }}/{{ $info->image }}"></a></td>
                --}}
                    <td>{{ $info->email }}</td>
                    <td>@if($info->role=='admin')<b style="color:red">Admin</b>@else <b style="color:royalblue">Customer</b> @endif</td>
                    <td>
                        {{ $info->country }}
                    </td>
                    <td><span class="ps-badge success">{{ $info->state}}</span>
                    </td>
                    <td>{{ $info->country_code }}</td>
                    <td>
                        {{ $info->currency }}
                    </td> 
                    <td>
                        <strong>{{ $info->phone }}</strong>
                    </td>
                    <td>
                        {{ $info->address }}
                    </td>
                    <td>
                        {{ $info->verifycode }}
                    </td>
                    <td>{{ round($info->balance,2) }}</td>  
                    <td>
                        <div class="btn-group">
                            @if($info->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="">Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="" >Inactive</a>
                            </button>
                            @endif
                              </div>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    {{ $user_list->links() }}
</div>
</section>

@endsection