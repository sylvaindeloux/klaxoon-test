<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\EntityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    public function save(EntityInterface $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function delete(EntityInterface $entity): void
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }
}
