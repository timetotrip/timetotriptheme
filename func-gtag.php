<?php
    function putGtagLink($label){
        $div = "";
        $div .= ' onclick="gtag(';
        $div .= "'event', 'click', {'event_category': 'link', 'event_label': '".$label."'});";
        $div .= '" ';
        return $div;
    }
?>