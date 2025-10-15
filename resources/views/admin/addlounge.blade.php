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
                                  <h5>Add New Lounge</h5>
                              </div>
                            <div class="col-6 text-end">
                                <a href="" >Back To Lounges</a>
                            </div>
                              
                          </div>
                        <div class="row">
                            <div class="col-xl">
                              <div class="card mb-4">
                                <div class="card-body">
                                  <form action="" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-company">Brand Name</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-buildings"></i>
                                          </span>
                                          <input type="text" name="brand_name" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                          </span>
                                          <input type="text" name="email" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Phone No.</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-phone"></i>
                                          </span>
                                          <input type="text" name="phone_no" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-phone">Location</label>
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text">
                                                <i class="bx bx-map"></i>
                                            </span>
                                            <select name="location" id="smallSelect" class="form-select ">
                                                <option value="Abuja">Abuja</option>
                                                <option value="Lagos">Lagos</option>
                                                <option value="Kano">Kano</option>
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
                                                <option value="1">International</option>
                                                <option value="2">Local</option>
                                            </select>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-company">Terminal</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-plane-land' ></i>
                                          </span>
                                          <input type="text" name="terminal" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-message">Description</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-message2" class="input-group-text">
                                            <i class="bx bx-comment"></i>
                                          </span>
                                          <textarea name="description" id="basic-icon-default-message" class="form-control" aria-describedby="basic-icon-default-message2"></textarea>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Given Price - Adult</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="given_PriceA" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Given Price - Child</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="given_PriceB" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Given Price - Infant</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="given_PriceC" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Selling Price - Adult</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="price1" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Selling Price - Child</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="price2" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Selling Price - Infant</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" name="price3" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 1</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities1" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 2</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities2" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 3</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities3" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 4</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities4" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-4">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 5</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" name="facilities5" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
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
                                          <button type="submit" class="btn btn-primary">Create Lounge</button>
                                          </div>
                                      </div>
                                    </div>
                                    
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