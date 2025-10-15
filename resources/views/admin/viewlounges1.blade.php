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
                       <h5>View Lounges</h5>
                        <div class="row">
                            <div class="col-xl">
                              <div class="card mb-4">
                                <div class="card-body">
                                  <form>
                                    <div class="row">
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Lounge ID</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class="bx bx-user"></i>
                                          </span>
                                          <input type="text" class="form-control" id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-company">Brand Name</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-buildings"></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Phone No.</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-phone">Location</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-phone2" class="input-group-text"
                                            ><i class="bx bx-map"></i
                                          ></span>
                                          <input
                                            type="text"
                                            id="basic-icon-default-phone"
                                            class="form-control phone-mask"
                                            placeholder="658 799 8941"
                                            aria-label="658 799 8941"
                                            aria-describedby="basic-icon-default-phone2"
                                          />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-fullname">Airport</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-fullname2" class="input-group-text">
                                          <i class='bx bxs-plane-take-off'></i>
                                          </span>
                                          <input type="text" class="form-control" id="basic-icon-default-fullname" aria-describedby="basic-icon-default-fullname2"/>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-company">Terminal</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-plane-land' ></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-6">
                                        <label class="form-label" for="basic-icon-default-message">Description</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-message2" class="input-group-text">
                                            <i class="bx bx-comment"></i>
                                          </span>
                                          <textarea id="basic-icon-default-message" class="form-control" aria-describedby="basic-icon-default-message2"></textarea>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Price 1</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Price 2</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Price 3</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-purchase-tag-alt' ></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 1</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 2</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 3</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 4</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Facilities 5</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bxs-building-house'></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-6">
                                        <label class="form-label" for="basic-icon-default-email">Picture 1</label>
                                        <div class="row">
                                          <div class="mb-3 col-7">
                                              <input class="form-control" type="file" id="formFile" />
                                          </div>
                                          <div class="col-5">
                                            <div class="input-group input-group-merge ">
                                              <button type="submit" class="btn btn-primary">Download</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-6">
                                        <label class="form-label" for="basic-icon-default-email">Picture 2</label>
                                        <div class="row">
                                          <div class="mb-3 col-7">
                                              <input class="form-control" type="file" id="formFile" />
                                          </div>
                                          <div class="col-5">
                                            <div class="input-group input-group-merge ">
                                              <button type="submit" class="btn btn-primary">Download</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-6">
                                        <label class="form-label" for="basic-icon-default-email">Picture 3</label>
                                        <div class="row">
                                          <div class="mb-3 col-7">
                                              <input class="form-control" type="file" id="formFile" />
                                          </div>
                                          <div class="col-5">
                                            <div class="input-group input-group-merge ">
                                              <button type="submit" class="btn btn-primary">Download</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-6">
                                        <label class="form-label" for="basic-icon-default-email">Picture 4</label>
                                        <div class="row">
                                          <div class="mb-3 col-7">
                                              <input class="form-control" type="file" id="formFile" />
                                          </div>
                                          <div class="col-5">
                                            <div class="input-group input-group-merge ">
                                              <button type="submit" class="btn btn-primary">Download</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-6">
                                        <label class="form-label" for="basic-icon-default-email">Picture 5</label>
                                        <div class="row">
                                          <div class="mb-3 col-7">
                                              <input class="form-control" type="file" id="formFile" />
                                          </div>
                                          <div class="col-5">
                                            <div class="input-group input-group-merge ">
                                              <button type="submit" class="btn btn-primary">Download</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">Date Created</label>
                                        <div class="input-group input-group-merge">
                                          <span id="basic-icon-default-company2" class="input-group-text">
                                          <i class='bx bx-calendar'></i>
                                          </span>
                                          <input type="text" id="basic-icon-default-company" class="form-control" aria-describedby="basic-icon-default-company2" />
                                        </div>
                                      </div>
                                      <div class="mb-3 col-sm-6 col-md-3">
                                        <label class="form-label" for="basic-icon-default-email">update Lounge</label>
                                        <div class="input-group input-group-merge">
                                          <button type="submit" class="btn btn-primary">Update Lounge</button>
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