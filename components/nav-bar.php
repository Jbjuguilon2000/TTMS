<nav class="navbar navbar-expand-lg bg-white border-bottom border-body sticky-top" data-bs-theme="white">
    <div class="container container-fluid">
        <img src="./Assets/logos/DOTr-MRT3_landscape(d).png" class="logo" alt="DOTr-MRT3">
        <a class="navbar-brand" href="index.php">TTMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button class="btn btn-link rounded-0 nav-link navbtn active" data-target='Dashboards' onclick="Dashboards()">Dashboard</button>
                </li>

                <li class="nav-item">
                    <button class="btn btn-link rounded-0 nav-link navbtn" data-target='Employees' onclick="Employees()">Employees</button>
                </li>

                <li class="nav-item">
                    <button class="btn btn-link rounded-0 nav-link navbtn" data-target='Trainings' onclick="Trainings()">Trainings</button>
                </li>

                <li class="nav-item dropdown">
                    <button class="btn btn-link nav-link rounded-0 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear-fill"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>