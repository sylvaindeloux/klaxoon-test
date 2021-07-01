<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Bookmark;
use App\Factory\DataCollector\FlickrDataCollector;
use App\Factory\DataCollector\VimeoDataCollector;
use App\Repository\BookmarkRepository;
use App\Repository\TagRepository;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;

final class BookmarkFactory
{
    private FlickrDataCollector $flickrDataCollector;
    private VimeoDataCollector $vimeoDataCollector;
    private BookmarkRepository $bookmarkRepository;
    private TagRepository $tagRepository;

    public function __construct(
        FlickrDataCollector $flickrDataCollector,
        VimeoDataCollector $vimeoDataCollector,
        BookmarkRepository $bookmarkRepository,
        TagRepository $tagRepository
    ) {
        $this->flickrDataCollector = $flickrDataCollector;
        $this->vimeoDataCollector = $vimeoDataCollector;
        $this->bookmarkRepository = $bookmarkRepository;
        $this->tagRepository = $tagRepository;
    }

    public function createBookmarkFromRequest(Request $request): Bookmark
    {
        $requestData = json_decode($request->getContent());

        $bookmark = $this->createBookmarkFromUrl($requestData->url);

        $tags = isset($requestData->tags)
            ? $this->tagRepository->retrieveOrCreateTags($requestData->tags)
            : []
        ;

        foreach ($tags as $tag) {
            if ($bookmark->getTags()->contains($tag)) {
                continue;
            }

            $bookmark->getTags()->add($tag);
        }

        $this->bookmarkRepository->save($bookmark);

        return $bookmark;
    }

    public function createBookmarkFromUrl(string $url): Bookmark
    {
        switch (true) { // quickwin
            case preg_match('/^https:\/\/(www.)?vimeo.com\/.*/', $url):
                $data = $this->vimeoDataCollector->collectDataFromVimeoUrl($url);

                return Bookmark::createVimeoBookmark(
                    $url,
                    $data['title'],
                    $data['author'],
                    $data['height'],
                    $data['width'],
                    $data['duration']
                );

            case preg_match('/^https:\/\/(www.)?flickr.com\/.*/', $url):
                $data = $this->flickrDataCollector->collectDataFromFlickrUrl($url);

                return Bookmark::createFlickrBookmark(
                    $url,
                    $data['title'],
                    $data['author'],
                    $data['height'],
                    $data['width']
                );

            default:
                throw new RuntimeException(sprintf('Given URL "%s" is incorrect.', $url));
        }

    }
}
