<head>
    <style>
         @media (max-width: 540px) {
            .topnav {
                display: none;
            }           
        }
        @media (max-width: 540px) {
            .navtop {
                display: none;
            }           
        }
        
    </style>
</head>
<div class="container-fluid bg-pry p-0 fixed-top pt-1 pb-2">
    <div class="row gx-0  ">
        <div class="col-sm-6 px-5 text-start ">
            <div class="h-70 d-inline-flex align-items-center py-2 me-4 footer">
                <small class="me-2"><i class="fa fa-phone text-white"></i></small>
                <small><b class="text-white">+234 813 456 7890</b></small>
            </div>
             
        </div>
        <div class="col-sm-6 px-5 text-end navtop">
            <div class="h-70 d-inline-flex align-items-center py-2 me-4">
                <a class="me-2 topnav" href="{{route('aboutus')}}"><small class="me-3"><b class="text-white"> Company</b></small></a>
                <a class="me-2 topnav" href="{{route('faq')}}"><small class="me-3"><b class="text-white"> FAQ</b></small></a> 
                <a class="me-2 topnav" href="{{route('help')}}"><small class="me-3"><b class="text-white">Help</b></small></a>
                <small><b class="text-white topnav">|</b></small>
            </div>
            <div class="h-70 d-inline-flex align-items-center">
                <a class="me-2 topnav" href=""><i class="fa fa-facebook-f text-white"></i></a>
                <a class="me-2 topnav" href=""><i class="fa fa-twitter text-white" ></i></a>
                <a class="me-0 topnav" href=""><i class="fa fa-instagram text-white"></i></a>
            </div>
        </div>
    </div>
</div>