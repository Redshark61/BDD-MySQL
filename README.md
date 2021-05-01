# Création d'un tuto

Ce projet permet de faire une interface sécurisé pour créer un tuto et l'afficher dans le projet site_perso. Les deux projets sont lié avec la même bdd (base de données).

## Index.php

Cette page est la page de connexion. Deux mots de passe différent sont nécessaire pour se connecter. Une fois connecté ont arrive sur la page **home.php**. Cette page permet de choisir entre

1. Écrire un tuto
2. Lire les tutoriels déjà créé
3. Se déconnecter

## Écrire un tuto

Si on choisis d'écrire un tuto, on se retrouve sur la page **add_commentaire.php**. Cette page comporte plusieurs champs :

-   Un champ input pour le titre
-   Un textarea pour une courte description du tuto
-   Un textarea pour le contenu
-   Et un autre pour, si besoin est, écrire du code si on veut qu'il soit intégré en temps que code brut et non lu comme faisant parti du code source de la page

Le champ titre et description sont les plus simple du formulaire.
En revanche, pour écrire le contenu, il est impératif d'encadrer chaque paragraphe de balise `<p></p>`.

## Le textarea éditeur de code

Cette partie fait intervenir les regex (voir la [doc regex de php](https://www.php.net/manual/fr/function.preg-match.php)). En effet, pour mettre en forme du code, j'utilise la librairie javascript [**Prism.js**](https://prismjs.com/index.html). Cette librairie permet de mettre en forme n'importe quel language de programmation qui s'utilise comme suit :

```html
<pre>
    <code class="language-html">
    <h1>Votre code html</h1>
    </code>
</pre>
```

Le code à mettre en forme doit se trouver entre des balise `<code></code>` elle même dans des balises `<pre></pre>`. Les balises `<code></code>` devront avoir un attribut `class="language-*"` où `*` est le language que vous désirez mettre en forme.

Pour ne pas me compliquer la tâche de devoir à chaque fois écrire les balises et la classe, j'ai créé deux boutons :

-   Un pour transformer mon code en code lisible par Prism.js avec des balises `pre` et `code` automatiquement ajouté
-   Un autre bouton pour copier le code (sans avoir à faire CTRL+A puis CTRL+V)
