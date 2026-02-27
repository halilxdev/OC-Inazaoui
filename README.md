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

# Pré-requis

![PHP](https://img.shields.io/badge/PHP-8.2-green?logo=php&style=for-the-badge&labelColor=whitesmoke&logoSize=auto)
![Docker Desktop](https://img.shields.io/badge/Docker-28.5-green?logo=docker&style=for-the-badge&labelColor=whitesmoke&logoSize=auto)
![Symfony CLI](https://img.shields.io/badge/Symfony_CLI-5.13-green?style=for-the-badge&labelColor=whitesmoke&logoSize=auto&logo=symfony&logoColor=black)
![Composer](https://img.shields.io/badge/Composer-2.18-green?style=for-the-badge&labelColor=whitesmoke&logoSize=auto&logo=composer&logoColor=black)

# Installation

# Usage


# Résolution des problèmes

Une des problématique du projet était l'optimisation de la performance sur la page **`Invités`**. En effet, elle prenait beaucoup de temps à se charger. Il s'avère que le template effectuait *en aval* des requêtes supplémentaires pour compter le nombre de médias associés à chaque invités.  
J'ai corrigé le tir en ajoutant une méthode dans le Repository qui récupère directement le nombre de médias associés via le QueryBuilder de Doctrine, évitant ainsi les requêtes supplémentaires générées par le template.

| | Avant | Après | Évolution |
| :--- | :--- | :--- | ---: |
| Requêtes SQL                      | 102    | 2     | -98%  |
| Requêtes distinctes               | 2      | 2     | —     |
| Temps de requête (ms)             | 209.33 | 14.45 | -93%  |
| Entités invalides                 | 0      | 0     | —     |
| Entités gérées                    | 5 116  | 5 115 | —     |
| Temps d'exécution total (ms)      | 656    | 171   | -74%  |
| Initialisation Symfony (ms)       | 10     | 3     | -70%  |

| Avant | Après |
|-------|-------|
| ![Avant](/misc/guest-page-performance-before.png) | ![Après](/misc/guest-page-performance-after.png) |

---

![OpenClassrooms](https://img.shields.io/badge/Projet_15-OpenClassrooms-purple?style=plastic&labelColor=white&color=7451eb)
![OpenClassrooms](https://img.shields.io/badge/Refactorsation-Optimisation-purple?style=plastic&labelColor=white&color=7451eb)  

![Intitulé du projet](https://img.shields.io/badge/Ina_Zaoui-Portfolios_de_photographes_eco--friendly-green?style=for-the-badge&labelColor=blue&color=black)
![Intitulé du projet](https://img.shields.io/badge/Refactorisez_le_code_d'un_site_pour_l'optimiser-green?style=for-the-badge&color=7451eb)