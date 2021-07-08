<?php
	error_reporting(0);
	
	$cartao = $_POST['cartao'];

	$um = substr($cartao, 0, 1);
	$dois = substr($cartao, 1, 1);
	$tres = substr($cartao, 2, 1);
	$quatro = substr($cartao, 3, 1);
	$cinco = substr($cartao, 5, 1);
	$seis = substr($cartao, 6, 1);
	$sete = substr($cartao, 7, 1);
	$oito = substr($cartao, 8, 1);
	$nove = substr($cartao, 10, 1);
	$dez = substr($cartao, 11, 1);
	$onze = substr($cartao, 12, 1);
	$doze = substr($cartao, 13, 1);
	$treze = substr($cartao, 15, 1);
	$quatorze = substr($cartao, 16, 1);
	$quinze = substr($cartao, 17, 1);
	$dezesseis = substr($cartao, 18, 1);

	echo '<span class="ui-card__point">'.$um.'</span>';
	echo '<span class="ui-card__point">'.$dois.'</span>';
	echo '<span class="ui-card__point">'.$tres.'</span>';
	echo '<span class="ui-card__point">'.$quatro.'</span>';
	echo '<span class="ui-card__point">'.$cinco.'</span>';
	echo '<span class="ui-card__point">'.$seis.'</span>';
	echo '<span class="ui-card__point">'.$sete.'</span>';
	echo '<span class="ui-card__point">'.$oito.'</span>';
	echo '<span class="ui-card__point">'.$nove.'</span>';
	echo '<span class="ui-card__point">'.$dez.'</span>';
	echo '<span class="ui-card__point">'.$onze.'</span>';
	echo '<span class="ui-card__point">'.$doze.'</span>';
	echo '<span class="ui-card__point">'.$treze.'</span>';
	echo '<span class="ui-card__point">'.$quatorze.'</span>';
	echo '<span class="ui-card__point">'.$quinze.'</span>';
	echo '<span class="ui-card__point">'.$dezesseis.'</span>';

?>