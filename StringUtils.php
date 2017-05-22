<?php
//Implementacion del algoritmo de distancia de levenshtein
function lev($original, $target) {

	$m = strlen($original);
	$n = strlen($target);

  //Inicializamos el arreglo bidimensional de de distancias
	for($i=0;$i<=$m;$i++)
    $d[$i][0] = $i;

	for($j=0;$j<=$n;$j++)
    $d[0][$j] = $j;

  //Recorremos ambas cadenas Complejidad de O(m.n)
	for($i=1;$i<=$m;$i++) {
		for($j=1;$j<=$n;$j++) {
			$c = ($original[$i-1] == $target[$j-1])? 0 : 1;
			$d[$i][$j] = min($d[$i-1][$j]+1, $d[$i][$j-1]+1, $d[$i-1][$j-1] + $c);
		}
	}
	return $d[$m][$n];
}

//Esta funcion devuelve la distancia de levenshtein normalizada
function levNormalized($word, $word_dic) {
  $d = lev($word, $word_dic);
  $norm = max(strlen($word), strlen($word_dic)) * 1.0;
  return $d/$norm;
}

//Function compare words
function compareWords($input, $entry) {
	$check = trim($input);
	$finding = trim($entry);

	//Intercambiamos
	if(strlen($check) < strlen($entry)) {
		//return array("index" => 0, "final_index" => (count($input) -1), "score" => levNormalized($check, $finding));
		$temp = $entry;
		$entry = $check;
		$check = $temp;
	}


	$index = 0;
	$best = 0;
	$entry_size = strlen($entry);
	$bestScore = levNormalized($check, $entry);
	$data = substr($check, $index, $entry_size);
//	while(strlen($data) > strlen($entry)) {
	while($index < strlen($check)) {
		//echo "Checking $data";
		$score = levNormalized($data, $entry);
		//echo "... $score <br />";
		if($score < $bestScore) {
			$best = $index;
			$bestScore = $score;
		}
		$index += 1;
		//$data = substr($check, $index);
		$data = substr($check, $index, $entry_size);
	}

	//Obtenemos la cadena de mejor score
	/*$beststring = substr($check, $best);
	$copy = $beststring;
	while(strlen($copy) >= strlen($entry) && strlen($copy) > 0) {
		//echo "Checking $copy <br />";
		$score = levNormalized($copy, $entry);
		if($score < $bestScore) {
			$bestScore = $score;
		}
		$copy = substr($copy, 0, strlen($copy) - 2);
	}*/
	return array("index" => $best, "final_index" => $best + $entry_size, "score" => $bestScore);
}

//Eliminamos los caracteres especiales del espanol y
//convertimos la cadena en mayusculas
function prepareString($original) {
  $result = str_replace('á', 'a', $original);
  $result = str_replace('é', 'e', $result);
  $result = str_replace('í', 'i', $result);
  $result = str_replace('ó', 'o', $result);
  $result = str_replace('ú', 'u', $result);
  $result = str_replace('ü', 'u', $result);
  $result = str_replace('Á', 'A', $result);
  $result = str_replace('É', 'E', $result);
  $result = str_replace('Í', 'I', $result);
  $result = str_replace('Ó', 'O', $result);
  $result = str_replace('Ú', 'U', $result);
  $result = str_replace('ñ', 'n', $result);
  $result = str_replace('Ñ', 'N', $result);

  return strtoupper($result);
}
