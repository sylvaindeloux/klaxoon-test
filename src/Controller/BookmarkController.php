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
     * @Route(methods = {"GET"})
     */
    public function listBookmarks(): JsonResponse
    {
        $bookmarks = $this->bookmarkRepository->findAll();

        return $this->json($bookmarks, Response::HTTP_OK, [], [
            'groups' => 'bookmark:read',
        ]);
    }

    /**
     * @Route(path = "/{id}", methods = {"GET"})
     */
    public function getBookmark(Bookmark $bookmark): JsonResponse
    {
        return $this->json($bookmark, Response::HTTP_OK, [], [
            'groups' => 'bookmark:read',
        ]);
    }

    /**
     * @Route(path = "/{id}", methods = {"DELETE"})
     */
    public function deleteBookmark(Bookmark $bookmark): JsonResponse
    {
        $this->bookmarkRepository->delete($bookmark);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route(path = "/{id}/tags", methods = {"GET"})
     */
    public function listBookmarkTags(Bookmark $bookmark): JsonResponse
    {
        $tags = $bookmark->getTags();

        return $this->json($tags, Response::HTTP_OK, [], [
            'groups' => 'tag:read',
        ]);
    }

    /**
     * @Route(path = "/{id}/tags/{tag_id}", methods = {"DELETE"})
     *
     * @ParamConverter(name = "tag", class = Tag::class, options = {"id" = "tag_id"})
     */
    public function removeBookmarkTag(Bookmark $bookmark, Tag $tag): JsonResponse
    {
        if (!$bookmark->getTags()->contains($tag)) {
            // silent error
            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        }

        $this->bookmarkRepository->removeTag($bookmark, $tag);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
