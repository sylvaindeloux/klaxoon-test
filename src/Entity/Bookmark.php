<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BookmarkRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name = "bookmarks")
 * @ORM\Entity(repositoryClass = BookmarkRepository::class)
 */
final class Bookmark implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue(strategy = "UUID")
     */
    private string $id;

    /**
     * @ORM\Column()
     */
    private string $type;

    /**
     * @ORM\Column()
     */
    private string $url;

    /**
     * @ORM\Column()
     */
    private string $title;

    /**
     * @ORM\Column()
     */
    private string $author;

    /**
     * @ORM\Column(type = "datetime_immutable")
     */
    private DateTimeImmutable $addedAt;

    /**
     * @ORM\Column(type = "integer")
     */
    private int $height;

    /**
     * @ORM\Column(type = "integer")
     */
    private int $width;

    /**
     * @ORM\Column(type = "float", nullable = true)
     */
    private ?float $duration;

    /**
     * @ORM\ManyToMany(targetEntity = Tag::class)
     * @ORM\JoinTable(name = "bookmarks_tags")
     */
    private Collection $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getAddedAt(): DateTimeImmutable
    {
        return $this->addedAt;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }
}
