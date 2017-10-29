<?php

include 'simple_html_dom.php';

function dlPage($href) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $href);
    curl_setopt($curl, CURLOPT_REFERER, $href);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str = curl_exec($curl);
    curl_close($curl);
// Create a DOM object
    $dom = new simple_html_dom();
// Load HTML from a string
    $dom->load($str);
    return $dom;
}
function get_text_from_link($link){
    $text=dlPage($link)->plaintext;
    $text=trim(preg_replace('/\s+/', ' ', $text));
    echo $text;
    /*$words=explode(" ",$text);
    for ($i=0;$i<sizeof($words);$i++){
        echo $words[$i]."<br/>";
    }*/
}
if(isset($_POST['link'])&&$_POST['link']!=null){
    get_text_from_link($_POST['link']);
}
