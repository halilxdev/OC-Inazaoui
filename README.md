<!-- 

# Ina Zaoui

Pour se connecter avec le compte de Ina, il faut utiliser les identifiants suivants:
- identifiant : `ina`
- mot de passe : `password`

Vous trouverez dans le fichier `backup.zip` un dump SQL anonymisé de la base de données et toutes les images qui se trouvaient dans le dossier `public/uploads`.
Faudrait peut être trouver une meilleure solution car le fichier est très gros, il fait plus de 1Go.

-->

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