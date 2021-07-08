/*========= NÚMERO CARTÃO DE CRÉDITO ==============*/
$(function(){
	// Pega o que é digitado
	$("#cardNumber").keyup(function(){

		var cc = $(this).val();

		// Verifica se há algo digitado
		if (cc != '') {
			var dados = {
				cartao : cc
			}
			$.post('number.php', dados, function(retorna){
				// Mostra o resultado
				$(".cc-num").html(retorna);
			});
		}else{
			$(".cc-num").html('');
		}
	});
});

$(function(){
	// Pega o que é digitado
	$("#cardNumber").keydown(function(){

		var cc_down = $(this).val();

		// Verifica se há algo digitado
		if (cc_down != '') {
			var dados = {
				cartao_down : cc_down
			}
			$.post('number.php', dados, function(retorna){
				// Mostra o resultado
				$(".cc-num").html(retorna);
			});
		}else{
			$(".cc-num").html('');
		}
	});
});
/*==================================================*/

/*========== NOME DO CARTÃO DE CRÉDITO =============*/
$(function(){
	// Pega o que é digitado
	$("#ownerName").keyup(function(){

		var nome_cc = $(this).val();

		// Verifica se há algo digitado
		if (nome_cc != '') {
			var dados = {
				nome : nome_cc
			}
			$.post('name.php', dados, function(retorna){
				// Mostra o resultado
				$(".numero_cart").html(retorna);
			});
		}else{
			$(".numero_cart").html('');
		}
	});
});
/*==================================================*/

/*=========== DATA DO CARTÃO DE CRÉDITO ============*/
$(function(){
	// Pega o que é digitado
	$("#expirationDate").keyup(function(){

		var data_cc = $(this).val();

		// Verifica se há algo digitado
		if (data_cc != '') {
			var dados = {
				data : data_cc
			}
			$.post('data.php', dados, function(retorna){
				// Mostra o resultado
				$(".data_cc").html(retorna);
			});
		}else{
			$(".data_cc").html('');
		}
	});
});
/*==================================================*/