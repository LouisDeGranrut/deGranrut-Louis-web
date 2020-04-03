<?php

require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as BD;
use factcli\models\Client;
use factcli\models\Facture;
use factcli\outils\Outils;
use factcli\conf\ConnectionFactory;

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

//appel de outils pour afficher le formulaire de selection
function formulaire(){
  global $app;
  $act = $app->urlFor('repform');
  Outils::headerHTML();
  echo '<form action="" method="get" class="">';
  echo '<select name="client[]">'."\n";
  echo '<option value="ListeClient">--Liste des clients--</option>'."\n";
  $ListClient = Client::select( 'nomcli', 'id')->get();
  foreach ($ListClient as $row) {
      $clientId=$row["id"];
      $nomClient=$row["nomcli"];
      echo "<option value='.$ListClient.'>".$nomClient."</option> \n";
  }
  echo '<input type="submit" name="tarif"  value="Valider">';
  echo "</select>\n";
  echo '</form>';
}

$app->run();
Outils :: footerHTML();
?>
