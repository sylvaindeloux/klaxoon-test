<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Bookmark;
use App\Entity\Tag;
use Doctrine\Persistence\ManagerRegistry;

final class BookmarkRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookmark::class);
    }

    public function removeTag(Bookmark $bookmark, Tag $tag): void
    {
        $bookmark->getTags()->removeElement($tag);

        $this->save($bookmark);
    }
}
