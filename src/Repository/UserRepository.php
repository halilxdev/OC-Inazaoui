<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * Find users by roles with pagination
     */
    public function findByRolesPaginated(array $roles, int $page = 1, int $limit = 25): array
    {
        $offset = ($page - 1) * $limit;

        // Pour PostgreSQL avec JSON
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT * FROM \"user\" u
            WHERE u.roles::jsonb ?| :roles
            ORDER BY u.id ASC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery([
            'roles' => '{' . implode(',', $roles) . '}',
            'limit' => $limit,
            'offset' => $offset
        ]);

        $users = [];
        foreach ($result->fetchAllAssociative() as $row) {
            $users[] = $this->getEntityManager()->getRepository(User::class)->find($row['id']);
        }

        return $users;
    }

    /**
     * Count users by roles
     */
    public function countByRoles(array $roles): int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT COUNT(*) as total FROM \"user\" u
            WHERE u.roles::jsonb ?| :roles
        ";

        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery([
            'roles' => '{' . implode(',', $roles) . '}'
        ]);

        return (int) $result->fetchOne();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
