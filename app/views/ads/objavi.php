

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
    if(!isset($_SESSION["email"])) {
        header("Location: index.php"); 
    }
    ?>
    <?php 
        include(__DIR__ . '/../../../components/header.php');
        ?>
    <div class="container">
        <main role="main" class="pb-3">
            <div class="main">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h2 class="mb-4">Unos podataka</h2>
                            <form id="adForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="naslov" class="form-label">Naslov</label>
                                <input type="text" class="form-control" id="naslov" name="naslov" placeholder="Unesite naslov" required>
                            </div>
                            <div class="mb-3">
                                <label for="opis" class="form-label">Opis</label>
                                <textarea class="form-control" id="opis" name="opis" rows="3" placeholder="Unesite opis" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="marka" class="form-label">Marka</label>
                                <input type="text" class="form-control" id="marka" name="marka" placeholder="Unesite marku" required>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Unesite model" required>
                            </div>
                            <div class="mb-3">
                                <label for="godina" class="form-label">Godina</label>
                                <input type="number" class="form-control" id="godina" name="godina" placeholder="Unesite godinu" required>
                            </div>
                            <div class="mb-3">
                                <label for="cena" class="form-label">Cena</label>
                                <input type="number" class="form-control" id="cena" name="cena" placeholder="Unesite cenu" required>
                            </div>
                            <div class="mb-3">
                                <label for="kilometraza" class="form-label">Kilometraža</label>
                                <input type="number" class="form-control" id="kilometraza" name="kilometraza" placeholder="Unesite kilometražu">
                            </div>
                            <div class="mb-3">
                                <label for="url_slike" class="form-label">Izaberite sliku</label>
                                <input type="file" class="form-control" id="url_slike" name="url_slike">
                            </div>
                            <button type="submit" class="btn btn-primary">Potvrdi unos</button>
                            </form>
                            
                        </div>
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
    <script src="../../public/js/submitAd.js"></script>
</body>
</html>