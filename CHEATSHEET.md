### Base de données

#### Supprimer la base de données
```bash
symfony console doctrine:database:drop --force --if-exists
```

#### Créer la base de données
```bash
symfony console doctrine:database:create
```

#### Exécuter les migrations
```bash
symfony console make:migration
```
```bash
symfony console doctrine:migrations:diff
```
```bash
symfony console doctrine:migrations:migrate -n
```

#### Charger les fixtures
```bash
symfony console doctrine:fixtures:load -n --purge-with-truncate
```

*Note : Vous pouvez exécuter ces commandes avec l'option `--env=test` pour les exécuter dans l'environnement de test.*

### SASS

#### Compiler les fichiers SASS
```bash
symfony console sass:build
```
*Note : le fichier `.symfony.local.yaml` est configuré pour surveiller les fichiers SASS et les compiler automatiquement quand vous lancez le serveur web de Symfony.*

### Serveur web
```bash
symfony serve
```

### PHPUnit

```bash
symfony php bin/phpunit
```

```bash
symfony php bin/phpunit --coverage-html public/test-coverage
```

*Note : Penser à charger les fixtures avant chaque éxécution des tests.*

### PHPStan

```bash
vendor/bin/phpstan analyse src tests --level=6 --memory-limit 4048M
```

### Git

Sauvegarder les changements non-staged  
```bash
git stash
```

Créer et basculer sur une nouvelle branche  
```bash
git checkout -b ma-nouvelle-branche
```

Appliquer les changements à la nouvelle branche  
```bash
git stash pop
```