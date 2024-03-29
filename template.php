<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site SAE</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="script.js"></script>
  </head>
  <body class="d-flex flex-column min-vh-100">
    
    <header>
      <?php $compMenu->affichage(); ?>
    </header>

    <main >
      <?php echo $contenu; ?>
      <div class="barreTours">
      </div>

    </main>

  </body>

  <footer class="py-5 mt-auto">
      <div class="container text-light text-center">

        <div class="row justify-content-center">
          <div class="col-auto">
            <a href="https://github.com/DUT-Info-Montreuil/SAE_WEB_Luc_Juba_Said_Antoine.git"> 
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
        <br>
        <small class="text-white-50"> Créateur du site : Xiang Luc | Shinwari Said Kamal | Ngatchou Antoine | Chabane Juba </small>
        
      </div>
  </footer>
</html>