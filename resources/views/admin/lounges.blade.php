@include('admin.layouts.nav')
<!-- Content wrapper -->
<div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                        <h5>Airport Lounges</h5>
                        <div class="text-end">
                                <a href="" >+Add New Lounge</a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr class="text-nowrap">
                                    <th>S/N</th>
                                    <th>View</th>
                                    <th>Lounge ID</th>
                                    <th>Brand Name</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Location</th>
                                    <th>Airport</th>
                                    <th>Terminal</th>
                                    <th>Description</th>
                                    <th>Facilities1</th>
                                    <th>Facilities2</th>
                                    <th>Facilities3</th>
                                    <th>Facilities4</th>
                                    <th>Facilities5</th>
                                    <th>Given Price A</th>
                                    <th>Given Price B</th>
                                    <th>Given Price C</th>
                                    <th>Selling Price A</th>
                                    <th>Selling Price B</th>
                                    <th>selling Price C</th>
                                    <!-- <th>Pics 1</th>
                                    <th>Pics 2</th>
                                    <th>Pics 3</th>
                                    <th>Pics 4</th>
                                    <th>Pics 5</th> -->
                                    <th>Date Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $serial = 1 @endphp
                                    @foreach ($lounges as $lounge) 
                                    <tr>
                                        <td scope="row">{{ $serial++ }}</td>
                                        <td><a href="{{route('admin.viewlounge', ['id' => $lounge->id])}}"><button class="btn btn-sm btn-primary">View</button></a></td>
                                        
                                    <td>{{$lounge->lounge_id}}</td>
                                    <td>{{$lounge->brand_name}}</td>
                                    <td>{{$lounge->email}}</td>
                                    <td>{{$lounge->phone_no}}</td>
                                    <td>{{$lounge->location}}</td>
                                    <td>{{$lounge->airport}}</td>
                                    <td>{{$lounge->terminal}}</td>
                                    <td>{{$lounge->description}}</td>
                                    <td>{{$lounge->facilities1}}</td>
                                    <td>{{$lounge->facilities2}}</td>
                                    <td>{{$lounge->facilities3}}</td>
                                    <td>{{$lounge->facilities4}}</td>
                                    <td>{{$lounge->facilities5}}</td>
                                    <td>{{$lounge->given_PriceA}}</td>
                                    <td>{{$lounge->given_PriceB}}</td>
                                    <td>{{$lounge->given_PriceC}}</td>
                                    <td>{{$lounge->priceA}}</td>
                                    <td>{{$lounge->priceB}}</td>
                                    <td>{{$lounge->priceC}}</td>
                                    <!-- <td>{{$lounge->pics1}}</td>
                                    <td>{{$lounge->pics2}}</td>
                                    <td>{{$lounge->pics3}}</td>
                                    <td>{{$lounge->pics4}}</td>
                                    <td>{{$lounge->pics5}}</td> -->
                                    <td>{{$lounge->created_at}}</td>


                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>                  
                </div>
              </div>
                  <!-- </div>
                <div class="row"> -->
            </div>

            
          </div>
          <!-- / Content -->
    @include('admin.layouts.footer')