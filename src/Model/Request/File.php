<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class File.
 *
 * Represents the single file sent to the CDT API.
 */
class File implements NormalizableInterface
{
    /**
     * The file name.
     */
    protected string $fileName;

    /**
     * The file content.
     */
    protected string $content;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param array<int|string, mixed> $context
     * @return array<int|string, mixed>|string|int|float|bool|\ArrayObject<int|string, mixed>|null
     */
    public function normalize(NormalizerInterface $normalizer, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        return [
            'fileName' => $this->fileName,
            'base64Data' => base64_encode($this->content),
        ];
    }
}
