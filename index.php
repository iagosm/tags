<?php
try{
$pdo = new PDO("mysql:host=localhost;dbname=senhas", 'root', '');
}catch(PDOException $e) {
  echo "ERROR: " . $e->getMessage();
}

$sql = "SELECT caracteristicas FROM tags";
$sql = $pdo->query($sql);
if($sql->rowCount()> 0) {
  $lista = $sql->fetchAll();

  $carac = array();
  foreach($lista as $usuario) { //cada um dos usuarios e pegar cada uma das caracteristicas
    $palavras = explode(",", $usuario['caracteristicas']);

    foreach($palavras as $palavra) {//verifica se o nome já foi add em carac
      $palavra = trim($palavra);

      if(isset($carac[$palavra])){
        $carac[$palavra]++;
      }else {
        $carac[$palavra] = 1;
      }
    }

  }

  arsort($carac);

  $palavras = array_keys($carac);
  $contagem = array_values($carac);

  $maior = max($contagem);

  $tamanho = array(11, 15, 20, 30);

  for($x = 0; $x <count($palavras); $x++) {

    $n = $contagem[$x] / $maior;
    $h = ceil($n * count($tamanho));

    echo "<p style='font-size:".$tamanho[$h-1]."px'>".$palavras[$x]."(".$contagem[$x].")</p>";

  }

}