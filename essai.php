<?php

$list_shortcut = array(
    'IMG#'=>[
        '<img src="',
        '">'
    ],
    'H1#'=>[
        '<h1>',
        '</h1>']);
$result = "texte H1#texte# texte texte IMG#capture1.jpg# texte texte texte texte. Gardez-la ouverte avec quelque chose de pas IMG#capture2.jpg# très bien passé. Codes, H1#texte#, ordonnances, et selon toutes leurs issues, et peut-être feras-tu quelques honorables connaissances.";

function change($result, $list_shortcut){
    foreach($list_shortcut as $pattern => $value){
        $replace_pattern = '/'.$pattern.'/';
        $match_new_pattern = '/'.$value[0].'/';
        echo 'Pattenr : <pre>'.htmlspecialchars(print_r($replace_pattern, true)).'</pre>';
        echo 'match_new_pattern : <pre>'.htmlspecialchars(print_r($match_new_pattern, true)).'</pre>';
        $result = preg_replace($replace_pattern,$value[0], $result);
        $match_end = preg_match_all($match_new_pattern, $result, $matches, PREG_OFFSET_CAPTURE);
        echo 'Avant derniere paire : <pre>'.print_r(htmlspecialchars($result), true).'</pre>';
        //echo '<pre>'.print_r($match_end, true).'</pre>';
        for ($i=0;$i!=$match_end;$i++){
            echo '<pre>'.htmlspecialchars(print_r($matches, true)).'</pre>';
            $result = str_split($result, $matches[0][$i][1]-1);
            echo 'Boucle<pre>'.print_r($result, true).'</pre>';
            $result[1] = preg_replace('/#/', $value[1],$result[1], 1);
            $result = implode('', $result);
            $match_end = preg_match_all($match_new_pattern, $result, $matches, PREG_OFFSET_CAPTURE);
        }
}
    echo 'Fin : <pre>'.print_r(htmlspecialchars($result), true).'</pre>';


}

change($result, $list_shortcut);