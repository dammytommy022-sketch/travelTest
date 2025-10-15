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
                                <a href="{{route('admin.addlounge')}}" >+Add New Lounge</a>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr class="text-nowrap">
                                    <th>S/N</th>
                                    <th>View</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Location</th>
                                    <th>Airport</th>
                                    <th>Given Price A</th>
                                    <th>Given Price B</th>
                                    <th>Given Price C</th>
                                    <th>Selling Price A</th>
                                    <th>Selling Price B</th>
                                    <th>selling Price C</th>
                                    <th>Date Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $serial = 1 @endphp
                                    @foreach ($protocols as $protocol) 
                                    <tr>
                                        <td scope="row">{{ $serial++ }}</td>
                                        <td><a href="{{route('admin.viewprotocol', ['id' => $protocol->id])}}"><button class="btn btn-sm btn-primary">View</button></a></td>
                                        
                                    
                                    <td>{{$protocol->company}}</td>
                                    <td>{{$protocol->email}}</td>
                                    <td>{{$protocol->phone_no}}</td>
                                    <td>{{$protocol->location}}</td>
                                    <td>{{$protocol->airport}}</td>
                                    <td>{{$protocol->given_Price1}}</td>
                                    <td>{{$protocol->given_Price2}}</td>
                                    <td>{{$protocol->given_Price3}}</td>
                                    <td>{{$protocol->price1}}</td>
                                    <td>{{$protocol->price2}}</td>
                                    <td>{{$protocol->price3}}</td>
                                    <td>{{$protocol->created_at}}</td>


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