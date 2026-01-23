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

## Étape 3 - Architecture base de données et Fixtures

- Passage de PostgreSQL à MySQL  
- Ajout d'une interface PhpMyAdmin  
- Création complète des Fixtures  

<!-- `Àpp\Entity\User`

```php

```

```php

``` -->