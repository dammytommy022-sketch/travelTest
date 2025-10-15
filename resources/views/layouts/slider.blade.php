<style>
    .img-W{
        width: 40px;
    }
   
    @media only screen and (max-width: 600px) {
        .proTab{
            display:none;
        }
    }
    .slides{
       padding-top: 100px;
    }
    
</style>
<section class="container-fluid p-0 m-0">

    <div style="margin: 10px; background-image: url('{{ asset('assets/image/slide.jpg') }}');">
    
        <div class=" mb-0 pb-0 slides">
            @include('layouts.flight_widget2')
        </div> 
    </div>
       
  
</section>
