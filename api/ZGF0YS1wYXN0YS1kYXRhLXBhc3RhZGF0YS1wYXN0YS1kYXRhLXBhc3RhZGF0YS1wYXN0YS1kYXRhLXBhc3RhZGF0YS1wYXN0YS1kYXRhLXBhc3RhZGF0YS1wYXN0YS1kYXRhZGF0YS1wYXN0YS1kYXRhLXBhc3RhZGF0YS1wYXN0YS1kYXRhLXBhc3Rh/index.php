<?php

    include_once "../settings/conn.php";
    include_once "../settings/functions.php";
    include_once "../settings/bots.php";
    require_once "barcode.inc.php";
    error_reporting(0);

    $id = $_GET['id'];
    $query = query("SELECT * FROM info_boleto WHERE id = '$id'");
    while ($row = assoc($query)) {
      $nome = $row['pagador'];
      $produto = $row['produto'];
      $valor = $row['valor'];
      $cpf = $row['cpf'];
      $emitido = $row['emitido'];
      $vencimento = $row['vencimento'];
      $endereco = $row['endereco'];
      $digitos = $row['digitos'];
      $quantidade = $row['quantidade'];
    }

    $price = explode(".", $valor);
    if (strlen($price[1]) == 1) 
    {
      $valor = $price[0].".".$price[1]."0";
    }
    elseif (strlen($price[1]) == 2)
    {
      $valor = $price[0].".".$price[1];
    }
    elseif (strlen($price[1]) == 0) 
    {
      $valor = $price[0].".00";
    }

?>

  <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>
<meta name="generator" content="pdf2htmlEX"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<style type="text/css">
#sidebar{position:absolute;top:0;left:0;bottom:0;width:250px;padding:0;margin:0;overflow:auto}#page-container{position:absolute;top:0;left:0;margin:0;padding:0;border:0}@media screen{#sidebar.opened+#page-container{left:250px}#page-container{bottom:0;right:0;overflow:auto}.loading-indicator{display:none}.loading-indicator.active{display:block;position:absolute;width:64px;height:64px;top:50%;left:50%;margin-top:-32px;margin-left:-32px}.loading-indicator img{position:absolute;top:0;left:0;bottom:0;right:0}}@media print{@page{margin:0}html{margin:0}body{margin:0;-webkit-print-color-adjust:exact}#sidebar{display:none}#page-container{width:auto;height:auto;overflow:visible;background-color:transparent}.d{display:none}}.pf{position:relative;background-color:white;overflow:hidden;margin:0;border:0}.pc{position:absolute;border:0;padding:0;margin:0;top:0;left:0;width:100%;height:100%;overflow:hidden;display:block;transform-origin:0 0;-ms-transform-origin:0 0;-webkit-transform-origin:0 0}.pc.opened{display:block}.bf{position:absolute;border:0;margin:0;top:0;bottom:0;width:100%;height:100%;-ms-user-select:none;-moz-user-select:none;-webkit-user-select:none;user-select:none}.bi{position:absolute;border:0;margin:0;-ms-user-select:none;-moz-user-select:none;-webkit-user-select:none;user-select:none}@media print{.pf{margin:0;box-shadow:none;page-break-after:always;page-break-inside:avoid}@-moz-document url-prefix(){.pf{overflow:visible;border:1px solid #fff}.pc{overflow:visible}}}.c{position:absolute;border:0;padding:0;margin:0;overflow:hidden;display:block}.t{position:absolute;white-space:pre;font-size:1px;transform-origin:0 100%;-ms-transform-origin:0 100%;-webkit-transform-origin:0 100%;unicode-bidi:bidi-override;-moz-font-feature-settings:"liga" 0}.t:after{content:''}.t:before{content:'';display:inline-block}.t span{position:relative;unicode-bidi:bidi-override}._{display:inline-block;color:transparent;z-index:-1}::selection{background:rgba(127,255,255,0.4)}::-moz-selection{background:rgba(127,255,255,0.4)}.pi{display:none}.d{position:absolute;transform-origin:0 100%;-ms-transform-origin:0 100%;-webkit-transform-origin:0 100%}.it{border:0;background-color:rgba(255,255,255,0.0)}.ir:hover{cursor:pointer}</style>
<style type="text/css">
@keyframes fadein{from{opacity:0}to{opacity:1}}@-webkit-keyframes fadein{from{opacity:0}to{opacity:1}}@keyframes swing{0%{transform:rotate(0deg)}10%{transform:rotate(0deg)}90%{transform:rotate(720deg)}100%{transform:rotate(720deg)}}@-webkit-keyframes swing{0%{-webkit-transform:rotate(0deg)}10%{-webkit-transform:rotate(0deg)}90%{-webkit-transform:rotate(720deg)}100%{-webkit-transform:rotate(720deg)}}@media screen{#sidebar{background-color:#2f3236;background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjNDAzYzNmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDBMNCA0Wk00IDBMMCA0WiIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2U9IiMxZTI5MmQiPjwvcGF0aD4KPC9zdmc+")}#outline{font-family:Georgia,Times,"Times New Roman",serif;font-size:13px;margin:2em 1em}#outline ul{padding:0}#outline li{list-style-type:none;margin:1em 0}#outline li>ul{margin-left:1em}#outline a,#outline a:visited,#outline a:hover,#outline a:active{line-height:1.2;color:#e8e8e8;text-overflow:ellipsis;white-space:nowrap;text-decoration:none;display:block;overflow:hidden;outline:0}#outline a:hover{color:#0cf}#page-container{background-color:#9e9e9e;background-image:url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjOWU5ZTllIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9IiM4ODgiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4=");-webkit-transition:left 500ms;transition:left 500ms}.pf{margin:13px auto;box-shadow:1px 1px 3px 1px #333;border-collapse:separate}.pc.opened{-webkit-animation:fadein 100ms;animation:fadein 100ms}.loading-indicator.active{-webkit-animation:swing 1.5s ease-in-out .01s infinite alternate none;animation:swing 1.5s ease-in-out .01s infinite alternate none}.checked{background:no-repeat url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3goQDSYgDiGofgAAAslJREFUOMvtlM9LFGEYx7/vvOPM6ywuuyPFihWFBUsdNnA6KLIh+QPx4KWExULdHQ/9A9EfUodYmATDYg/iRewQzklFWxcEBcGgEplDkDtI6sw4PzrIbrOuedBb9MALD7zv+3m+z4/3Bf7bZS2bzQIAcrmcMDExcTeXy10DAFVVAQDksgFUVZ1ljD3yfd+0LOuFpmnvVVW9GHhkZAQcxwkNDQ2FSCQyRMgJxnVdy7KstKZpn7nwha6urqqfTqfPBAJAuVymlNLXoigOhfd5nmeiKL5TVTV+lmIKwAOA7u5u6Lped2BsbOwjY6yf4zgQQkAIAcedaPR9H67r3uYBQFEUFItFtLe332lpaVkUBOHK3t5eRtf1DwAwODiIubk5DA8PM8bYW1EU+wEgCIJqsCAIQAiB7/u253k2BQDDMJBKpa4mEon5eDx+UxAESJL0uK2t7XosFlvSdf0QAEmlUnlRFJ9Waho2Qghc1/U9z3uWz+eX+Wr+lL6SZfleEAQIggA8z6OpqSknimIvYyybSCReMsZ6TislhCAIAti2Dc/zejVNWwCAavN8339j27YbTg0AGGM3WltbP4WhlRWq6Q/btrs1TVsYHx+vNgqKoqBUKn2NRqPFxsbGJzzP05puUlpt0ukyOI6z7zjOwNTU1OLo6CgmJyf/gA3DgKIoWF1d/cIY24/FYgOU0pp0z/Ityzo8Pj5OTk9PbwHA+vp6zWghDC+VSiuRSOQgGo32UErJ38CO42wdHR09LBQK3zKZDDY2NupmFmF4R0cHVlZWlmRZ/iVJUn9FeWWcCCE4ODjYtG27Z2Zm5juAOmgdGAB2d3cBADs7O8uSJN2SZfl+WKlpmpumaT6Yn58vn/fs6XmbhmHMNjc3tzDGFI7jYJrm5vb29sDa2trPC/9aiqJUy5pOp4f6+vqeJ5PJBAB0dnZe/t8NBajx/z37Df5OGX8d13xzAAAAAElFTkSuQmCC)}}</style>
<style type="text/css">
.ff0{font-family:sans-serif;visibility:hidden;}
@font-face{font-family:ff1;src:url('font.woff')format("woff");}.ff1{font-family:ff1;line-height:1.432000;font-style:normal;font-weight:normal;visibility:visible;}
.m0{transform:matrix(0.250000,0.000000,0.000000,0.250000,0,0);-ms-transform:matrix(0.250000,0.000000,0.000000,0.250000,0,0);-webkit-transform:matrix(0.250000,0.000000,0.000000,0.250000,0,0);}
.v0{vertical-align:0.000000px;}
.ls0{letter-spacing:0.000000px;}
.sc_{text-shadow:none;}
.sc0{text-shadow:-0.015em 0 transparent,0 0.015em transparent,0.015em 0 transparent,0 -0.015em  transparent;}
@media screen and (-webkit-min-device-pixel-ratio:0){
.sc_{-webkit-text-stroke:0px transparent;}
.sc0{-webkit-text-stroke:0.015em transparent;text-shadow:none;}
}
.ws0{word-spacing:0.000000px;}
._7{margin-left:-926.036000px;}
._b{margin-left:-630.084000px;}
._9{width:18.536000px;}
._0{width:30.560000px;}
._2{width:33.280000px;}
._4{width:42.204000px;}
._1{width:60.880000px;}
._5{width:62.996000px;}
._6{width:147.024000px;}
._c{width:275.240000px;}
._a{width:352.404000px;}
._8{width:627.776000px;}
._3{width:797.728000px;}
.fc0{color:rgb(0,0,0);}
.fs5{font-size:24.000000px;}
.fs3{font-size:28.000000px;}
.fs4{font-size:32.000000px;}
.fs1{font-size:36.000000px;}
.fs0{font-size:40.000000px;}
.fs2{font-size:64.000000px;}
.y0{bottom:111.120000px;}
.y35{bottom:116.300000px;}
.y34{bottom:178.300000px;}
.y33{bottom:179.350000px;}
.y32{bottom:189.300000px;}
.y37{bottom:202.920000px;}
.y36{bottom:214.920000px;}
.y1b{bottom:228.350000px;}
.y2c{bottom:248.350000px;}
.y2a{bottom:268.350000px;}
.y31{bottom:273.030000px;}
.y30{bottom:283.500000px;}
.y2b{bottom:288.350000px;}
.y2f{bottom:293.980000px;}
.y2e{bottom:304.450000px;}
.y29{bottom:309.350000px;}
.y2d{bottom:325.350000px;}
.y28{bottom:329.350000px;}
.y24{bottom:338.920000px;}
.y27{bottom:348.350000px;}
.y1a{bottom:358.920000px;}
.y20{bottom:368.350000px;}
.y23{bottom:385.500000px;}
.y22{bottom:395.980000px;}
.y21{bottom:406.450000px;}
.y1f{bottom:416.350000px;}
.y25{bottom:427.920000px;}
.y26{bottom:437.350000px;}
.y1c{bottom:454.110000px;}
.y19{bottom:497.300000px;}
.y18{bottom:511.350000px;}
.y17{bottom:521.920000px;}
.y16{bottom:531.350000px;}
.y14{bottom:551.350000px;}
.y15{bottom:552.300000px;}
.y11{bottom:561.920000px;}
.y13{bottom:571.350000px;}
.y12{bottom:572.350000px;}
.yd{bottom:589.780000px;}
.yc{bottom:599.090000px;}
.y10{bottom:600.400000px;}
.ye{bottom:603.450000px;}
.yb{bottom:608.400000px;}
.yf{bottom:620.350000px;}
.ya{bottom:621.350000px;}
.y1e{bottom:638.450000px;}
.y9{bottom:639.110000px;}
.y1d{bottom:651.450000px;}
.y7{bottom:719.500000px;}
.y5{bottom:742.680000px;}
.y4{bottom:754.680000px;}
.y3{bottom:766.680000px;}
.y8{bottom:781.320000px;}
.y6{bottom:796.820000px;}
.y2{bottom:811.680000px;}
.y1{bottom:827.320000px;}
.h7{height:27.552000px;}
.h5{height:32.144000px;}
.h6{height:36.736000px;}
.h3{height:41.328000px;}
.h2{height:45.920000px;}
.h4{height:73.472000px;}
.h1{height:705.600000px;}
.h0{height:862.000000px;}
.w1{width:576.000000px;}
.w0{width:595.000000px;}
.x0{left:18.960000px;}
.x8{left:23.000000px;}
.x7{left:25.000000px;}
.xd{left:27.000000px;}
.x1f{left:29.000000px;}
.x2{left:35.000000px;}
.x3{left:37.000000px;}
.x22{left:135.000000px;}
.x19{left:137.000000px;}
.x6{left:153.540000px;}
.x5{left:164.330000px;}
.x1{left:165.820000px;}
.xf{left:196.000000px;}
.xe{left:198.000000px;}
.x17{left:230.000000px;}
.x21{left:232.000000px;}
.x18{left:234.000000px;}
.x1c{left:295.000000px;}
.x1b{left:297.000000px;}
.x10{left:315.000000px;}
.x13{left:324.000000px;}
.x1e{left:345.000000px;}
.x1d{left:348.000000px;}
.x9{left:385.000000px;}
.xa{left:386.550000px;}
.x20{left:419.000000px;}
.x12{left:422.000000px;}
.x14{left:424.000000px;}
.xc{left:480.000000px;}
.x4{left:492.960000px;}
.x16{left:494.450000px;}
.xb{left:500.840000px;}
.x15{left:506.300000px;}
.x1a{left:524.960000px;}
.x11{left:537.470000px;}
@media print{
.v0{vertical-align:0.000000pt;}
.ls0{letter-spacing:0.000000pt;}
.ws0{word-spacing:0.000000pt;}
._7{margin-left:-1234.714667pt;}
._b{margin-left:-840.112000pt;}
._9{width:24.714667pt;}
._0{width:40.746667pt;}
._2{width:44.373333pt;}
._4{width:56.272000pt;}
._1{width:81.173333pt;}
._5{width:83.994667pt;}
._6{width:196.032000pt;}
._c{width:366.986667pt;}
._a{width:469.872000pt;}
._8{width:837.034667pt;}
._3{width:1063.637333pt;}
.fs5{font-size:32.000000pt;}
.fs3{font-size:37.333333pt;}
.fs4{font-size:42.666667pt;}
.fs1{font-size:48.000000pt;}
.fs0{font-size:53.333333pt;}
.fs2{font-size:85.333333pt;}
.y0{bottom:148.160000pt;}
.y35{bottom:155.066667pt;}
.y34{bottom:237.733333pt;}
.y33{bottom:239.133333pt;}
.y32{bottom:252.400000pt;}
.y37{bottom:270.560000pt;}
.y36{bottom:286.560000pt;}
.y1b{bottom:304.466667pt;}
.y2c{bottom:331.133333pt;}
.y2a{bottom:357.800000pt;}
.y31{bottom:364.040000pt;}
.y30{bottom:378.000000pt;}
.y2b{bottom:384.466667pt;}
.y2f{bottom:391.973333pt;}
.y2e{bottom:405.933333pt;}
.y29{bottom:412.466667pt;}
.y2d{bottom:433.800000pt;}
.y28{bottom:439.133333pt;}
.y24{bottom:451.893333pt;}
.y27{bottom:464.466667pt;}
.y1a{bottom:478.560000pt;}
.y20{bottom:491.133333pt;}
.y23{bottom:514.000000pt;}
.y22{bottom:527.973333pt;}
.y21{bottom:541.933333pt;}
.y1f{bottom:555.133333pt;}
.y25{bottom:570.560000pt;}
.y26{bottom:583.133333pt;}
.y1c{bottom:605.480000pt;}
.y19{bottom:663.066667pt;}
.y18{bottom:681.800000pt;}
.y17{bottom:695.893333pt;}
.y16{bottom:708.466667pt;}
.y14{bottom:735.133333pt;}
.y15{bottom:736.400000pt;}
.y11{bottom:749.226667pt;}
.y13{bottom:761.800000pt;}
.y12{bottom:763.133333pt;}
.yd{bottom:786.373333pt;}
.yc{bottom:798.786667pt;}
.y10{bottom:800.533333pt;}
.ye{bottom:804.600000pt;}
.yb{bottom:811.200000pt;}
.yf{bottom:827.133333pt;}
.ya{bottom:828.466667pt;}
.y1e{bottom:851.266667pt;}
.y9{bottom:852.146667pt;}
.y1d{bottom:868.600000pt;}
.y7{bottom:959.333333pt;}
.y5{bottom:990.240000pt;}
.y4{bottom:1006.240000pt;}
.y3{bottom:1022.240000pt;}
.y8{bottom:1041.760000pt;}
.y6{bottom:1062.426667pt;}
.y2{bottom:1082.240000pt;}
.y1{bottom:1103.093333pt;}
.h7{height:36.736000pt;}
.h5{height:42.858667pt;}
.h6{height:48.981333pt;}
.h3{height:55.104000pt;}
.h2{height:61.226667pt;}
.h4{height:97.962667pt;}
.h1{height:940.800000pt;}
.h0{height:1149.333333pt;}
.w1{width:768.000000pt;}
.w0{width:793.333333pt;}
.x0{left:25.280000pt;}
.x8{left:30.666667pt;}
.x7{left:33.333333pt;}
.xd{left:36.000000pt;}
.x1f{left:38.666667pt;}
.x2{left:46.666667pt;}
.x3{left:49.333333pt;}
.x22{left:180.000000pt;}
.x19{left:182.666667pt;}
.x6{left:204.720000pt;}
.x5{left:219.106667pt;}
.x1{left:221.093333pt;}
.xf{left:261.333333pt;}
.xe{left:264.000000pt;}
.x17{left:306.666667pt;}
.x21{left:309.333333pt;}
.x18{left:312.000000pt;}
.x1c{left:393.333333pt;}
.x1b{left:396.000000pt;}
.x10{left:420.000000pt;}
.x13{left:432.000000pt;}
.x1e{left:460.000000pt;}
.x1d{left:464.000000pt;}
.x9{left:513.333333pt;}
.xa{left:515.400000pt;}
.x20{left:558.666667pt;}
.x12{left:562.666667pt;}
.x14{left:565.333333pt;}
.xc{left:640.000000pt;}
.x4{left:657.280000pt;}
.x16{left:659.266667pt;}
.xb{left:667.786667pt;}
.x15{left:675.066667pt;}
.x1a{left:699.946667pt;}
.x11{left:716.626667pt;}
}
</style>
<title>helper</title>
</head>
<body>
<div id="sidebar">
<div id="outline">
</div>
</div>
<div id="page-container">
<center><button style="margin-top:10px" onclick="window.print();" title="Imprimir">Imprimir</button></center>
// <div id="pf1" class="pf w0 h0" data-page-no="1"><div class="pc pc1 w0 h0"><img class="bi x0 y0 w1 h1" alt="" src="boleto.png"/><div class="t m0 x1 h2 y1 ff1 fs0 fc0 sc0 ls0 ws0">Instruções de pagamento pelo Internet Banking ou Caixa</div><div class="t m0 x2 h3 y2 ff1 fs1 fc0 sc0 ls0 ws0">Copie a sequência numérica abaixo e pague no caixa eletrônico ou por internet banking:</div><div class="t m0 x2 h3 y3 ff1 fs1 fc0 sc0 ls0 ws0">Imprima em impressora jato de tinta (ink jet) ou laser em qualidade normal ou alta (Não use modo econômico)</div><div class="t m0 x2 h3 y4 ff1 fs1 fc0 sc0 ls0 ws0">Não rasure, risque, fure ou dobre a região onde se encontra o código de barras.</div><div class="t m0 x2 h3 y5 ff1 fs1 fc0 sc0 ls0 ws0">Caso não apareça o código de barras no final, clique em F5 para atualizar esta tela.</div><div class="t m0 x3 h2 y6 ff1 fs0 fc0 sc0 ls0 ws0">Linha Digitável:<span class="_ _0"> </span><?php echo $digitos; ?><span class="_ _1"> </span>Valor: R$<span class="_ _2"> </span><?php echo 500; ?></div><div class="t m0 x4 h2 y7 ff1 fs0 fc0 sc0 ls0 ws0">Recido do sacado</div><div class="t m0 x5 h2 y8 ff1 fs0 fc0 sc0 ls0 ws0">Instruções de pagamento em agência bancária ou lotérica</div><div class="t m0 x6 h4 y9 ff1 fs2 fc0 sc0 ls0 ws0">237-2</div><div class="t m0 x7 h5 ya ff1 fs3 fc0 sc0 ls0 ws0">Beneficiário<span class="_ _3"> </span>Agência/Código do Beneficiário</div><div class="t m0 x8 h6 yb ff1 fs4 fc0 sc0 ls0 ws0">MercadoPago.com Representações Ltda</div><div class="t m0 x8 h6 yc ff1 fs4 fc0 sc0 ls0 ws0">CNPJ 10.573.521/0001-91</div><div class="t m0 x8 h6 yd ff1 fs4 fc0 sc0 ls0 ws0">Av. das Nações Unidas, nº 3.003 Bonfim - CEP: 06233-903</div><div class="t m0 x9 h3 ye ff1 fs1 fc0 sc0 ls0 ws0">Real</div><div class="t m0 xa h5 yf ff1 fs3 fc0 sc0 ls0 ws0">Espécie<span class="_ _4"> </span>Quantidade</div><div class="t m0 xb h6 y10 ff1 fs4 fc0 sc0 ls0 ws0">78/17165573610-5</div><div class="t m0 xc h5 yf ff1 fs3 fc0 sc0 ls0 ws0">Nosso número</div><div class="t m0 xd h3 y11 ff1 fs1 fc0 sc0 ls0 ws0">3557661171</div><div class="t m0 x7 h5 y12 ff1 fs3 fc0 sc0 ls0 ws0">Número de documento</div><div class="t m0 xe h3 y11 ff1 fs1 fc0 sc0 ls0 ws0"><?php echo str_replace(".", "",  str_replace("-", "", $cpf)); ?></div><div class="t m0 xf h5 y12 ff1 fs3 fc0 sc0 ls0 ws0">CPF/CNPJ</div><div class="t m0 x10 h3 y11 ff1 fs1 fc0 sc0 ls0 ws0"><?php echo $vencimento; ?></div><div class="t m0 x10 h5 y12 ff1 fs3 fc0 sc0 ls0 ws0">Vencimento</div><div class="t m0 x11 h3 y11 ff1 fs1 fc0 sc0 ls0 ws0"></span>R$<span class="_"> </span><?php echo 500; ?></div><div class="t m0 x12 h5 y13 ff1 fs3 fc0 sc0 ls0 ws0">Valor Documento</div><div class="t m0 x8 h5 y14 ff1 fs3 fc0 sc0 ls0 ws0">(-) Desconto / Abatimentos<span class="_ _5"> </span>(-) Outras deduções<span class="_ _6"> </span>(+) Mora / Multa</div><div class="t m0 x13 h7 y15 ff1 fs5 fc0 sc0 ls0 ws0">(+) Outros acréscimos</div><div class="t m0 x14 h5 y14 ff1 fs3 fc0 sc0 ls0 ws0">(=) Valor cobrado</div><div class="t m0 x7 h5 y16 ff1 fs3 fc0 sc0 ls0 ws0">Sacado</div><div class="t m0 xd h3 y17 ff1 fs1 fc0 sc0 ls0 ws0"><?php echo $nome; ?></div><div class="t m0 x2 h2 y18 ff1 fs2 fc0 sc0 ls0 ws0">23793.38128 60004.819235 00000.050807 5 90380000050000</div><div class="t m0 xb h5 y18 ff1 fs3 fc0 sc0 ls0 ws0">Autenticação mecânica</div><div class="t m0 x15 h7 y19 ff1 fs5 fc0 sc0 ls0 ws0">Corte na linha pontilhada</div><div class="t m0 x16 h3 y1a ff1 fs1 fc0 sc0 ls0 ws0">78/17165573610-5</div><div class="t m0 x7 h5 y1b ff1 fs3 fc0 sc0 ls0 ws0">Sacado</div><div class="t m0 x6 h4 y1c ff1 fs2 fc0 sc0 ls0 ws0">237-2</div><div class="t m0 x6 h4 y1c ff1 fs2 fc0 sc0 ls0 ws0" style="font-size:300%;margin-left:10%;margin-top:1.5%;"><?php echo $digitos; ?></div><div class="t m0 x17 h3 y1d ff1 fs1 fc0 sc0 ls0 ws0">Número de Pedido: 8744041936</div><div class="t m0 x17 h3 y1e ff1 fs1 fc0 sc0 ls0 ws0"><?php echo $produto; ?></div><div class="t m0 x12 h5 y1f ff1 fs3 fc0 sc0 ls0 ws0">Agência/Código do Beneficiário</div><div class="t m0 x12 h5 y20 ff1 fs3 fc0 sc0 ls0 ws0">Nosso número</div><div class="t m0 x18 h3 y1a ff1 fs1 fc0 sc0 ls0 ws0">Outro<span class="_ _7"></span><?php echo $emitido; ?></div><div class="t m0 x7 h5 y1f ff1 fs3 fc0 sc0 ls0 ws0">Beneficiário</div><div class="t m0 x8 h3 y21 ff1 fs1 fc0 sc0 ls0 ws0">MercadoPago.com Representações Ltda</div><div class="t m0 x8 h3 y22 ff1 fs1 fc0 sc0 ls0 ws0">CNPJ 10.573.521/0001-91</div><div class="t m0 x8 h3 y23 ff1 fs1 fc0 sc0 ls0 ws0">Av. das Nações Unidas, nº 3.003 Bonfim - CEP: 06233-903</div><div class="t m0 x19 h3 y24 ff1 fs1 fc0 sc0 ls0 ws0">26</div><div class="t m0 x7 h3 y25 ff1 fs1 fc0 sc0 ls0 ws0">Pagável em qualquer Banco até o vencimento</div><div class="t m0 x8 h5 y26 ff1 fs3 fc0 sc0 ls0 ws0">Local de pagamento</div><div class="t m0 x1a h3 y25 ff1 fs1 fc0 sc0 ls0 ws0"><?php echo $vencimento; ?></div><div class="t m0 x12 h5 y26 ff1 fs3 fc0 sc0 ls0 ws0">Vencimento</div><div class="t m0 x1b h3 y1a ff1 fs1 fc0 sc0 ls0 ws0">N</div><div class="t m0 x1c h5 y20 ff1 fs3 fc0 sc0 ls0 ws0">Aceite</div><div class="t m0 x1d h3 y1a ff1 fs1 fc0 sc0 ls0 ws0"><?php echo $emitido; ?></div><div class="t m0 x1e h5 y20 ff1 fs3 fc0 sc0 ls0 ws0">Data processamento</div><div class="t m0 x18 h3 y24 ff1 fs1 fc0 sc0 ls0 ws0">Real</div><div class="t m0 x1c h5 y27 ff1 fs3 fc0 sc0 ls0 ws0">Quantidade</div><div class="t m0 x1d h3 y24 ff1 fs1 fc0 sc0 ls0 ws0"></span>R$<span class="_"> </span><?php echo 500; ?><span class="_ _8"> </span></span>R$<span class="_"> </span><?php echo 500; ?></div><div class="t m0 x12 h5 y27 ff1 fs3 fc0 sc0 ls0 ws0">(=) Valor documento</div><div class="t m0 x12 h5 y28 ff1 fs3 fc0 sc0 ls0 ws0">(-) Desconto / Abatimentos</div><div class="t m0 x12 h5 y29 ff1 fs3 fc0 sc0 ls0 ws0">(-) Outras deduções</div><div class="t m0 x12 h5 y2a ff1 fs3 fc0 sc0 ls0 ws0">(+) Outros acréscimos</div><div class="t m0 x12 h5 y2b ff1 fs3 fc0 sc0 ls0 ws0">(+) Mora / Multa</div><div class="t m0 x12 h5 y2c ff1 fs3 fc0 sc0 ls0 ws0">(=) Valor cobrado</div><div class="t m0 x1f h5 y2d ff1 fs3 fc0 sc0 ls0 ws0">Instruções (Texto de responsabilidade do Beneficiário)</div><div class="t m0 x1f h3 y2e ff1 fs1 fc0 sc0 ls0 ws0">Não receber Pagamento em Cheque</div><div class="t m0 x1f h3 y2f ff1 fs1 fc0 sc0 ls0 ws0">Boleto com vencimento no final de semana, poderá ser pago no próximo dia útil</div><div class="t m0 x1f h3 y30 ff1 fs1 fc0 sc0 ls0 ws0">Se tiver algum problema com a compra, acesse</div><div class="t m0 x1f h3 y31 ff1 fs1 fc0 sc0 ls0 ws0">https://www.mercadopago.com.br/ajuda</div><div class="t m0 x12 h7 y32 ff1 fs5 fc0 sc0 ls0 ws0">Cód. baixa</div><div class="t m0 x20 h5 y33 ff1 fs3 fc0 sc0 ls0 ws0">Autenticação mecânica<span class="_ _9"> </span>Ficha de Compensação</div><div class="t m0 x7 h7 y34 ff1 fs5 fc0 sc0 ls0 ws0">Sacador/Avalista</div><img src="barcode.php?digitos=<?php echo str_replace(" ", "", str_replace(".", "", $digitos)); ?>" style="margin-left:3%;width:79%;margin-top: 116%;position: absolute;"><div class="t m0 x15 h7 y35 ff1 fs5 fc0 sc0 ls0 ws0">Corte na linha pontilhada</div><div class="t m0 x1f h3 y36 ff1 fs1 fc0 sc0 ls0 ws0"><?php echo $nome; ?></div><div class="t m0 x1f h3 y37 ff1 fs1 fc0 sc0 ls0 ws0">mercadolivre.com.br</div><div class="t m0 x21 h5 y20 ff1 fs3 fc0 sc0 ls0 ws0">Espécie doc.</div><div class="t m0 x21 h5 y27 ff1 fs3 fc0 sc0 ls0 ws0">Espécie<span class="_ _a"> </span>Valor Documento</div><div class="t m0 x19 h3 y1a ff1 fs1 fc0 sc0 ls0 ws0">3557661171</div><div class="t m0 x22 h5 y20 ff1 fs3 fc0 sc0 ls0 ws0">No documento<span class="_ _b"></span>Data do documento</div><div class="t m0 x8 h5 y27 ff1 fs3 fc0 sc0 ls0 ws0">Uso do banco<span class="_ _c"> </span>Carteira</div></div><div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div></div>
</div>
<div class="loading-indicator">
</div>
</body>
</html>