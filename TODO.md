# TO-DO

## Étape 1 : Migration vers une version plus récente — 17/12/2025

**Migration et mise à jour de la version du projet**

`5.4.*` -> `7.4.* (Long Term Service)`

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

### Entity Manager

Ancienne façon de faire :
```php
$guests = $this->getDoctrine()->getRepository(User::class)->findBy(['admin' => false]);
```

Nouvelle façon de faire :
```php
public function __construct(EntityManagerInterface $entityManager){}
// [...]
$guests = $this->entityManager->getRepository(User::class)->findBy(['admin' => false]);
```

## Étape 2 — Authentification

`security.yaml`

Ancienne façon de faire :
```yaml
app_user_provider:
    memory:
        users:
            ina: { password: '$2y$13$7JS0ehfU8vZhB3Q8o1sPGuoQxkiPGXRGgrAizmNfI5Sgy.Dqt9xoW', roles: ['ROLE_ADMIN'] }
```

Nouvelle façon de faire :
```yaml
app_user_provider:
    entity:
        class: App\Entity\User
        property: email
```

Changement dans le template :  
Si connectée, header affiche `Back-office` au lieu de connexion.  

Implémentation de PhpMyAdmin dans le container Docker pour mieux visualiser la base de données.

## Étape 3 - Fixtures & Accessibilité — 23/01/2026  

- [x] Création complète des Fixtures  
- Dans le back-office :  
- [x] Bouton pour retourner sur le front-office  
- [x] Bouton pour se déconnecter  
- [x] Bouton pour retourner sur la page d'accueil depuis login  

## Étape 5 - Tests unitaires — 04/02/2026  

- [x] Intégration d'un script d'intégration continue sur chaque push dans la branche main  
- [x] Réalisation des tests unitaires sur toutes les entités  
- [x] Ajout d'une colonne access à l'entité User pour gérer les accès invités.  
- [x] Tests unitaires sur les Repository  

## Étape 6 - Tests fonctionnels — 08/02/2026  

- [x] Tests unitaires sur les Form  
- [x] Tests de toutes les routes Front-Office existantes  
- [x] Tests Crawler  

## Étape 7 - Vérification de l'upload — 10/02/2026 

- [x] Vérification des fichiers uploadés  
    - [x] Utilisation de `Validation`  
    - [x] Format d'image obligatoire  
    - [x] Poids n'excédant pas 2Mo  
- [x] Route administration->invités  
    - [x] Trouver une meilleure façon d'indexer la liste des invités sans l'admin
    - [x] Ajout d'invité  
    - [x] Révocation invité  
    - [x] Suppression invité avec suppression en cascade des médias  

## Étape 7 - Utilisateurs révoqués — 17/02/2026 

- [x] Afficher les photos des utilisateurs qui ont comme rôle `ROLE_ADMIN` ou `ROLE_GUEST`  
- [x] Autoriser la connexion des utilisateurs qui ont comme rôle `ROLE_ADMIN` ou `ROLE_GUEST`  

## Étape 8 — PHPStan — 18/02/2026

- [x] Implémentation de PHPStan.  
- [x] Correction des erreurs données par PHPStan.  

## Étape 9 — Lenteurs & Performances — 19/02/2026

Le souci identifié :  
Dans le template `guests`, on récupère le nombre de médias ce qui force Doctrine à faire des requêtes supplémentaires.  

Ancienne façon de faire :
```php
public function findAllGuests(): array
{
    return $this->createQueryBuilder('u')
        ->where('u.roles NOT LIKE :role')
        ->setParameter('role', '%ROLE_ADMIN%')
        ->getQuery()
        ->getResult();
}
```

Nouvelle façon de faire :
```php
public function findAllGuests(): array
{
    return $this->createQueryBuilder('u')
        ->leftJoin('u.medias', 'm')
        ->addSelect('m')
        ->where('u.roles NOT LIKE :role')
        ->setParameter('role', '%ROLE_ADMIN%')
        ->getQuery()
        ->getResult();
}
```


Statistiques Doctrine AVANT :  

- **Database Queries** : 102  
- **Different statements** : 2  
- **Query time** : 209.33 ms  
- **Invalid entities** : 0  
- **Managed entities** : 5 116  

- **Total execution time** : 656ms  
- **Symfony intialization** : 10ms  

Statistiques Doctrine APRÈS :  

- **Database Queries** : 2 (-98%)  
- **Different statements** : 2  
- **Query time** : 14.45 ms (-93%)  
- **Invalid entities** : 0  
- **Managed entities** : 5 115  

- **Total execution time** : 171ms (-74%)  
- **Symfony intialization** : 3ms  

![Performance page invités AVANT](/misc/guest-page-performance-before.png "Performance page invités — AVANT")
![Performance page invités APRÈS](/misc/guest-page-performance-after.png "Performance page invités — APRÈS")

## TO-DO LATER

- [ ] Rédiger un README.md  
- [ ] Rédiger un CONTRIBUTING.md  

## BONUS

- [ ] Barre de recherche titre  
- [ ] Pagination  

<!-- `Àpp\Entity\User`

```php

```

```php

``` -->