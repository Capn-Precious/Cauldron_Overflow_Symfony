<?php

namespace App\Twig\Extension;

use App\Service\MarkdownHelper;
use Psr\Cache\InvalidArgumentException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MarkdownExtension extends AbstractExtension
{
    private $markdownHelper;

    public function __construct(MarkdownHelper $markdownHelper)
    {
        $this->markdownHelper = $markdownHelper;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('parse_markdown', [$this, 'parseMarkdown'],
                ['is_safe' => ['html']]),
        ];
    }

    /**
     * @throws InvalidArgumentException
     */
    public function parseMarkdown($value): string
    {
        return $this->markdownHelper->parse($value);
    }
}
