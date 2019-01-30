<HTML>
<BODY>
<?php
//abrimos fichero
	$fichero = fopen("primitiva.txt", "r");
//Creo array para almacenar los numeros aleatorios de forma global	
	$valores = array();
	
//Creo funcion para calcular los 6 números aleatorios + el complementario y los almaceno en un array.
	function combinacion(){
	$max = 0;		
		do{
			$aleatorio = rand(1, 49); // Sacamos numero aleatorio
			if(in_array($aleatorio, $valores )== false){ //Compara el valor aleatorio con array. Si se encuentra ya dentro sigue buscando, si no se encuentra lo añade 
				array_push($valores, $aleatorio);				//al array.
				$max++;
			}			
		}while($max <= 7); //Ponemos como máxima longitud del array 7 para que sean los 6 numeros + el complementario
		
	//Sacamos un numero al azar entre 0 y 9 para obtener el reintegro y lo añadimos al array con el resto de la combinacion.
	$reintegro = rand(0,9);		
	array_push($valores, $reintegro); //Añado el valor de reintegro al array de la combinacion ganadora
		
	return $valores; //Devuelvo el array con la combinacion ganadora.	
	}	
			
	
	//Esta funcion lee el fichero, lo particiona por columnas y compara con la combinacion ganadora para saber los premiados.
	function Fichero(){
		$fichero = file("primitiva.txt");	
		$cont=0;
		$valores = combinacion();
		
		//Almaceno cada uno de los valores del array en una variable
		list( $an1, $an2, $an3, $an4, $an5, $an6, $ac, $ar)=($valores); 
		
		//Leo todo el fichero y guardo los diferentes valores en variables por columnas.
		foreach ($fichero as $linea => $texto){
			$id = substr($texto, 0, strpos($texto, "-"));
			$resto = substr($texto, strpos($texto, "-")+1);
			$n1 = substr($resto, 0, strpos($resto, "-"));
			$resto = substr($resto, strpos($resto, "-")+1);
			$n2 = substr($resto, 0, strpos($resto, "-"));
			$resto = substr($resto, strpos($resto, "-")+1);
			$n3 = substr($resto, 0, strpos($resto, "-"));
			$resto = substr($resto, strpos($resto, "-")+1);
			$n4 = substr($resto, 0, strpos($resto, "-"));
			$resto = substr($resto, strpos($resto, "-")+1);
			$n5 = substr($resto, 0, strpos($resto, "-"));
			$resto = substr($resto, strpos($resto, "-")+1);
			$n6 = substr($resto, 0, strpos($resto, "-"));
			$resto = substr($resto, strpos($resto, "-")+1);
			$c = substr($resto, 0, strpos($resto, "-"));
			$resto = substr($resto, strpos($resto, "-")+1);
			$r = $resto;
			
			$array = array($n1, $n2, $n3, $n4, $n5, $n6, $c, $r);
			
			for($i=0; $i<=6; $i++){
				if(in_array($array[$i], $valores)){
					$cont++;					
				}
				/*if(in_array($an2, $array)){
					$cont++;
				}
				if(in_array($an3, $array)){
					$cont++;
				}
				if(in_array($an4, $array)){
					$cont++;
				}
				if(in_array($an5, $array)){
					$cont++;
				}
				if(in_array($an6, $array)){
					$cont++;
				}
				if(in_array($ac, $array)){
					$cont++;
				}
				if(in_array($ar, $array)){
					$cont++;
				}*/
			}
			
			if($array[7] == $ar){				
				echo "ID: " . $id . ": ". $cont . " aciertos + el reintegro.";
			}else{
				echo "ID: " . $id . ": ". $cont . " aciertos, pero no ha acertado el reintegro.";
			}			
		}
	}

	fclose($fichero);
?>
</BODY>
</HTML>
