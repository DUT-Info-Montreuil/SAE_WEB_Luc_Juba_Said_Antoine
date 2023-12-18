<?php

require_once("cont_tours.php");

class ModTours
{

  private $action, $cont;

  public function __construct()
  {
    $this->cont = new ContTours;
    $this->action = isset($_GET['action']) ? $_GET['action'] : "Test";
  }

  public function exec()
  {


    switch ($this->action) {

      case "Test":
        $this->cont->afficheTours();
        break;
      case "recherche":
        $this->cont->rechercheTours();
        break;
      default:
        die("Action inexistante");
    }
  }



}

?>