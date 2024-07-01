
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Auto Plac</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto+Mono|Work+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/autoplac%20mvc%20projekat/public/css/style.css">
</head>
<body>
    
<?php 
        include(__DIR__ . '/../../../components/header.php');
        ?>
    <div class="container">
        <main role="main" class="pb-3">
            <div class="hero-section row rounded-lg-md flex justify-content-start align-items-center mt-5">
                <div class="column mt-5">
                    <div class="ms-3  text-weight-bold">
                        <p class="header text-light mb-4">Najveći izbor automobila kod nas</p>
                        <p class="basic text-light mb-4">Izaberite vaš budući automobil kod nas</p>
                        <div class="row flex justify-content-start">
                            <?php 
                                 // Provera da li je korisnik prijavljen
                                if(isset($data['user']->username)){
                                    // Ako je prijavljen, prikazuje se opcija za pregled oglasa i narudžbina
                                    echo '
                                        <div class="col-5 col-md-2 mr-10">
                                            <a type="button" class=" container-fluid btn rounded btn-primary" href="ad/index" >Oglasi</a>
                                        </div>
                                        <div class="col-5 col-md-2 mr-10">
                                            <a type="button" class=" container-fluid btn rounded btn-secondary" href="ad/narudzbine" >Narudzbine</a>
                                        </div>';
                                }
                                else
                                {
                                    // Ako nije prijavljen, prikazuju se opcije za registraciju i prijavljivanje
                                    echo '
                                    <div class="col-5 col-md-2 mr-10">
                                        <a type="button" class=" container-fluid btn rounded btn-primary" href="../user/register" >Registruj se</a>
                                    </div>
                                    <div class="col-5 col-md-2 mr-10">
                                        <a  class=" container-fluid btn rounded btn-secondary" href="../user/login" >Prijavi se</a>
                                    </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-5 flex row">
            <?php 
                    for($i=0;$i<count($data['oglasi']);$i++) {
                        //Prikazivanje pojedinačnog premijum oglasa
                        echo '<div class="col-12 col-md-6 col-lg-3 justify-content-md-start justify-content-center align-items-md-start align-items-center text-md-left text-center d-flex flex-column">';
                        echo '<div class="rounded col-12 mb-2 mt-2">';
                        echo '<img class="slika" src="images/'.$data['oglasi'][$i]->url_slike.'" alt="'.$data['oglasi'][$i]->url_slike.'">';
                        echo '</div>';
                        echo '<div class="naslov col-12 mb-2 mt-2">';
                        echo '<p>'.$data['oglasi'][$i]->naslov.'</p>';
                        echo '</div>';
                        echo '<div class="cena col-12 mb-2 mt-2">';
                        echo '<p>$'.$data['oglasi'][$i]->cena.'</p>';
                        echo '</div>';
                        echo '<div class="row col-12">';
                        echo '<div class="col-12  col-md-6 mt-2 mb-2 mt-md-0 mb-md-0">';
                        echo '<a type="button" class="container-fluid btn rounded btn-secondary" href="./oglas.php?id='.$data['oglasi'][$i]->id.'">Detalji</a>';
                        echo '</div>';
                        if(isset($data['user']->username)&& !empty($data['user']->username)){
                            echo '<div class="col-12  col-md-6 mr-10">';
                            echo '<a type="button" class="container-fluid btn rounded btn-primary" href="./naruci.php?id='.$data['oglasi'][$i]->id.'">Naruči</a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
            ?>
            </div>
            <div class="container mt-5 mb-5 flex flex-column">
                <p class="header mt-5 mb-5">Test vožnja svakog automobila</p>
                <p class="basic mt-5 mb-5">Svaki od nasih automobila možete vratiti u roku od 7 dana ili 500 km</p>
                <a href="./oglasi.php"></a>
            </div>

            <div class="container mt-5 mb-5 pt-5 pb-5 flex flex-column">
                <div class=" header2 mt-5 mb-5 text-black container-fluid text-center" >
                    Želite li da naručite neki od naših automobnila?
                </div>
                <div class="d-flex justify-content-center align-content-center">
                    <div class="col-md-4 col-sm-7 col-10">
                        <?php 
                            // Provera da li je korisnik prijavljen
                            if(isset($data['user']->username)){
                                // Ako je prijavljen, prikazuje se opcija za pregled oglasa i narudžbina
                                echo '
                                <div class="mt-4 mb-4">
                                    <a type="button" class="container-fluid btn rounded btn-primary" href="./oglasi.php" >Oglasi</a>
                                </div>
                                <div class="mt-4 mb-4" >
                                    <a  href="./narudzbine.php" class="border-none container-fluid btn rounded btn-secondary">Narudzbine</a>
                                </div>';
                            }
                            else
                            {
                                // Ako nije prijavljen, prikazuju se opcije za registraciju i prijavljivanje
                                echo '
                                <div class="mt-4 mb-4">
                                    <a type="button" class="container-fluid btn rounded btn-primary" href="./register.php" >Registruj se</a>
                                </div>
                                <div class="mt-4 mb-4" >
                                    <a  href="./login.php" class="border-none container-fluid btn rounded btn-secondary">Prijavi se</a>
                                </div>';
                            }
                        ?>
                    </div>
                    
                </div>
                
            </div>
        </main>
    </div>

    <footer class="border-top footer text-muted">
        <div class="container">
            &copy; 2024 - AutoPlac
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
