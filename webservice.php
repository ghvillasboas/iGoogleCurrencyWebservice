<?php
header('Content-Type: application/json');

// Valores convertidos
define( "USD_TO_USD", 1.0000);
define( "EUR_TO_USD", 0.7248);
define( "BRL_TO_USD", 0.4538);

define( "USD_TO_EUR", 1.3798);
define( "EUR_TO_EUR", 1.0000);
define( "BRL_TO_EUR", 0.3289);

define( "USD_TO_BRL", 2.2037);
define( "EUR_TO_BRL", 3.0406);
define( "BRL_TO_BRL", 1.0000);

// sufixos
define( "USD_TYPE", "U.S. dollars");
define( "EUR_TYPE", "UE Euros");
define( "BRL_TYPE", "Brazil real");

// queries do usuario
$q 			= $_REQUEST['q'];
$origem 	= strtolower($_REQUEST['origem']);
$destino 	= strtolower($_REQUEST['destino']);

// retornos
$lhs = "";
$rhs = "";
$error = "";

// DOLAR PARA X
if ($origem == "usd"){

	$lhs = sprintf("%f %s", $q, USD_TYPE);

	if ($destino == "usd") $rhs = sprintf("%f %s", $q, USD_TYPE);
	else if ($destino == "eur") $rhs = sprintf("%f %s", $q * USD_TO_EUR, EUR_TYPE);
	else if ($destino == "brl") $rhs = sprintf("%f %s", $q * USD_TO_BRL, BRL_TYPE);

}
// EURO PARA X
else if ($origem == "eur"){

	$lhs = sprintf("%f %s", $q, EUR_TYPE);

	if ($destino == "usd") $rhs = sprintf("%f %s", $q * EUR_TO_USD, USD_TYPE);
	else if ($destino == "eur") $rhs = sprintf("%f %s", $q, EUR_TYPE);
	else if ($destino == "brl") $rhs = sprintf("%f %s", $q * EUR_TO_BRL, BRL_TYPE);
	
}
// REAL PARA X
else if ($origem == "brl"){
	$lhs = sprintf("%f %s", $q, BRL_TYPE);

	if ($destino == "usd") $rhs = sprintf("%f %s", $q * BRL_TO_USD, USD_TYPE);
	else if ($destino == "eur") $rhs = sprintf("%f %s", $q * BRL_TO_EUR, EUR_TYPE);
	else if ($destino == "brl") $rhs = sprintf("%f %s", $q, BRL_TYPE);
}
// MOEDA INVALIDA
else{
	$error = "Moeda nao encontrada";
}

echo '{lhs: "' . $lhs . '",rhs: "' . $rhs . '",error: "' . $error . '",icc: true}';
?>