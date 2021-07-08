<?php

    $nome = value($result, '<h1 class="item-title__primary ">', '</h1>');
    $result = str_replace($nome, $nome_produto, $result);
    
    $valor_original_reais = value($result, '<span class="price-tag-fraction">', '</span>');
    if (empty($valor_original_reais)) {
        $valor_original_reais = value($result, '<span class="price-tag-fraction" data-js="price_fraction">', '</span>');
        $result = str_replace($valor_original_reais, $preco_produto[0], $result);
    }else{
        $result = str_replace($valor_original_reais, $preco_produto[0], $result);
    }

    $valor_original_cents = value($result, '<span class="price-tag-cents">', '</span>');
    if (empty($valor_original_cents)) {
        $valor_original_cents = value($result, '<span class="price-tag-cents" data-js="price_cents">', '</span>');
        $result = str_replace($valor_original_cents, $preco_produto[1], $result);
    }else{
        $result = str_replace($valor_original_cents, $preco_produto[1], $result);
    }
        
    $red = value($result, '<form action="', '"');
    $result = str_replace($red, '../../carrinho/', $result);
    
    $a = value($result, '<input type="hidden" name="item_id" value="', '">');
    $result = str_replace($a, $id, $result);
    
    $b = value($result, 'formaction="', '">');
    $result = str_replace($b, '../../carrinho/', $result);

    $parcela = value($result, '<strong class="ch-price" data-block="price">', '</strong>');
    $dividir_parcela = $row['preco']/12;
    $valor_parcela = explode('.', $dividir_parcela);
    $result = str_replace($parcela, "R$ ".$valor_parcela[0]."<sup>".substr($valor_parcela[1], 0, 2)."</sup>", $result);

    $frete = value($result, '<fieldset class="vip-shipping-method " data-component="shippingRow">', '</fieldset>');
    $frete_gratis = '<article class="shipment-methods free-shipping"><div data-block="shipping-detail"><div class="ui-icon--content" data-block="shipping-icon"><svg viewBox="0 0 100 100" role="presentation" class="ui-icon ui-icon--free-shipping green"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ui-icon--free-shipping"></use></svg></div><p class="shipping-method-title shipping-text free-shipping" data-block="shipping-method-title">Frete grátis</p><div data-block="shipping-feedback"></div><p data-block="shipping-method-place" class="custom-address"></p><p class="op-font-small"></p><p data-block="shipping-method-detail">Saiba os prazos de entrega e as formas de envio.</p><input type="hidden" name="zip_code" value="" disabled/><input type="hidden" name="selected_shipping" value="" disabled/></div><div class="ui-message warning-message" data-block="shipping-warning-message" data-state="invisible"><div class="ui-message__icon"><svg viewBox="0 0 100 100" role="presentation" class="ui-icon ui-icon--question-blocked"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ui-icon--question-blocked"></use></svg></div><p class="item-status-notification__title"></p></div></article>';
    $result = str_replace($frete, $frete_gratis, $result);

?>