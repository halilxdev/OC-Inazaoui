<br />
<div align="center">

![Social](https://img.shields.io/badge/Contribution-Recommandée-brightgreen?style=social)

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=plastic&logo=docker&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=plastic&logo=php&logoColor=white)
![Badge](https://img.shields.io/badge/Symfony-black?logo=symfony&style=plastic)
![Composer](https://img.shields.io/badge/composer-e?style=plastic&color=gold&logo=composer&logoColor=black)
![Git](https://img.shields.io/badge/git-%23F05033.svg?style=plastic&logo=git&logoColor=white)
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=plastic&logo=github&logoColor=white)

</div>

<br />

# Guide de contribution

Merci de votre intérêt pour contribuer au projet **Ina Zaoui** ! Ce guide vous aidera à comprendre comment participer efficacement au développement de cette application Symfony.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP 8.2+** avec les extensions nécessaires (mbstring, xml, pdo_pgsql)
- **Composer 2.18+**
- **Docker Desktop 28.5+** pour l'environnement de développement
- **Symfony CLI 5.13+**
- **Git** configuré avec votre identité
- Un éditeur de code avec support PSR (PHPStorm, VSCode avec extensions PHP)


## Workflow Git

### Nommage des branches

Utilisez ces préfixes pour vos branches :

- `feature/` → Nouvelle fonctionnalité (ex: `feature/upload-multiple-images`)
- `fix/` → Correction de bug (ex: `fix/media-upload-validation`)
- `refactor/` → Refactorisation sans changement fonctionnel
- `docs/` → Mise à jour de la documentation
- `test/` → Ajout ou modification de tests

### Messages de commit

Suivez la convention [Conventional Commits](https://www.conventionalcommits.org/) :

```
<type>(<scope>): <description courte>

[description longue optionnelle]

[footer optionnel]
```

Types de commit :
- `feat`: Nouvelle fonctionnalité
- `fix`: Correction de bug
- `docs`: Documentation uniquement
- `style`: Formatage, point-virgules manquants, etc.
- `refactor`: Changement de code qui ne corrige pas de bug ni n'ajoute de fonctionnalité
- `test`: Ajout de tests manquants
- `chore`: Changements au processus de build ou aux outils auxiliaires

Exemples :
```bash
git commit -m "feat(media): add support for WebP format"
git commit -m "fix(auth): correct password validation regex"
git commit -m "docs: update installation instructions"
```

## Standards de code

### PSR Standards

Ce projet suit strictement les standards PHP-FIG :

#### PSR-1 : Basic Coding Standard
- Fichiers PHP utilisant uniquement `<?php`
- Classes dans leur propre fichier
- Pas de fermeture `?>` en fin de fichier PHP pur
- Encodage UTF-8 sans BOM

#### PSR-4 : Autoloading
- Namespace `App\` correspond au dossier `src/`
- Un fichier par classe
- Structure : `App\Controller\HomeController` → `src/Controller/HomeController.php`

#### PSR-12 : Extended Coding Style
- Indentation de 4 espaces (pas de tabs)
- Ligne vide après le namespace et les imports
- Accolades sur nouvelle ligne pour classes et méthodes
- Visibilité explicite pour toutes les propriétés et méthodes

### Conventions Symfony

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExampleController extends AbstractController
{
    #[Route('/example', name: 'app_example')]
    public function index(): Response
    {
        // Logique du contrôleur
        return $this->render('example/index.html.twig', [
            'variable' => $value,
        ]);
    }
}
```

### Bonnes pratiques

- **Types stricts** : Déclarez les types de paramètres et de retour
- **PHPDoc** : Pour les collections et cas complexes
- **Méthodes courtes** : Maximum 30 lignes par méthode
- **Noms explicites** : `getUsersByRole()` plutôt que `getUsers()`
- **camelCase** : Pour les variables et méthodes
- **PascalCase** : Pour les classes

## Tests

### Écrire des tests

Chaque nouvelle fonctionnalité doit inclure des tests :

```php
<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User();
        $user->setEmail('test@example.com');

        $this->assertEquals('test@example.com', $user->getEmail());
    }
}
```

### Standards de tests

- Couverture minimale : 70%
- Un test par comportement
- Noms de tests explicites : `testUserCannotHaveInvalidEmail()`
- Utiliser des DataProviders pour les cas multiples
- Mocker les dépendances externes

Corrigez toutes les erreurs avant de soumettre votre PR.

## Pull Request

### Avant de créer une PR

**Synchronisez avec upstream** :
```bash
git fetch upstream
git rebase upstream/main
```

### Template de Pull Request

```markdown
## Description
Brève description des changements

## Type de changement
- [ ] Bug fix (changement non-breaking qui corrige un problème)
- [ ] Nouvelle fonctionnalité (changement non-breaking qui ajoute une fonctionnalité)
- [ ] Breaking change (correction ou fonctionnalité qui casserait l'existant)
- [ ] Cette PR nécessite une mise à jour de la documentation

## Comment tester
1. Étape 1
2. Étape 2
3. ...

## Checklist
- [ ] Mon code suit les standards du projet
- [ ] J'ai effectué une auto-review de mon code
- [ ] J'ai commenté mon code aux endroits complexes
- [ ] J'ai mis à jour la documentation si nécessaire
- [ ] Mes changements ne génèrent aucun warning
- [ ] J'ai ajouté des tests qui prouvent que ma correction/fonctionnalité fonctionne
- [ ] Les tests unitaires passent localement
- [ ] PHPStan ne remonte aucune erreur
```

## 👀 Code Review

### Critères d'acceptation

Votre PR sera évaluée sur :

1. **Fonctionnalité** : Le code fait-il ce qui est attendu ?
2. **Tests** : Les tests couvrent-ils les cas nominaux et d'erreur ?
3. **Performance** : Pas de requêtes N+1, utilisation appropriée du cache
4. **Sécurité** : Validation des entrées, protection CSRF, etc.
5. **Maintenabilité** : Code lisible, commenté si nécessaire
6. **Standards** : Respect des PSR et conventions Symfony

## Ressources utiles

- [Documentation Symfony](https://symfony.com/doc/current/index.html)
- [PHP Standards Recommendations](https://www.php-fig.org/psr/)
- [Symfony Best Practices](https://symfony.com/doc/current/best_practices.html)
- [PHPStan Documentation](https://phpstan.org/user-guide/getting-started)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Conventional Commits](https://www.conventionalcommits.org/)

## Support

Pour toute question :
- Ouvrez une issue GitHub
- Consultez les issues existantes
- Rejoignez les discussions dans les PR

## Licence

En contribuant, vous acceptez que vos contributions soient sous la même licence que le projet.

---

Merci de contribuer à rendre ce projet meilleur !