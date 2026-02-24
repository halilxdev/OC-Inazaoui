<?php

namespace App\Repository;

use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Media>
 *
 * @method Media|null find($id, $lockMode = null, $lockVersion = null)
 * @method Media|null findOneBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null)
 * @method Media[]    findAll()
 * @method Media[]    findBy(array<string, mixed> $criteria, array<string, string>|null $orderBy = null, $limit = null, $offset = null)
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Media::class);
    }

    /**
     * @return array<int, Media>
     */
    public function findMediasByUserWithAccess(mixed $album): array
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('m.user', 'u')
            ->where('u.roles NOT LIKE :role')
            ->andWhere('m.album = :album')
            ->setParameter('role', '%ROLE_DISABLED%')
            ->setParameter('album', $album)
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array<int, Media>
     */
    public function findAllMediasByUserWithAccess(): array
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('m.user', 'u')
            ->where('u.roles NOT LIKE :role')
            ->setParameter('role', '%ROLE_DISABLED%')
            ->orderBy('m.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
