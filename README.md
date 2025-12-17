# Ina Zaoui

Pour se connecter avec le compte de Ina, il faut utiliser les identifiants suivants:
- identifiant : `ina`
- mot de passe : `password`

Vous trouverez dans le fichier `backup.zip` un dump SQL anonymisé de la base de données et toutes les images qui se trouvaient dans le dossier `public/uploads`.
Faudrait peut être trouver une meilleure solution car le fichier est très gros, il fait plus de 1Go.

# TO-DO

## Étape 1 : Migration vers une version plus récente — 17/12/2025

**Migration et mise à jour de la version du projet**

### Routes

Ancienne façon de faire :

```php
    /**
     * @Route("/guests", name="guests")
     */
```

Nouvelle façon de faire :

```php
    #[Route('/guests', name: 'guests')]
```

# Auto-évaluation

## Tester une application web pour assurer sa qualité

- [ ] J’ai testé toutes les fonctionnalités présentes dans le “Front Office”.  
- [ ] J’ai implémenté un jeu de données (fixtures). ((( utiliser Faker )))  
- [ ] Le site est fonctionnel et ne comporte aucune erreur d’affichage.  
- [ ] J’ai inclus le rapport de tests dans le repository.  
- [ ] La couverture de code est de minimum 70%.  

## Débugger une application web pour assurer son bon fonctionnement

- [ ] J’ai migré le projet sur la version LTS ou la dernière version en date de Symfony. (de 5.4.* à 7.4.2)  
- [ ] Je suis capable de justifier mon choix de version de migration.  
- [ ] Je suis capable d'expliquer la roadmap de Symfony.  
- [ ] Le code fonctionne correctement, sans aucun bug.  
- [ ] J’ai ajouté une vérification du fichier uploadé : Le composant “Validation” est utilisé pour vérifier le type et le poids du fichier.  
- [ ] J’ai ajouté une vérification du fichier uploadé : La vérification du type est effectuée avec le “mime type”.  
- [ ] J’ai ajouté une vérification du fichier uploadé : Un message d’erreur explicite est visible par l’utilisateur si le fichier n’est pas le bon type ou si son poids excède 2 Mégaoctets.  
- [ ] Les données sont chargées depuis la base de données à l’authentification : La section “providers” est bien paramétrée dans le fichier “security.yaml”.  
- [ ] La gestion des “invités” permet désormais uniquement à Ina de :  
    - [ ] Lister les invités, contenant son nom et son statut (actif ou bloqué).  
    - [ ] Ajouter un invité.  
    - [ ] Bloquer l’accès d’un invité.  
    - [ ] Supprimer un invité et le contenu associé.  
- [ ] Je suis capable d’expliquer comment j’ai résolu les bugs.  

## Documenter une solution informatique

### Fichier README.md

- [ ] J’ai détaillé l'étape : Pré-requis.  
- [ ] J’ai détaillé l'étape : Installation.  
- [ ] J’ai détaillé l'étape : Usage.  
- [ ] La documentation est claire pour le développeur.  
- [ ] La documentation communique le fonctionnement du code.  

### Fichier CONTRIBUTING.md

- [ ] J’ai détaillé le mode opératoir pour bien contribuer au projet :  
    - [ ] Workflow Github (Issues, Pull Request, Code Review).  
    - [ ] Respect des bonnes pratiques.  
    - [ ] Utilisation des tests et outils d’analyse statique.  
- [ ] La documentation est claire pour le développeur.  
- [ ] La documentation contient des conseils sur l’utilisation et la maintenance du code.  

## Optimiser la performance d'un site web

- [ ] J’ai corrigé les lenteurs sur la page “Invités”.  
- [ ] Je suis capable d'identifier l’origine des lenteurs.  

### Rapport de performance

- [ ] Le rapport de performance contient :  
    - [ ] Au moins 2 indicateurs pertinents (par exemple : temps d'exécution, la consommation mémoire, le nombre de requêtes SQL).  
    - [ ] Une analyse de chaque page de la partie Front Office du site web.  
- [ ] Je suis capable de justifier mon choix d’outil pour le rapport de performance.  

## Déployer un site en production

- [ ] Le pipeline d’intégration continue passe sans erreur :  
    - [ ] Le pipeline d’intégration du dernier commit doit être en succès.  
    - [ ] Les tests unitaires et fonctionnelles doivent être exécutés.  
    - [ ] Le ou les outils d’analyse utilisés doit être exécuté.  
