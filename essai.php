<?php

$list_shortcut = array('IMG#'=>'<img src', 'H1#'=>'<h1>');
$result = "texte H1#texte# texte texte IMG#capture1.jpg# texte texte texte texte. Gardez-la ouverte avec quelque chose de pas IMG#capture2.jpg# très bien passé. Codes, H1#texte#, ordonnances, et selon toutes leurs issues, et peut-être feras-tu quelques honorables connaissances.";

function change($result, $list_shortcut){
    $result = preg_replace('/IMG#/','<img src ="', $result);

    $result = preg_split('/(<img src =")/', $result, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    // for ($i=0;$i!=count($result);$i++){
    //     $matched_end = preg_match_all('/[(0-9A-Z){0}]#/', $result[$i], $matche_end, PREG_OFFSET_CAPTURE);
    //     if(!$matched_end){
            
    //         $result[$i] = preg_replace('/#/','">', $result[$i]);
            
    //     }
    // }
    $result = implode(' ', $result);
    $matched = preg_match_all('/<img src/', $result, $matche_end, PREG_OFFSET_CAPTURE);
    echo '<pre>'.print_r($matche_end, true).'</pre>';
    for ($i=0; $i!=count($matche_end); $i++){
        $result = substr_replace($result, '">', $matche_end[0][$i][1], 1);
    }
    
    echo htmlspecialchars($result). '<br>';
}

change($result, $list_shortcut);