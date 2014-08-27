<?php

	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	
	if( empty( $_POST ) || !isset( $_POST['cep'] ) || empty( $_POST['cep'] ) ) // Evita CEP vazio
	{
		echo '0';
		die();
	}

	$cep = $_POST['cep'];
	
	if(strlen($cep) > 8 ) // Verifica o tamanho do CEP
	{
		$cep = preg_replace( '/[^0-9]/', '', $cep ); // Deixa apenas números
	}

	$url = 'http://m.correios.com.br/movel/buscaCepConfirma.do';
	$post_string = 'cepEntrada='. $cep .'&tipoCep=&cepTemp=&metodo=buscarCep';
	
	$ch = curl_init($url . '?');
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_string);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$html = curl_exec($ch);
	curl_close($ch);
	
	echo $html;
?>