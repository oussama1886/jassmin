<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            @if(isset($cat))
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <div class="nav-item dropdown">


                    </div>

                @foreach ($categories as $c )
                   <a href="/product/{{ $c->id }}/list1" class="nav-item nav-link">{{ $c->name }}</a>
                @endforeach
                @endif
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <!-- Content goes here -->
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <!-- Content goes here -->
                    </div>
                    <div class="col-xl-4 col-lg-4">

                    </div>
                </div>

                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Jasmin</span>Shop</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">

                    </div>
                    <div class="col-lg-5 col-3" style="margin-top: -80px; margin-right: -420px; margin-left:0px;">
                        <div class=" text-left">



                    @auth
                    <div class="btn border">
                        <a  href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sign out</a>
                          <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='fas fa-sign-out-alt' style='color:#f38d39'></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @else
                <div class="col-lg-1 col-2" style="margin-top: 0px; margin-right: -420px; margin-left:-100px; display: flex; align-items: center;">
                    <a href="/login" class="btn border nav-item nav-link" style="margin-right: 10px;">Login</a>
                    <a href="/register" class="btn border nav-item nav-link">Register</a>
                </div>

                @endauth
                </div>

        </div>

                </div>
            </nav>
              <!-- Page Header Start -->
              @if(isset($cat))
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">

            <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $cat->name }}</h1>

            <div class="d-inline-flex">
                <p class="m-0"><a href="http://jasminshop.test">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    @else
    <h1 class="font-weight-semi-bold text-uppercase mb-3"></h1>
    @endif
    <!-- Page Header End -->
        </div>
    </div>
</div>
