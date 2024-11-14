@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    {{-- <script>
        window.Echo.channel('seller')
            .listen('SellerRegistrationRequested', (e) => {
                if (confirm(`New seller registration: ${e.seller.store_name} (${e.seller.email}). Click OK to verify.`)) {
                    // Redirect to the verification page for the registered seller
                    window.location.href = `/admin/seller-approvals`;
                }
            });
    </script> --}}
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Dashboard</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">eCommerce</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <button type="button" class="btn btn-primary">Settings</button>
          <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
              href="javascript:;">Action</a>
            <a class="dropdown-item" href="javascript:;">Another action</a>
            <a class="dropdown-item" href="javascript:;">Something else here</a>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:;">Separated link</a>
          </div>
        </div>
      </div>
    </div>
    <!--end breadcrumb-->


    <div class="row">
      <div class="col-12 col-lg-4 col-xxl-4 d-flex">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="">
              <div class="d-flex align-items-center gap-2 mb-2">
                <h5 class="mb-0">Congratulations <span class="fw-600">Jhon</span></h5>
                <img src="{{asset('theme/admin/assets/images/apps/party-')}}popper.png" width="24" height="24" alt="">
              </div>
              <p class="mb-4">You are the best seller of this monnth</p>
              <div class="d-flex align-items-center justify-content-between">
                <div class="">
                  <h3 class="mb-0 text-indigo">$168.5K</h3>
                  <p class="mb-3">58% of sales target</p>
                  <button class="btn btn-grd btn-grd-primary rounded-5 border-0 px-4">View Details</button>
                </div>
                <img src="{{asset('theme/admin/assets/images/apps/gift-b')}}ox-3.png" width="100" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xxl-2 d-flex">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="mb-3 d-flex align-items-center justify-content-between">
              <div
                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary">
                <span class="material-icons-outlined fs-5">shopping_cart</span>
              </div>
              <div>
                <span class="text-success d-flex align-items-center">+24%<i
                    class="material-icons-outlined">expand_less</i></span>
              </div>
            </div>
            <div>
              <h4 class="mb-0">248k</h4>
              <p class="mb-3">Total Orders</p>
              <div id="chart1"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-4 col-xxl-2 d-flex">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="mb-3 d-flex align-items-center justify-content-between">
              <div
                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success">
                <span class="material-icons-outlined fs-5">attach_money</span>
              </div>
              <div>
                <span class="text-success d-flex align-items-center">+14%<i
                    class="material-icons-outlined">expand_less</i></span>
              </div>
            </div>
            <div>
              <h4 class="mb-0">$47.6k</h4>
              <p class="mb-3">Total Sales</p>
              <div id="chart2"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xxl-2 d-flex">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="mb-3 d-flex align-items-center justify-content-between">
              <div
                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10 text-info">
                <span class="material-icons-outlined fs-5">visibility</span>
              </div>
              <div>
                <span class="text-danger d-flex align-items-center">-35%<i
                    class="material-icons-outlined">expand_less</i></span>
              </div>
            </div>
            <div>
              <h4 class="mb-0">189K</h4>
              <p class="mb-3">Total Visits</p>
              <div id="chart3"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xxl-2 d-flex">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="mb-3 d-flex align-items-center justify-content-between">
              <div
                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning">
                <span class="material-icons-outlined fs-5">leaderboard</span>
              </div>
              <div>
                <span class="text-success d-flex align-items-center">+18%<i
                    class="material-icons-outlined">expand_less</i></span>
              </div>
            </div>
            <div>
              <h4 class="mb-0">24.6%</h4>
              <p class="mb-3">Bounce Rate</p>
              <div id="chart4"></div>
            </div>
          </div>
        </div>
      </div>

    </div><!--end row-->


    <div class="row">
      <div class="col-12 col-xl-4">
        <div class="card w-100 rounded-4">
          <div class="card-body">
            <div class="d-flex flex-column gap-3">
              <div class="d-flex align-items-start justify-content-between">
                <div class="">
                  <h5 class="mb-0">Order Status</h5>
                </div>
                <div class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <span class="material-icons-outlined fs-5">more_vert</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                  </ul>
                </div>
              </div>
              <div class="position-relative">
                <div class="piechart-legend">
                  <h2 class="mb-1">68%</h2>
                  <h6 class="mb-0">Total Sales</h6>
                </div>
                <div id="chart6"></div>
              </div>
              <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                  <p class="mb-0 d-flex align-items-center gap-2 w-25"><span
                      class="material-icons-outlined fs-6 text-primary">fiber_manual_record</span>Sales</p>
                  <div class="">
                    <p class="mb-0">68%</p>
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                  <p class="mb-0 d-flex align-items-center gap-2 w-25"><span
                      class="material-icons-outlined fs-6 text-danger">fiber_manual_record</span>Product</p>
                  <div class="">
                    <p class="mb-0">25%</p>
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                  <p class="mb-0 d-flex align-items-center gap-2 w-25"><span
                      class="material-icons-outlined fs-6 text-success">fiber_manual_record</span>Income</p>
                  <div class="">
                    <p class="mb-0">14%</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-8">
        <div class="card w-100 rounded-4">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <h5 class="mb-0">Sales & Views</h5>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div id="chart5"></div>
            <div
              class="d-flex flex-column flex-lg-row align-items-start justify-content-around border p-3 rounded-4 mt-3 gap-3">
              <div class="d-flex align-items-center gap-4">
                <div class="">
                  <p class="mb-0 data-attributes">
                    <span
                      data-peity='{ "fill": ["#2196f3", "rgb(255 255 255 / 12%)"], "innerRadius": 32, "radius": 40 }'>5/7</span>
                  </p>
                </div>
                <div class="">
                  <p class="mb-1 fs-6 fw-bold">Monthly</p>
                  <h2 class="mb-0">65,127</h2>
                  <p class="mb-0"><span class="text-success me-2 fw-medium">16.5%</span><span>55.21 USD</span></p>
                </div>
              </div>
              <div class="vr"></div>
              <div class="d-flex align-items-center gap-4">
                <div class="">
                  <p class="mb-0 data-attributes">
                    <span
                      data-peity='{ "fill": ["#ffd200", "rgb(255 255 255 / 12%)"], "innerRadius": 32, "radius": 40 }'>5/7</span>
                  </p>
                </div>
                <div class="">
                  <p class="mb-1 fs-6 fw-bold">Yearly</p>
                  <h2 class="mb-0">984,246</h2>
                  <p class="mb-0"><span class="text-success me-2 fw-medium">24.9%</span><span>267.35 USD</span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!--end row-->


    <div class="row">
      <div class="col-12 col-lg-6 col-xxl-4 d-flex">
        <div class="card w-100 rounded-4">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <h5 class="mb-0">Social Revenue</h5>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="mb-4">
              <div class="d-flex align-items-center gap-3">
                <h3 class="mb-0">48,569</h3>
                <p class="mb-0 text-success gap-3">27%<span class="material-icons-outlined fs-6">arrow_upward</span>
                </p>
              </div>
              <p class="mb-0 font-13">Last 1 Year Income</p>
            </div>
            <div class="table-responsive">
              <div class="d-flex flex-column gap-4">
                <div class="d-flex align-items-center gap-3">
                  <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{asset('theme/admin/assets/images/apps/17.png')}}" width="40" alt="">
                    <div>
                      <h6 class="mb-0">Facebook</h6>
                      <p class="mb-0">Social Media</p>
                    </div>
                  </div>
                  <h5 class="mb-0">45,689</h5>
                  <div class="card-lable bg-success text-success bg-opacity-10">
                    <p class="text-success mb-0">+28.5%</p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{asset('theme/admin/assets/images/apps/twitter-circle.png')}}" width="40" alt="">
                    <div>
                      <h6 class="mb-0">Twitter</h6>
                      <p class="mb-0">Social Media</p>
                    </div>
                  </div>
                  <h5 class="mb-0">34,248</h5>
                  <div class="card-lable bg-danger text-danger bg-opacity-10">
                    <p class="text-red mb-0">-14.5%</p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{asset('theme/admin/assets/images/apps/03.png')}}" width="40" alt="">
                    <div>
                      <h6 class="mb-0">Tik Tok</h6>
                      <p class="mb-0">Entertainment</p>
                    </div>
                  </div>
                  <h5 class="mb-0">45,689</h5>
                  <div class="card-lable bg-success text-success bg-opacity-10">
                    <p class="text-green mb-0">+28.5%</p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{asset('theme/admin/assets/images/apps/19.png')}}" width="40" alt="">
                    <div>
                      <h6 class="mb-0">Instagram</h6>
                      <p class="mb-0">Social Media</p>
                    </div>
                  </div>
                  <h5 class="mb-0">67,249</h5>
                  <div class="card-lable bg-danger text-danger bg-opacity-10">
                    <p class="text-red mb-0">-43.5%</p>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <div class="social-icon d-flex align-items-center gap-3 flex-grow-1">
                    <img src="{{asset('theme/admin/assets/images/apps/20.png')}}" width="40" alt="">
                    <div>
                      <h6 class="mb-0">Snapchat</h6>
                      <p class="mb-0">Conversation</p>
                    </div>
                  </div>
                  <h5 class="mb-0">89,178</h5>
                  <div class="card-lable bg-success text-success bg-opacity-10">
                    <p class="text-green mb-0">+24.7%</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xxl-4 d-flex">
        <div class="card w-100 rounded-4">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <h5 class="mb-0">Popular Products</h5>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="d-flex flex-column gap-4">
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/top-products/01.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Apple Hand Watch</h6>
                  <p class="mb-0">Sale: 258</p>
                </div>
                <div class="text-center">
                  <h6 class="mb-1">$199</h6>
                  <p class="mb-0 text-success font-13">+12%</p>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/top-products/02.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Mobile Phone Set</h6>
                  <p class="mb-0">Sale: 169</p>
                </div>
                <div class="text-center">
                  <h6 class="mb-1">$159</h6>
                  <p class="mb-0 text-success font-13">+14%</p>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/top-products/04.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Grey Shoes Pair</h6>
                  <p class="mb-0">Sale: 859</p>
                </div>
                <div class="">
                  <div class="text-center">
                    <h6 class="mb-1">$279</h6>
                    <p class="mb-0 text-danger font-13">-12%</p>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/top-products/05.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Blue Yoga Mat</h6>
                  <p class="mb-0">Sale: 328</p>
                </div>
                <div class="text-center">
                  <h6 class="mb-1">$389</h6>
                  <p class="mb-0 text-success font-13">+25%</p>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/top-products/06.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">White water Bottle</h6>
                  <p class="mb-0">Sale: 992</p>
                </div>
                <div class="text-center">
                  <h6 class="mb-1">$584</h6>
                  <p class="mb-0 text-danger font-13">-25%</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-12 col-xxl-4 d-flex">
        <div class="card w-100 rounded-4">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <h5 class="mb-0">Top Vendors</h5>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="d-flex flex-column gap-4">
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/avatars/01.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Ajay Sidhu</h6>
                  <p class="mb-0">Sale: 879</p>
                </div>
                <div class="ratings">
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/avatars/02.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Ajay Sidhu</h6>
                  <p class="mb-0">Sale: 879</p>
                </div>
                <div class="ratings">
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/avatars/03.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Ajay Sidhu</h6>
                  <p class="mb-0">Sale: 879</p>
                </div>
                <div class="ratings">
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/avatars/04.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Ajay Sidhu</h6>
                  <p class="mb-0">Sale: 879</p>
                </div>
                <div class="ratings">
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                </div>
              </div>
              <div class="d-flex align-items-center gap-3">
                <img src="{{asset('theme/admin/assets/images/avatars/08.png')}}" width="55" class="rounded-circle" alt="">
                <div class="flex-grow-1">
                  <h6 class="mb-0">Ajay Sidhu</h6>
                  <p class="mb-0">Sale: 879</p>
                </div>
                <div class="ratings">
                  <span class="material-icons-outlined text-warning fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                  <span class="material-icons-outlined fs-5">star</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!--end row-->


    <div class="row">
      <div class="col-12 col-xxl-6 d-flex">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <h5 class="mb-0">Transactions</h5>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-middle mb-0 table-striped">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Source Name</th>
                    <th>Status</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="">
                        <h6 class="mb-0">10 Sep,2024</h6>
                        <p class="mb-0">8:20 PM</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center flex-row gap-3">
                        <div class="">
                          <img src="{{asset('theme/admin/assets/images/apps/paypal.png')}}" width="35" alt="">
                        </div>
                        <div class="">
                          <h6 class="mb-0">Paypal</h6>
                          <p class="mb-0">Business Plan</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="card-lable bg-success text-success bg-opacity-10">
                        <p class="text-success mb-0">Paid</p>
                      </div>
                    </td>
                    <td>
                      <h5 class="mb-0">$5897</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="">
                        <h6 class="mb-0">10 Sep,2024</h6>
                        <p class="mb-0">8:20 PM</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center flex-row gap-3">
                        <div class="">
                          <img src="{{asset('theme/admin/assets/images/apps/13.png')}}" width="35" alt="">
                        </div>
                        <div class="">
                          <h6 class="mb-0">Visa</h6>
                          <p class="mb-0">Business Plan</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="card-lable bg-danger text-danger bg-opacity-10">
                        <p class="text-danger mb-0">Unpaid</p>
                      </div>
                    </td>
                    <td>
                      <h5 class="mb-0">$9638</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="">
                        <h6 class="mb-0">10 Sep,2024</h6>
                        <p class="mb-0">8:20 PM</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center flex-row gap-3">
                        <div class="">
                          <img src="{{asset('theme/admin/assets/images/apps/behance.png')}}" width="35" alt="">
                        </div>
                        <div class="">
                          <h6 class="mb-0">Behance</h6>
                          <p class="mb-0">Business Plan</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="card-lable bg-success text-success bg-opacity-10">
                        <p class="text-success mb-0">Paid</p>
                      </div>
                    </td>
                    <td>
                      <h5 class="mb-0">$9638</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="">
                        <h6 class="mb-0">10 Sep,2024</h6>
                        <p class="mb-0">8:20 PM</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center flex-row gap-3">
                        <div class="">
                          <img src="{{asset('theme/admin/assets/images/apps/07.png')}}" width="35" alt="">
                        </div>
                        <div class="">
                          <h6 class="mb-0">Spotify</h6>
                          <p class="mb-0">Business Plan</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="card-lable bg-success text-success bg-opacity-10">
                        <p class="text-success mb-0">Paid</p>
                      </div>
                    </td>
                    <td>
                      <h5 class="mb-0">$9638</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="">
                        <h6 class="mb-0">10 Sep,2024</h6>
                        <p class="mb-0">8:20 PM</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center flex-row gap-3">
                        <div class="">
                          <img src="{{asset('theme/admin/assets/images/apps/05.png')}}" width="35" alt="">
                        </div>
                        <div class="">
                          <h6 class="mb-0">Google</h6>
                          <p class="mb-0">Business Plan</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="card-lable bg-danger text-danger bg-opacity-10">
                        <p class="text-danger mb-0">Unpaid</p>
                      </div>
                    </td>
                    <td>
                      <h5 class="mb-0">$9638</h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="">
                        <h6 class="mb-0">10 Sep,2024</h6>
                        <p class="mb-0">8:20 PM</p>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center flex-row gap-3">
                        <div class="">
                          <img src="{{asset('theme/admin/assets/images/apps/apple.png')}}" width="35" alt="">
                        </div>
                        <div class="">
                          <h6 class="mb-0">Apple</h6>
                          <p class="mb-0">Business Plan</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="card-lable bg-success text-success bg-opacity-10">
                        <p class="text-success mb-0">Paid</p>
                      </div>
                    </td>
                    <td>
                      <h5 class="mb-0">$9638</h5>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xxl-3 d-flex flex-column">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div>
                <p class="mb-1">Messages</p>
                <h3 class="mb-0">986</h3>
              </div>
              <div class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-grd-danger">
                <span class="material-icons-outlined fs-5 text-white">shopping_cart</span>
              </div>
            </div>
            <div class="progress mb-0" style="height:6px;">
              <div class="progress-bar bg-grd-danger" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex align-items-center mt-3 gap-2">
              <div class="card-lable bg-success bg-opacity-10">
                <p class="text-success mb-0">+34.7%</p>
              </div>
              <p class="mb-0 font-13">from last month</p>
            </div>
          </div>
        </div>

        <div class="card rounded-4 w-100 d-none">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <div class="">
                  <p class="mb-2">Total Profit</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                  <h4 class="mb-0">$75,365</h4>
                  <div class="card-lable bg-danger bg-opacity-10">
                    <p class="text-danger mb-0">-26.9%</p>
                  </div>
                </div>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div id="chart7"></div>
          </div>
        </div>

        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <h5 class="mb-0">$15.7K</h5>
                <p class="mb-0">Total Profit</p>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="">
              <div id="chart9"></div>
            </div>
            <div class="text-center mt-3">
              <p class="mb-0"><span class="text-success me-1">12.5%</span> from last month</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xxl-3 d-flex">
        <div class="card rounded-4 w-100">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <div class="">
                <h5 class="mb-0">Monthly Budget</h5>
              </div>
              <div class="dropdown">
                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                  data-bs-toggle="dropdown">
                  <span class="material-icons-outlined fs-5">more_vert</span>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div>
            <div class="chart-container mb-2">
              <div id="chart8"></div>
            </div>
            <div class="text-center">
              <h3>$84,256</h3>
              <p class="mb-3">Vestibulum fermentum nisl id nulla ultricies convallis.</p>
              <button class="btn btn-grd btn-grd-info rounded-5 px-4">Increase Budget</button>
            </div>
          </div>
        </div>
      </div>
    </div><!--end row-->

  </div>
@endsection
