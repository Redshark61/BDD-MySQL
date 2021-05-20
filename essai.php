<?php

$list_shortcut = array(
    'img'=>[
        '<img src="',
        '">'
    ],
    'h1'=>[
        '<h1>',
        '</h1>']);

$result = "texte texte texte texte capture1.jpg texte texte texte texte. Gardez-la ouverte avec quelque chose de pas capture2.jpg très bien passé. Codes, texte, ordonnances, et selon toutes leurs issues, et peut-être feras-tu quelques honorables connaissances.";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="format.js" defer></script>
    <title>Essai</title>
</head>
<body>
<button class="format " id="img">Image</button>
<button class="format " id="h1">Titre 1</button>
    <p><?=$result?></p>
</body>
</html>
