<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Payment</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{ asset('payment_app/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset('payment_app/css/style.css') }}">


        <style> 
		.img{
            height: 77px;
    width: 79px;
    float: left;
    margin: auto 31%;
        }
		
	    </style>
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<form>
                    {{-- <img class="img"src="{{ asset('payment_app/images/icon.png') }}"> --}}
					<h3>Payment </h3>

                    @if($message=='fail')
					<h4 style="color:red;text-align:center">Payment failed</h4>
					
					<button><a href="{{ url('/') }}" style="color: white" > Go Back  </a>
						<i class="zmdi zmdi-arrow-right"></i>
					</button>

@elseif($message=='success')
<h4 style="color:red;text-align:center">Payment Success</h4>
					
<button><a href="{{ url('/') }}" style="color: white" > Go Back  </a>
    <i class="zmdi zmdi-arrow-right"></i>
</button>
@endif

				</form>
			</div>
		</div>
		
	</body>
</html>