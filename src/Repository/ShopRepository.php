<?php

namespace App\Repository;

use App\Entity\Shop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shop[]    findAll()
 * @method Shop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shop::class);
    }

    /**
     * @param int $page
     * @param int $nbElementsByPage
     * @return Shop[]
     */
    public function getShopsByQB(int $page = 1, int $nbElementsByPage = 1000): array {

        $query = $this->createQueryBuilder('shop');

        // Pagination
        $query->setFirstResult((($page < 1 ? 1 : $page) -1)  * $nbElementsByPage);
        $query->setMaxResults($nbElementsByPage);

        return $query->getQuery()->getResult();
    }

}
