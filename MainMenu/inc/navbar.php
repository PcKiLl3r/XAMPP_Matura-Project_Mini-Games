<header class="container-fluid bg-dark text-white d-flex flex-row">
        <a class="nav-link" href="../BallCubeButton/ballCube.html"><h5 class="my-auto" style="width: 7rem;line-height: 28px;"><i class="bi bi-newspaper"></i> Matura <br> Mini Games</h5></a>
        <nav>
        <ul class="nav navbar-nav navbar-right block-menu">
            <li>
                <a class="three-d" href="./index.php">
                    Domov
                    <span aria-hidden="true" class="three-d-box">
                        <span class="front">Domov</span>
                        <span class="back">Domov</span>
                    </span>
                </a>
            </li>
            <!-- <li>
                <a class="three-d" href="">
                    O nas
                    <span aria-hidden="true" class="three-d-box">
                        <span class="front">O nas</span>
                        <span class="back">O nas</span>
                    </span>
                </a>
            </li> -->
        </ul>
        </nav>
        <nav style="margin-left: auto;">
        <ul class="nav navbar-nav navbar-right block-menu">
            <?php
                if(!isset($_SESSION['user_email'])){
                    ?>
                    <li>
                    <a class="three-d" href="./profile/auth.php">
                        Login
                        <span aria-hidden="true" class="three-d-box">
                            <span class="front">Login</span>
                            <span class="back">Login</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="three-d" href="./profile/auth.php">
                        Register
                        <span aria-hidden="true" class="three-d-box">
                            <span class="front">Register</span>
                            <span class="back">Register</span>
                        </span>
                    </a>
                </li>
                <?php
                } else {
                    ?>
                    <li>
                    <a class="three-d" href="./profile/stats.php">
                        My stats
                        <span aria-hidden="true" class="three-d-box">
                            <span class="front">My stats</span>
                            <span class="back">My stats</span>
                        </span>
                    </a>
                </li>
                <li style="margin-right: 15px; margin-left: 15px;">
                &nbsp;
                </li>
                    <li class="ml-5">
                    <a class="three-d" href="./profile/logout.php">
                        Logout
                        <span aria-hidden="true" class="three-d-box">
                            <span class="front">Logout</span>
                            <span class="back">Logout</span>
                        </span>
                    </a>
                </li>
                <?php
                }
            ?>
        </ul>
        </nav>
    </header>