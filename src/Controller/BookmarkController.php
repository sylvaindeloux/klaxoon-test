<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Bookmark;
use App\Repository\BookmarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bookmarks")
 */
final class BookmarkController extends AbstractController
{
    /**
     * @Route(path = "/{id}", methods = {"DELETE"})
     */
    public function delete(Bookmark $bookmark, BookmarkRepository $bookmarkRepository): JsonResponse
    {
        $bookmarkRepository->delete($bookmark);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
