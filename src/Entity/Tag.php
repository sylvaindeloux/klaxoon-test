<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name = "tags")
 * @ORM\Entity(repositoryClass = TagRepository::class)
 */
final class Tag implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue(strategy = "UUID")
     *
     * @Serializer\Groups({"bookmark:read", "tag:read"})
     */
    private string $id;

    /**
     * @ORM\Column(unique = true)
     *
     * @Serializer\Groups({"bookmark:read", "tag:read"})
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function createFromString(string $name): self
    {
        return new self($name);
    }
}
