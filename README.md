<br />

<div align="center">

![CI OK](https://img.shields.io/badge/Intégration_Continue-Valide-brightgreen?style=for-the-badge)
![PHPUnit OK](https://img.shields.io/badge/PHPUnit-Valide-violet?style=for-the-badge)
![PHPStan OK](https://img.shields.io/badge/PHPStan-Valide-violet?style=for-the-badge)

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=plastic&logo=docker&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=plastic&logo=php&logoColor=white)
![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=plastic&logo=symfony&logoColor=white)
![Composer](https://img.shields.io/badge/composer-e?style=plastic&color=gold&logo=composer&logoColor=black)
![Git](https://img.shields.io/badge/git-%23F05033.svg?style=plastic&logo=git&logoColor=white)
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=plastic&logo=github&logoColor=white)  

![Badge](https://img.shields.io/badge/Symfony-version_7.3.9-blue?logo=symfony&style=)  

</div>

<br />

# Présentation

## Site

Le site d'Ina Zaoui est un portfolio en ligne dédié à sa photographie de paysages. Elle parcourt le monde de manière éco-responsable — à pied, à vélo, en bateau à voile, à dos d'animal ou en montgolfière — et partage ses clichés à travers ce site. Il intègre également une fonctionnalité permettant de mettre en avant de jeunes photographes talentueux.

## Ma mission

Le projet consiste à reprendre et moderniser le site d'Ina Zaoui. Le site, vieillissant et non maintenu depuis plusieurs années, nécessite une mise à niveau technique, la correction de bugs sur une fonctionnalité existante, ainsi que la mise en place d'une documentation et d'un pipeline d'intégration continue pour assurer sa pérennité.

## Meta 

Dans le cadre de ma formation Développeur **PHP/Symfony** sur **OpenClassrooms**, je travaille actuellement sur mon projet de fin de parcours. Ce projet consiste à intervenir en tant que développeur freelance sur le site d'une photographe de paysages, Ina Zaoui. Le site existant n'a pas été maintenu depuis plusieurs années et nécessite une remise à niveau complète.  
Ma mission couvre plusieurs axes : la mise à jour technique du site pour corriger les failles de sécurité liées à l'obsolescence du code, la correction de bugs identifiés sur une fonctionnalité récente permettant de mettre en avant de jeunes photographes, la rédaction d'une documentation claire pour faciliter l'intégration de la nouvelle développeuse qui prendra le relais, et enfin la mise en place d'un pipeline d'intégration continue afin de garantir la stabilité du site lors des futures mises à jour.
Ce projet me permet de mobiliser l'ensemble des compétences acquises tout au long de ma formation, aussi bien sur le plan technique que sur le plan organisationnel et collaboratif.

# Technologies

## Stack technique

- **Framework** : Symfony 7.3.9
- **PHP** : 8.2+
- **Base de données** : PostgreSQL 16
- **ORM** : Doctrine ORM 3.x
- **Template Engine** : Twig 3.x
- **Tests** : PHPUnit 9.6, PHPStan niveau 5
- **Containerisation** : Docker & Docker Compose
- **CI/CD** : GitHub Actions

## Architecture

Le projet suit l'architecture **MVC** de Symfony :

```
src/
├── Controller/     # Contrôleurs (gestion des requêtes HTTP)
├── Entity/         # Entités Doctrine (modèles de données)
├── Repository/     # Couche d'accès aux données
├── Form/           # Types de formulaires
├── Security/       # Composants de sécurité
└── DataFixtures/   # Jeux de données de test
```

# Pré-requis

![PHP](https://img.shields.io/badge/PHP-8.2-green?logo=php&style=for-the-badge&labelColor=whitesmoke&logoSize=auto)
![Composer](https://img.shields.io/badge/Composer-2.18-green?style=for-the-badge&labelColor=whitesmoke&logoSize=auto&logo=composer&logoColor=black)
![Docker Desktop](https://img.shields.io/badge/Docker-28.5-green?logo=docker&style=for-the-badge&labelColor=whitesmoke&logoSize=auto)
![Symfony CLI](https://img.shields.io/badge/Symfony_CLI-5.13-green?style=for-the-badge&labelColor=whitesmoke&logoSize=auto&logo=symfony&logoColor=black)

- [Installation de PHP](https://www.php.net/manual/en/install.php)
- [Installation de Composer](https://getcomposer.org/download)
- [Installation de Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Installation de Symfony CLI](https://symfony.com/download)

# Installation


## Récupération du projet

**Cloner le dépôt Git**
```bash
git clone https://github.com/halilxdev/OC-Inazaoui.git
```

## Installation du container Docker

**Initialiser le container**
```bash
docker compose up -d --build
```

## Installation des dépendances

**Installer les dépendances via Composer**
```bash
composer install
```

## Configuration de la base de données

**Créer un fichier `.env.local` à la racine du projet et configurez vos variables d'environnement**

```bash
DATABASE_URL="postgresql://postgres:postgres@127.0.0.1:5432/ina_zaoui?serverVersion=16&charset=utf8"
```

**Créer la base de données**
```bash
symfony console doctrine:database:create
symfony console doctrine:database:create --env=test # Pour la base de tests
```

**Exécuter les migrations**
```bash
symfony console make:migration
symfony console make:migration --env=test # Pour la base de tests
symfony console doctrine:migrations:migrate -n
symfony console doctrine:migrations:migrate -n --env=test # Pour la base de tests
```

**Charger les fixtures**
```bash
symfony console doctrine:fixtures:load
symfony console doctrine:fixtures:load --env=test # Pour la base de tests
```

## Souci avec la base de données

En cas de souci quelconque avec la base de données vous pouvez utiliser ces commandes pour détruire la base de données et reprendre de zéro  
```bash
symfony console doctrine:database:drop --force --if-exists
symfony console doctrine:database:drop --force --if-exists --env=test
```

# Usage

## Démarrage du serveur

*Utilisez `-d` pour utiliser les serveurs/containers détachés et ainsi ne pas bloquer vos terminaux*

**Si vous avez initialisé au moins une fois le container et que vous l'avez fermé par la suite**
```bash
docker compose up -d
```

**Pour lancer le serveur Symfony**
```bash
symfony serve -d
```

## Lancement de tests

**PHPUnit**
```bash
symfony php bin/phpunit
```
**Génération des tests avec un tableau de bord en HTML**
```bash
symfony php bin/phpunit --coverage-html public/test-coverage
```
Vous pouvez consulter le tableau de bord généré ci-dessus en vous rendant sur `/public/test-coverage/dashboard.html`

**PHPStan**
```bash
vendor/bin/phpstan analyse src tests --level=6 --memory-limit 4048M
```

## Connexion au back-office

Une fois les fixtures chargées, vous pouvez vous connecter au back-office avec ses identifiants :  
- `inazaoui@gmail.com`
- `password`

## Fermeture du serveur

**Pour clotûrer le serveur Symfony**
```bash
symfony server:stop
```

**Pour clotûrer une container Docker**
```bash
docker compose down
```

# Tests

## Commandes de test

**PHPUnit**
```bash
symfony php bin/phpunit
```
**Génération des tests avec un tableau de bord en HTML**
```bash
symfony php bin/phpunit --coverage-html public/test-coverage
```
Vous pouvez consulter le tableau de bord généré ci-dessus en vous rendant sur `/public/test-coverage/dashboard.html`

**PHPStan**
```bash
vendor/bin/phpstan analyse src tests --level=6 --memory-limit 4048M
```


## Couverture de code

- **Couverture minimale requise** : 70%
- **Couverture actuelle** : Consultable dans `/public/test-coverage/dashboard.html`

# Déploiement

## Préparation pour la production

**Optimiser l'autoloader Composer**
```bash
composer install --no-dev --optimize-autoloader
```

**Vider le cache et le réchauffer**
```bash
symfony console cache:clear --env=prod
symfony console cache:warmup --env=prod
```

**Installer les assets**
```bash
symfony console assets:install --env=prod
```

## Variables d'environnement de production

```env
APP_ENV=prod
APP_DEBUG=0
APP_SECRET=your-secret-key-here
DATABASE_URL=postgresql://user:pass@host:5432/dbname
```

# Résolution des problèmes

Une des problématique du projet était l'optimisation de la performance sur la page **`Invités`**. En effet, elle prenait beaucoup de temps à se charger. Il s'avère que le template effectuait *en aval* des requêtes supplémentaires pour compter le nombre de médias associés à chaque invités.  
J'ai corrigé le tir en ajoutant une méthode dans le Repository qui récupère directement le nombre de médias associés via le QueryBuilder de Doctrine, évitant ainsi les requêtes supplémentaires générées par le template.

| | Avant | Après | Évolution |
| :--- | :--- | :--- | ---: |
| Requêtes SQL                      | 102    | 2     | -98.04 % |
| Temps de requête (ms)             | 150.73 | 15.63 | -89.63 % |
| Temps d'exécution total (ms)      | 419    | 223   | -46.78 % |
| Initialisation Symfony (ms)       | 10     | 22    | 120 %    |

| Avant | Après |
|-------|-------|
| ![Avant](/misc/home-page-performance-before.png) | ![Après](/misc/home-page-performance-after.png) |
| ![Avant](/misc/portfolio-page-performance-before.png) | ![Après](/misc/portfolio-page-performance-after.png) |
| ![Avant](/misc/guest-page-performance-before.png) | ![Après](/misc/guest-page-performance-after.png) |
| ![Avant](/misc/guest-page-performance-before-doctrine.png) | ![Après](/misc/guest-page-performance-after-doctrine.png) |

# Contribution

Les contributions sont les bienvenues ! Consultez le [guide de contribution](CONTRIBUTING.md) pour commencer.

## Comment contribuer

1. Fork le projet
2. Créez votre branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'feat: add amazing feature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

# Licence

Ce projet est développé dans le cadre d'une formation OpenClassrooms. Pour toute utilisation, veuillez contacter l'auteur.