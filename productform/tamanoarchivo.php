<?php

if ( ! empty( $_POST ) ) {
	$maximo = 250000;
	if ( $_FILES["imagen"]["size"] <= $maximo)  //Funciona a las mil maravillas
	{
		echo "verdadero";
	}else {
		echo "falso";
	}
}



?>