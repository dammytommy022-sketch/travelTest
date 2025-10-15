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
                          <div class="row">
                              <div class="col-6">
                                  <h5>View Lounges</h5>
                              </div>
                            <div class="col-6 text-end">
                                <a href="{{route('admin.lounge')}}" >Back To Lounge</a>
                            </div>
                              
                          </div>
                       
                      
                        <div class="row">
                            <div class="col-xl">
                              <div class="card mb-4">
                                <div class="card-body">
                                  <form action="{{route('admin.postupdatelounge')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @foreach ($lounges as $lounge)
                                    <div class="row">
                                    <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-company">Lounge ID</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-buildings"></i>
                                          </span>
                                          <input type="text" name="id" id="basic-icon-default-company" value="{{ $lounge->id}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                          <input type="text" name="lounge_id" id="basic-icon-default-company" value="{{ $lounge->lounge_id}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-company">Brand Name</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-buildings"></i>
                                          </span>
                                          <input type="text" name="brand_name" id="basic-icon-default-company" value="{{ $lounge->brand_name}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                          </span>
                                          <input type="text" name="email" id="basic-icon-default-company" value="{{ $lounge->email}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Phone No.</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-phone"></i>
                                          </span>
                                          <input type="text" name="phone_no" id="basic-icon-default-company" value="{{ $lounge->phone_no}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-phone">Location</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text">
                                                <i class="bx bx-map"></i>
                                            </span>
                                            <select name="location" id="smallSelect" class="form-select ">
                                                
                                                <option value="Abuja" @if ($lounge->location == 'Abuja') selected @endif >Abuja</option>
                                                <option value="Lagos" @if ($lounge->location == 'Lagos') selected @endif >Lagos</option>
                                                <option value="Kano" @if ($lounge->location == 'Kano') selected @endif>Kano</option>
                                            
                                            </select>
                                        </div>
                                      </div>
                        
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-fullname">Airport</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text">
                                                <i class="bx bxs-plane-take-off"></i>
                                            </span>
                                            <select name="airport" id="smallSelect" class="form-select ">
                                                <option value="1" @if ($lounge->airport == '1') selected @endif>International</option>
                                                <option value="2" @if ($lounge->airport == '2') selected @endif>Local</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-company">Terminal</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-plane-land' ></i>
                                          </span>
                                          <input type="text" name="terminal" id="basic-icon-default-company" value="{{$lounge->terminal}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-message">Description</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-message2" class="input-group-text">
                                            <i class="bx bx-comment"></i>
                                          </span>
                                          <textarea name="description" id="basic-icon-default-message"   class="form-control" aria-describedby="basic-icon-default-message2">{{$lounge->description}}</textarea>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Given Price 1</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="given_PriceA" id="basic-icon-default-company" value="{{$lounge->given_PriceA}}"  class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Given Price 2</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="given_PriceB" id="basic-icon-default-company" value="{{$lounge->given_PriceB}}"  class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Given Price 3</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="given_PriceC" id="basic-icon-default-company" value="{{$lounge->given_PriceC}}"  class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Selling Price 1</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="priceA" id="basic-icon-default-company" value="{{$lounge->priceA}}"  class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Selling Price 2</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="priceB" id="basic-icon-default-company" value="{{$lounge->priceB}}"  class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Selling Price 3</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="priceC" id="basic-icon-default-company" value="{{$lounge->priceC}}"  class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 1</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities1" id="basic-icon-default-company" value="{{$lounge->facilities1}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 2</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities2" id="basic-icon-default-company" value="{{$lounge->facilities2}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 3</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities3" id="basic-icon-default-company" value="{{$lounge->facilities3}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 4</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities4" id="basic-icon-default-company" value="{{$lounge->facilities4}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 5</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities5" id="basic-icon-default-company" value="{{$lounge->facilities5}}" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Picture 1</label>
                                            <input class="form-control" name="pics1" type="file" id="formFile" /> 
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4"> 
                                        <label class="form-label" for="basic-icon-default-email">Picture 2</label>
                                            <input class="form-control" name="pics2" type="file" id="formFile" />
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Picture 3</label>
                                            <input class="form-control" name="pics3" type="file" id="formFile" />
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Picture 4</label>
                                            <input class="form-control" name="pics4" type="file" id="formFile" />
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Picture 5</label>
                                            <input class="form-control" name="pics5" type="file" id="formFile" />
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <div class="input-group input-group-merge">
                                          <button type="submit" class="btn btn-primary">Update Lounge</button>
                                          </div>
                                      </div>
                                    </div>
                                    @endforeach
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
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