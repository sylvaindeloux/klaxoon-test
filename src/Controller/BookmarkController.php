<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Bookmark;
use App\Entity\Tag;
use App\Repository\BookmarkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bookmarks")
 */
final class BookmarkController extends AbstractController
{
    private BookmarkRepository $bookmarkRepository;

    public function __construct(BookmarkRepository $bookmarkRepository)
    {
        $this->bookmarkRepository = $bookmarkRepository;
    }

    /**
     * @Route(path = "/{id}", methods = {"DELETE"})
     */
    public function delete(Bookmark $bookmark): JsonResponse
    {
        $this->bookmarkRepository->delete($bookmark);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route(path = "/{id}/tags/{tag_id}", methods = {"DELETE"})
     *
     * @ParamConverter(name = "tag", class = Tag::class, options = {"id" = "tag_id"})
     */
    public function removeTag(Bookmark $bookmark, Tag $tag): JsonResponse
    {
        if (!$bookmark->getTags()->contains($tag)) {
            // silent error
            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        }

        $this->bookmarkRepository->removeTag($bookmark, $tag);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
