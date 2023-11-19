<div class="header">
    <div class="container">
        <nav
            class="navbar navbar-expand-lg navbar-light"
            style="background-color: #e3f2fd;"
        >
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <img
                        src="{{ asset('images/snappfood.JPG') }}"
                        alt="logo"
                        width="100"
                        height="100"
                    />
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <i class="fas fa-bars"></i>
                </button>


                <div id="header-buttons" class="d-flex align-items-center">
                    <a href="" class="btn btn-light"><i class="fas fa-home"></i>Dashboard</a>
                    <a href="{{ url()->previous() }}" class="btn btn-light"><i class="fa-solid fa-arrow-left"></i>Back</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul
                        class="navbar-nav ms-auto mb-2 mb-lg-0"
                        style="font-size: 20px;"
                    >
                        <li class="nav-item">
                            <a class="nav-link" href=""
                            ><i class="fas fa-circle text-success"></i>open/close</a>
{{--                            <i class="fas fa-times text-danger"></i>--}}
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                aria-current="page"
                                href=""
                            ><i class="fas fa-info-circle"></i>restaurant data</a
                            >
                        </li>
                    </ul>





                    <button id="toggleRestaurant" class="btn btn-light">
                        <i class="fas fa-circle text-success"></i>
                        <span id="restaurantStatusText">Open</span>
                    </button>


                </div>
            </div>
        </nav>
    </div>
</div>
