<?php

declare(strict_types=1);

namespace App\Factory\DataCollector;

use Embed\Embed;

final class FlickrDataCollector
{
    private Embed $embed;

    public function __construct(Embed $embed)
    {
        $this->embed = $embed;
    }

    public function collectDataFromFlickrUrl(string $url): array
    {
        $collectedData = $this->embed->get($url);

        $data = [
            'title' => $collectedData->title,
            'author' => $collectedData->authorName,
            'height' => $collectedData->code->height,
            'width' => $collectedData->code->width,
        ];

        return $data;
    }
}
