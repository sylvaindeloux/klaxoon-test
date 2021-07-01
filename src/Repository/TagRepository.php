<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

final class TagRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    public function retrieveOrCreateTags(array $tagsNames): array
    {
        $tags = [];

        foreach ($tagsNames as $tagName) {
            $tags[] = $this->retrieveOrCreateTag($tagName);
        }

        return $tags;
    }

    public function retrieveOrCreateTag(string $name): Tag
    {
        $queryBuilder = $this->createQueryBuilder('t');

        $queryBuilder
            ->where('t.name = :name')
            ->setParameter('name', $name)
        ;

        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return $this->createTag($name);
        }
    }

    public function createTag(string $name): Tag
    {
        $tag = Tag::createFromString($name);

        $this->save($tag);

        return $tag;
    }
}
