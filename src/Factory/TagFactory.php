<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repository\TagRepository;
use Symfony\Component\HttpFoundation\Request;

final class TagFactory
{
    private TagRepository $tagRepository;

    public function __construct(
        TagRepository $tagRepository
    ) {
        $this->tagRepository = $tagRepository;
    }

    public function createTagsFromRequest(Request $request): array
    {
        $requestData = json_decode($request->getContent(), true);

        $tags = [];

        foreach ($requestData as $tagName) {
            $tags[] = $this->tagRepository->retrieveOrCreateTag($tagName);
        }

        return $tags;
    }
}
