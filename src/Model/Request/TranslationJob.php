<?php

declare(strict_types=1);

namespace OpenEuropa\CdtClient\Model\Request;

/**
 * Class TranslationJob.
 *
 * Represents the translation job sent to the CDT API.
 */
class TranslationJob
{

    /**
     * The volume.
     */
    protected int $volume;

    /**
     * The source language.
     */
    protected string $sourceLanguage;

    /**
     * The target language.
     */
    protected string $targetLanguage;
}
