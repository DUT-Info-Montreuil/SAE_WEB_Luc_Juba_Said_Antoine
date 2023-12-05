<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Site SAE</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="d-flex flex-column min-vh-100">
    
    <header>
      <?php $compMenu->affichage(); ?>
    </header>

    <main>
      <?php echo $contenu; ?>
    </main>

  </body>

  <footer class="py-5 mt-auto">
      <div class="container text-light text-center">

        <div class="row justify-content-center">
          <div class="col-auto">
            <a href="https://github.com/weDeZed/SAE_Juba_Antoine_Said"> 
              <img src="assets/github.svg" alt="Github" class="img-fluid"> 
            </a>
          </div>
          <div class="col-auto">
            <a href="https://www.youtube.com"> 
              <img src="assets/youtube.svg" alt="Youtube" class="img-fluid"> 
            </a>
          </div>
          <div class="col-auto">
            <a href="https://twitter.com/?lang=fr"> 
              <img src="assets/twitter-x.svg" alt="TwitterX" class="img-fluid"> 
            </a>
          </div>
          <div class="col-auto">
            <a href="https://www.instagram.com/"> 
              <img src="assets/instagram.svg" alt="Instagram" class="img-fluid"> 
            </a>
          </div>
        </div>

        <small class="text-white-50"> &copy; SAE R3.2 2023-2024 </small>
        
      </div>
  </footer>
</html>
