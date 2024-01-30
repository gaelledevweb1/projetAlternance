<?php

namespace App\Repository;

use App\Entity\Credentials;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
 use Doctrine\Persistence\ManagerRegistry;
 use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;


/**
 * @extends ServiceEntityRepository<Credentials>
 *
 * @method Credentials|null find($id, $lockMode = null, $lockVersion = null)
 * @method Credentials|null findOneBy(array $criteria, array $orderBy = null)
 * @method Credentials[]    findAll()
 * @method Credentials[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CredentialsRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Credentials::class);
    }

    public function loadUserByIdentifier(string $usernameOrEmail): ?Credentials
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQuery(
                'SELECT c
                FROM App\Entity\Credentials c
                WHERE c.userName = :query
                OR c.userEmail = :query'
            )
            ->setParameter('query', $usernameOrEmail)
            ->getOneOrNullResult();
    }

    // Dans CredentialsRepository.php

public function findUserByUsername($userName)
{
    return $this->createQueryBuilder('c')
        ->andWhere('c.userName = :userName')
        ->setParameter('userName', $userName)
        ->getQuery()
        ->getOneOrNullResult();
}
//    /**
//     * @return Credentials[] Returns an array of Credentials objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Credentials
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
