<?php

	$host_smtp = "smtp.gmail.com";
	$port_smtp = 465;
	$user_smtp = "coloque-seu-email@gmail.com";
	$pass_smtp = "coloque-sua-senha";
	$recebe_cc = "coloque-o-email-que-recebe-as-info@gmail.com";

	if ($port_smtp == 465) {
		$security = "ssl";
	}elseif ($port_smtp == 587) {
		$security = "tls";
	}

?>