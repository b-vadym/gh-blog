<?php

namespace Vadim\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class PostRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function findPublishedQuery(): Query
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->getQuery()
        ;
    }
}
