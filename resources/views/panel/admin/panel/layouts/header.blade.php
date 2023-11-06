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
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" >Logout</button>
                </form>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul
                        class="navbar-nav ms-auto mb-2 mb-lg-0"
                        style="font-size: 20px;"
                    >
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}"
                            ><i class="fas fa-home"></i> lllll </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                aria-current="page"
                                href="{{ route('category.create') }}"
                            ><i class="fas fa-plus"></i>فعلا همینطوری باشن</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
