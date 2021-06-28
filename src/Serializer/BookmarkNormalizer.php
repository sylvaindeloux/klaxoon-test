<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Entity\Bookmark;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class BookmarkNormalizer implements ContextAwareNormalizerInterface
{
    private ObjectNormalizer $objectNormalizer;

    public function __construct(ObjectNormalizer $objectNormalizer)
    {
        $this->objectNormalizer = $objectNormalizer;
    }

    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Bookmark;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->objectNormalizer->normalize($object, $format, $context);

        if (!$object->isVideo()) {
            unset($data['duration']);
        }

        return $data;
    }
}
