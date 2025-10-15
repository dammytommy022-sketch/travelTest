<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wheel | Travel Insurance</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome-6/dist-font/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <style>
        .hidden {
        display: none;
        }
    </style>
    
</head>

<body>
    <!-- Navbar -->
    <section>
        @include('air.nav')
    </section>
    <!-- Navbar -->
    <main id="main" style="padding-top: 60px;">
        <section class="shadow-sm">
            <div class="container">
                <div class="row p-2 pt-5 ">
                    <div class="col-sm-12 p-3 ">
                    <div class="row">
                         <div class="col-xs-3 col-3 col-sm-2 col-lg-1">
                            <img src="../assets/img/ppi.png" class="image-fluid w-100" alt="protocol"> 
                         </div>
                         <div class="col-xs-12 col-12 col-sm-10 col-lg-7 protocol">
                             <h3>   Travel Insurance </h3>
                                <span class="text-muted">
                                   
                                Booking your Travel Insurance with us will give you a lot of benefits 
                                as our team and partners are always ready to follow up with your claim anytime.
                                </span>
                         </div>
                    </div>
                    </div>
                </div>
            
            <div class="row airport-form shadow p-4 mb-5">
                @if($dataform)
                <div class="col-sm-12 mb-3">
                    <div class="bg-light p-3 shadow-sm protocol" style="border-radius:15px;" > 
                        <h5 class="mb-0" style="color: rgba(13, 156, 83, 1);">Insurance Family Purchase </h5>
                        <div class="card-body bg-light">
                            <h5>  PRICING</h5>
                            
                        </div>
                    </div>
                </div>
                <form action="{{ url('/air/makeRequestPurchase')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="numberOfDuplicates" name="nop" value="{{$dataform['nop']}}" />
                    <div class="row">
                        <div class="hidden">
                            <div class="col-sm-12 group">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0" style="color: rgba(13, 156, 83, 1);">Customer Information</h6>
                                        <small class="text-muted float-end">
                                            Next Of Kin Details
                                        </small>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="fullname">Fullname</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-user"></i></span>
                                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Next of Kin Fullname"
                                                        aria-describedby="basic-icon-default-fullname2"/>
                                                    </div>
                                                </div>
                                            </div>        
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="service_date">Address</label>
                                                    <input class="form-control" type="text" name="address"  />
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label class="form-label" for="phone_no">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <span id="fullname" class="input-group-text"><i class="fa fa-phone"></i></span>
                                                        <input type="text" class="form-control" name="phone_no" id="phone_no" value=""  placeholder="Phone number"
                                                        aria-describedby="basic-icon-default-fullname2"/>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="mb-3"> 
                                                    <label class="form-label" for="relationship">Relationship</label>
                                                    <input class="form-control" type="text" name="relationship"  />
                                                    
                                                </div>
                                                
                                            </div>
                                        
                                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="duplicate-container"></div>
                       
                        
                        
                        
                        <div class="col-sm-12 text-end">
                                  <button type="submit" class="btn btn-pry">Purchase</button>
                       
                            </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
            
</section>

<!-- Move this script to the end of the Blade view or inside the <head> section -->
<script>
    function duplicateFormElements() {
        const numberOfDuplicates = parseInt(document.getElementById('numberOfDuplicates').value);

        if (isNaN(numberOfDuplicates) || numberOfDuplicates <= 0) {
            alert('Please enter a valid number greater than 0.');
            return;
        }

        const originalCard = document.querySelector('.group');
        const duplicateContainer = document.getElementById('duplicate-container');

        // Clear any existing duplicated cards
        duplicateContainer.innerHTML = '';

        for (let i = 1; i <= numberOfDuplicates; i++) {
            const newCard = originalCard.cloneNode(true);
            newCard.querySelector('h6').textContent = `Customer Information ${i}`; // Update the child number in the duplicated card
           
                // Update the attribute names for input and selection fields
            newCard.querySelectorAll('input').forEach(input => {
                    const currentName = input.getAttribute('name');
                    input.setAttribute('name', `${currentName}${i}`);
                });

                newCard.querySelectorAll('select').forEach(select => {
                    const currentName = select.getAttribute('name');
                    select.setAttribute('name', `${currentName}${i}`);
                });
           
            duplicateContainer.appendChild(newCard);
        }
    }

    // Automatically invoke the duplication function when the page loads
    window.addEventListener('load', duplicateFormElements);
</script>









<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    


    </main>
        @include('air.layout.footer')
</body>

</html>
