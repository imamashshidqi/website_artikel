    <header class="py-3 mb-4 border-bottom shadow">
        <div class="container-fluid align-items-center d-flex">
            <div class="flex-shrink-1 me-3">
                <a href="index.php" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none">
                    <i class="bi bi-bootstrap fs-2 text-dark"></i>
                </a>
            </div>
            <div class="flex-grow-1 d-flex align-items-center">
                <form class="w-100 me-3" method="GET" action="pencaharian.php">
                    <input type="search" class="form-control" name="search" placeholder="Search...">
                </form>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- <img src="https://via.placeholder.com/28?text=!" alt="user" width="32" height="32" class="rounded-circle"> -->
                        <?= $_SESSION["username"]; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="d-flex justify-content-center">
                            <form action="dashboard.php" method="post">
                                <button type="submit" name="logout">logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>