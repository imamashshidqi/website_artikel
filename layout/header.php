<!-- Header -->
<nav class="navbar navbar-expand-lg bg-body-secondary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Pakuan News 📰</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true" href="dashboard.php">Dashboard</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="get" action="pencaharian.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success me-2" type="submit">Search</button>
                <!-- Button trigger modal -->
                <a href="register.php">
                    <button type="button" class="btn btn-success-bg-subtle">Register</button>
                </a>
                <a href="login.php">
                    <button type="button" class="btn btn-success-bg-subtle">Login</button>
                </a>
            </form>
        </div>
    </div>
</nav>