<header>
        <nav style="box-sizing: border-box;border-bottom: 1px solid #E6E8EB;" class="navbar navbar-expand-md navbar-toggleable-md navbar-light bg-white box-shadow mb-3">
            <div class="container-fluid">
                <a href="/public/home" class="navbar-brand"><img class="logo" src="/public/img/logo.png" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-md-inline-flex justify-content-end">
                    <ul class="navbar-nav flex-grow-1 justify-content-end">
                        <li class="nav-item ms-3 me-3">
                            <a href="/public/home" class="nav-link text-dark">Početna</a>
                        </li>
                        <li class="nav-item ms-3 me-3">
                            <a href="/public/ads" class="nav-link text-dark">Oglasi</a>
                            
                        </li>
                        <?php 
                            if(isset($_SESSION['email'])){
                                echo '
                                <li class="nav-item ms-3 me-3">
                                    <a href="/public/ads/objavi" class="nav-link text-dark">Objavi auto</a>
                                </li>
                                ';
                                echo '<li class="ms-md-3 me-md-3 mt-2 mb-2 mt-md-0 mb-md-0 nav-item">
                                    <a href="/public/ads/orders" type="button" style="padding:7px"  class="btn rounded btn-secondary ">Narudzbine</a>
                                </li>';
                                echo '<li class="ms-md-3 me-md-3 mt-2 mb-2 mt-md-0 mb-md-0  nav-item">
                                    <a type="button" class="btn rounded btn-primary" style="padding:7px" href="./users/logout" >Odjavi se</a>
                                </li>';
                            }else{
                                echo '<li class="ms-md-3 me-md-3 mt-2 mb-2 mt-md-0 mb-md-0 nav-item">
                                    <a href="/public/users/login" type="button" style="padding:7px"  class="btn rounded btn-secondary ">Prijavi se</a>
                                </li>';
                                echo '<li class="ms-md-3 me-md-3 mt-2 mb-2 mt-md-0 mb-md-0  nav-item">
                                    <a type="button" class="btn rounded btn-primary" style="padding:7px" href="/public/users/register" >Registruj se</a>
                                </li>';
                            }
                        ?>
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>