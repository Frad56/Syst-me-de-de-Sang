<?php

namespace App\Repository;

use App\Entity\Donateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Serializer\Exception\UnsupportedException;

/**
 * @extends ServiceEntityRepository<Donateur>
 */
class DonateurRepository extends ServiceEntityRepository 
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donateur::class);
    }


 /*   public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if(!$user instanceof Donateur){
            throw new UnsupportedException(sprintf('Instances of "%s" are not supported',\get_class($user)));
            $user ->setPassword($newHashedPassword);
            $this ->getEntityManager() -> persist($user);
            $this -> getEntityManager() ->flush();
        }
    
    }

    public function findOneEmail(string $email): ?Donateur{
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email',$email)
            ->getQuery()
            ->getOneOrNullResult();
    }
    */
    //    /**
    //     * @return Donateur[] Returns an array of Donateur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Donateur
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
