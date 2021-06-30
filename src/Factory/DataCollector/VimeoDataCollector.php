<?php

declare(strict_types=1);

namespace App\Factory\DataCollector;

use Embed\Embed;

final class VimeoDataCollector
{
    private Embed $embed;

    public function __construct(Embed $embed)
    {
        $this->embed = $embed;
    }

    public function collectDataFromVimeoUrl(string $url): array
    {
        $collectedData = $this->embed->get($url);

        $data = [
            'title' => $collectedData->title,
            'author' => $collectedData->authorName,
            'height' => $collectedData->code->height,
            'width' => $collectedData->code->width,
            'duration' => $collectedData->getOEmbed()->get('duration'),
        ];

        return $data;
    }
}
