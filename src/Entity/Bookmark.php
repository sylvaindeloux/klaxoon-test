<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BookmarkRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Table(name = "bookmarks")
 * @ORM\Entity(repositoryClass = BookmarkRepository::class)
 */
final class Bookmark implements EntityInterface
{
    public const TYPE_VIMEO = 'vimeo';
    public const TYPE_FLICKR = 'flickr';

    /**
     * @ORM\Id()
     * @ORM\Column()
     * @ORM\GeneratedValue(strategy = "UUID")
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private string $id;

    /**
     * @ORM\Column()
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private string $type;

    /**
     * @ORM\Column()
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private string $url;

    /**
     * @ORM\Column()
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private string $title;

    /**
     * @ORM\Column()
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private string $author;

    /**
     * @ORM\Column(type = "datetime_immutable")
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private DateTimeImmutable $addedAt;

    /**
     * @ORM\Column(type = "integer")
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private int $height;

    /**
     * @ORM\Column(type = "integer")
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private int $width;

    /**
     * @ORM\Column(type = "float", nullable = true)
     *
     * @Serializer\Groups({"bookmark:read"})
     */
    private ?float $duration;

    /**
     * @ORM\ManyToMany(targetEntity = Tag::class)
     * @ORM\JoinTable(name = "bookmarks_tags")
     *
     * @Serializer\Groups({"bookmark:read"})
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

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function isVideo(): bool
    {
        return self::TYPE_VIMEO === $this->type;
    }
}
