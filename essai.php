<?php

$list_shortcut = array(
    'IMG#'=>[
        '<img src ="',
        '">'
    ],
    'H1#'=>[
        '<h1>',
        '</h1>']);
$result = "texte H1#texte# texte texte IMG#capture1.jpg# texte texte texte texte. Gardez-la ouverte avec quelque chose de pas IMG#capture2.jpg# très bien passé. Codes, H1#texte#, ordonnances, et selon toutes leurs issues, et peut-être feras-tu quelques honorables connaissances.";


function change($result, $list_shortcut){
    foreach($list_shortcut as $pattern){
    echo '<pre>'.htmlspecialchars(print_r($pattern[0], true)).'</pre>';
    $result = preg_replace('/'.$pattern[0].'/',$pattern[1], $result);
    $match_end = preg_match_all('/'.$pattern[1].'\S|\.#/', $result, $matches, PREG_OFFSET_CAPTURE);
    //echo '<pre>'.print_r($match_end, true).'</pre>';
    //echo '<pre>'.htmlspecialchars(print_r($matches, true)).'</pre>';
    for ($i=0;$i!=$match_end;$i++){
        $result = str_split($result, $matches[0][$i][1] - 2);
        $result[1] = preg_replace('/#/', $pattern[1],$result[1], 1);
        $result = implode('', $result);
    }
}
    echo '<pre>'.print_r(htmlspecialchars($result), true).'</pre>';

}

change($result, $list_shortcut);