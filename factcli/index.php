<?php

require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as BD;
use factcli\models\Client;
use factcli\models\Facture;
use factcli\outils\Outils;
use factcli\conf\ConnectionFactory;
//base de donnee
ConnectionFactory::setConfig('conf.ini');
ConnectionFactory::makeConnection();

//slim
$app = new \Slim\Slim();
//slim part2
$app->get('/', function(){
    formulaire();
})->name('form');
$app->get('/client', function(){
    $slim = \Slim\Slim::getInstance();
    $id = $slim->request->get()['id'];
    clientFact($id);
})->name('repForm');

//appel de outils pour afficher le formulaire de selection du client
function formulaire(){
  global $app;
  $act = $app->urlFor('repForm');
  Outils::headerHTML();

  //echo '<form method='GET' action=*'$act'>';
  //echo '<select name='client'>'."\n";
  //echo '<option value='ListeClient'>--Clients--</option>'."\n";

  echo "<form method='GET' action=''> <select name='client'>
        <option value=''>--Liste des clients--</option>";

  $ListClient = Client::select( 'nomcli', 'id')->get();
  foreach ($ListClient as $row) {
      //$clientId=$row["id"];
      $nomClient=$row['nomcli'];
      $id = $row->id;
      echo "<option value='$id'>".$nomClient."</option> \n";
  }
        echo "<input type='submit' name='tarif'  value='Envoyer'>";
      echo "</select>";
    echo "</form>";

  //si on clique sur envoyer
  if (!isset($_POST['Envoyer'])){
    $id = $_GET['client'];
    $Facture = Facture::select('datefact', 'montant')->where('client_id','=',$id)->get();
    echo "<h3>Liste des Factures de .$id.</h3>";
    echo "</br>";
     foreach ($Facture as $row) {
         $date=$row['datefact'] ;
         $prix=$row['montant'] ;
         echo $date ."\n" . $prix . " €" ."<br>";
      }
   }
}

/*function test(){
  if (!isset($_POST['Envoyer'])){
    $id = $_GET['client'];
    $Facture = Facture::select('datefact', 'montant')->where('client_id','=',$id)->get();
    echo "<h3>Liste des Factures:</h3>";
    echo "</br>";
     foreach ($Facture as $row) {
         $date=$row["datefact"] ;
         $prix=$row["montant"] ;
         echo $date ."\n" . $prix . " €" ."<br>";
      }
   }
}*/

$app->run();
Outils :: footerHTML();
?>
