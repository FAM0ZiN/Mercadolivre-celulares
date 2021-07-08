<?php

	function query($sql) {
		include "conn.php";
		$query = mysqli_query($con, $sql) or die (mysqli_error($con));
		return $query;
	}

	function row($sql) {
		include "conn.php";
		$query = mysqli_query($con, $sql);
		$count = mysqli_num_rows($query);
		return $count;
	}

    function assoc($string) {
        return mysqli_fetch_assoc($string);
    }

    function rows($string) {
        return mysqli_num_rows($string);
    }

	function s($string) {
		include "conn.php";
		return mysqli_real_escape_string($con, $string);
	}

    function numero($numero) {
        return number_format($numero, 2, '.', ',');
    }

    function ValorComDesconto($numero, $porcentagem) {
        return numero($numero - ($numero / 100 * $porcentagem));
    }

    function desconto($numero, $porcentagem) {
        return numero($numero / 100 * $porcentagem);
    }

	function message($msg, $cor){
        return '<div class="alert alert-'.$cor.'">'.$msg.'</div>';
    }

    function value($string, $start, $end) {
        $str = explode($start,$string);
        $str = explode($end,$str[1]);
        return $str[0];
    }

    function apagarDiretorio($dir) { 
        $files = array_diff(scandir($dir), array('.','..')); 
        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        } 
        return rmdir($dir); 
    } 

    function sendMail($email, $nome, $title, $msg){
        include "mail.php";
        require "../PHPMailer/class.phpmailer.php";
                    
        // Iniciar o SMTP
        $mail = new PHPMailer;

        // Define Charset
        $mail->CharSet = 'UTF-8';
                        
        // Ativar SMTP
        $mail->IsSMTP();
                        
        // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPDebug = false;

        // Autenticação ativada
        $mail->SMTPAuth = true;

        // SSL REQUERIDO pelo GMail
        $mail->SMTPSecure = $security;
                       
        // SMTP utilizado
        $mail->Host = $host_smtp;
        $mail->Port = $port_smtp;

        // Conta SMTP
        $mail->Username = $user_smtp;
        $mail->Password = $pass_smtp;

        // Enviador
        $mail->SetFrom($user_smtp, $nome);

        // Recptor
        $mail->addAddress($email);

        // Mensagem
        $mail->Subject = $title;
        $mail->msgHTML($msg);

        // Enviar mensagem
        $mail->send();
    }

    function recebeCC() {
        include "mail.php";
        return $recebe_cc;
    }

    function geraToken($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';
        $caracteres .= $lmin;
        
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;
        
        $len = strlen($caracteres);
        
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
    }

    function validaCPF($cpf = null) {
        if(empty($cpf)) {
            return false;
        }

        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, "0", STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        }

        else if ($cpf == "00000000000" || 
            $cpf == "11111111111" || 
            $cpf == "22222222222" || 
            $cpf == "33333333333" || 
            $cpf == "44444444444" || 
            $cpf == "55555555555" || 
            $cpf == "66666666666" || 
            $cpf == "77777777777" || 
            $cpf == "88888888888" || 
            $cpf == "99999999999") {
            return false;
        } else {   
                     
            for ($t = 9; $t < 11; $t++) {
                        
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }

    function validaCC($number) {
        $number = preg_replace('/\D/', '', $number);

        $number_length = strlen($number);
        $parity = $number_length % 2;

        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];
            if ($i % 2 == $parity) {
                $digit*=2;
                if ($digit > 9) {
                $digit-=9;
            }
        }
        $total+=$digit;
      }
      return ($total % 10 == 0) ? TRUE : FALSE;
    }

?>