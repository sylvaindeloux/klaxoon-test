<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name = "tags")
 * @ORM\Entity(repositoryClass = TagRepository::class)
 */
final class Tag
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     */
    private string $id;

    public function getId(): string
    {
        return $this->id;
    }
}
