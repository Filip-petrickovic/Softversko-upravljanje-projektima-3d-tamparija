<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Auto Plac</title>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto+Mono|Work+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    
    <?php 
        include(__DIR__ . '/../../../components/header.php');
        ?>
    <div class="container">
        <main role="main" class="pb-3">
            <div class="main">
                <div class="container mb-5 flex row">
                <?php 
                if(count($data['oglasi'])){
                    for($i=0;$i<count($data['oglasi']);$i++) {
                        echo '<div class="col-12 col-md-6 col-lg-3 justify-content-md-start justify-content-center align-items-md-start align-items-center text-md-left text-center d-flex flex-column">';
                        echo '<div class="rounded col-12 mb-2 mt-2">';
                        echo '<img class="slika" src="images/'.$data['oglasi'][$i]['url_slike'].'" alt="'.$data['oglasi'][$i]['url_slike'].'">';
                        echo '</div>';
                        echo '<div class="naslov col-12 mb-2 mt-2">';
                        echo '<p>'.$data['oglasi'][$i]['naslov'].'</p>';
                        echo '</div>';
                        echo '<div class="naslov cena col-12 mb-2 mt-2 d-flex row">';
                        echo '<p class="col-7">'.$data['oglasi'][$i]['marka'].' '.$data['oglasi'][$i]['model'].'</p>';
                        echo '<p class="col-4">'.$data['oglasi'][$i]['godina'].'. god.</p>';
                        echo '</div>';
                        echo '<div class="cena col-12 mb-2 mt-2">';
                        echo '<p>€'.$data['oglasi'][$i]['cena'].'</p>';
                        echo '</div>';
                        echo '<div class="row col-12">';
                        echo '<div class="col-12  col-md-6 mt-2 mb-2 mt-md-0 mb-md-0">';
                        echo '<a type="button" class="container-fluid btn rounded btn-secondary" href="/public/ads/ad/'.$data['oglasi'][$i]['id'].'">Detalji</a>';
                        echo '</div>';
                        if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
                            echo '<div class="col-12  col-md-6 mr-10">';
                            echo '<a type="button" class="container-fluid btn rounded btn-primary" href="/public/ads/order/'.$data['oglasi'][$i]['id'].'">Naruči</a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                        }
                } else {  
                    // Prikazivanje poruke kada nema dostupnih oglasa
                    echo '<p class="header text-center">Svi automobili su prodati</p>';
                    echo '<div class="d-flex justify-content-center align-content-center">';
                    echo '<div class="col-md-4 col-sm-7 col-10">';
                    if(isset($_SESSION["email"])){
                        echo '<div class="mt-4 mb-4">';
                        echo '<a type="button" class="container-fluid btn rounded btn-primary" href="/public/">Početna</a>';
                        echo '</div>';
                        echo '<div class="mt-4 mb-4">';
                        echo '<a href="/public/ads/orders" class="border-none container-fluid btn rounded btn-secondary">Narudžbine</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="mt-4 mb-4">';
                        echo '<a type="button" class="container-fluid btn rounded btn-primary" href="/public/">Početna</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>
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