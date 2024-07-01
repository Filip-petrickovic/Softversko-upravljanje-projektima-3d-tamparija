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
            <div class="main justify-content-center align-items-center flex-column d-flex">
                <p  class="header text-center mb-5">Registrujte se na vaš nalog</p>
                <div class="col-md-6 col-sm-9 col-12 align-items-center d-flex flex-column">

                    <form id="register-form" class=" d-flex flex-column container-fluid gap-0" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                         
                        
                        <div class="form-group mb-2 col-12">
                            <label for="username">Korisnicko ime<span class="error">*</span></label>
                            <input id="username" class="form-control" type="text" placeholder="Korisnicko ime" name="username">
                            <span class="error"></span>
                        </div>  
                        <div class="form-group mb-2 col-12">
                            <label for="email">E-mail<span class="error">*</span></label>
                            <input id="email" class="form-control" type="text" placeholder="E-mail" name="email">
                            <span class="error"></span>
                        </div>    
                        <div class="form-group mb-2 col-12">
                            <label for="pass">Lozinka<span class="error">*</span></label> 
                            <input id="pass" class="form-control" type="password" placeholder="Lozinka" name="pass">
                            <span class="error"></span>
                        </div>
                        <div class="form-group mb-2 col-12">
                            <label for="provera">Provera lozinke<span class="error">*</span></label>
                            <input id="provera" class="form-control" type="password" placeholder="Ponovi lozinku" name="provera">
                            <span class="error"></span>
                        </div> 
                        <br>
                        <input type="submit" name="submit" class="btn btn-primary " value="Potvrdi">
                         
                        
                    </form>
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
    <script src="../../public/js/register.js"></script>
</body>
</html>