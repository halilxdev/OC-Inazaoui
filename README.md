![CI OK](https://img.shields.io/badge/Intégration_Continue-Valide-brightgreen?style=falt)
![PHPUnit OK](https://img.shields.io/badge/PHPUnit-Valide-violet?style=falt)
![PHPStan OK](https://img.shields.io/badge/PHPStan-Valide-violet?style=falt)

![Badge](https://img.shields.io/badge/Symfony-version_7.3.9-blue?logo=symfony&style=for-the-badge)  

---

**Stack du projet**

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)
![Composer](https://img.shields.io/badge/composer-e?style=for-the-badge&color=gold&logo=composer&logoColor=black)
![Git](https://img.shields.io/badge/git-%23F05033.svg?style=for-the-badge&logo=git&logoColor=white)
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)

---

**Pré-requis**

![PHP](https://img.shields.io/badge/PHP-8.2-green?logo=php&style=for-the-badge&labelColor=whitesmoke&logoSize=auto)
![Docker Desktop](https://img.shields.io/badge/Docker-28.5-green?logo=docker&style=for-the-badge&labelColor=whitesmoke&logoSize=auto)
![Symfony CLI](https://img.shields.io/badge/Symfony_CLI-5.13-green?style=for-the-badge&labelColor=whitesmoke&logoSize=auto&logo=symfony&logoColor=black)
![Composer](https://img.shields.io/badge/Composer-2.18-green?style=for-the-badge&labelColor=whitesmoke&logoSize=auto&logo=composer&logoColor=black)

---

**Installation**


---

**Usage**

---

**Résolution des problèmes**

Une des problématique du projet était l'optimisation de la performance sur la page `Invités`. En effet, elle prenait beaucoup de temps à se charger. Il s'avère que le template effectuait des requêtes supplémentaires pour compter le nombre de médias associés à chaque invités.

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

![Intitulé du projet](https://img.shields.io/badge/Refactorisez_le_code_d'un_site_pour_l'optimiser-green?style=for-the-badge&color=7451eb)
![Intitulé du projet](https://img.shields.io/badge/Ina_Zaoui-Portfolios_de_photographes_eco--friendly-green?style=for-the-badge&labelColor=blue&color=black)