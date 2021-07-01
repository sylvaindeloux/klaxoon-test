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
            $queryBuilder = $this->createQueryBuilder('t');

            $queryBuilder
                ->where('t.name = :tagName')
                ->setParameter('tagName', $tagName)
            ;

            try {
                $tag = $queryBuilder->getQuery()->getSingleResult();
            } catch (NoResultException $e) {
                $tag = $this->createTag($tagName);
            }

            $tags[] = $tag;
        }

        return $tags;
    }

    public function createTag(string $name): Tag
    {
        $tag = Tag::createFromString($name);

        $this->save($tag);

        return $tag;
    }
}
