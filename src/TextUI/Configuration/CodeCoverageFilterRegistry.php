<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\TextUI\Configuration;

use function assert;
use SebastianBergmann\CodeCoverage\Filter;

/**
 * CLI options and XML configuration are static within a single PHPUnit process.
 * It is therefore okay to use a Singleton registry here.
 *
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class CodeCoverageFilterRegistry
{
    private static ?self $instance = null;
    private ?Filter $filter        = null;
    private bool $configured       = false;

    public static function instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function get(): Filter
    {
        assert($this->filter !== null);

        return $this->filter;
    }

    public function init(Configuration $configuration): void
    {
        if (!$configuration->hasCoverageReport()) {
            return;
        }

        if ($this->configured) {
            return;
        }

        $this->filter = new Filter;

        if ($configuration->source()->notEmpty()) {
            foreach ($configuration->source()->includeDirectories() as $directory) {
                $this->filter->includeDirectory(
                    $directory->path(),
                    $directory->suffix(),
                    $directory->prefix()
                );
            }

            foreach ($configuration->source()->includeFiles() as $file) {
                $this->filter->includeFile($file->path());
            }

            foreach ($configuration->source()->excludeDirectories() as $directory) {
                $this->filter->excludeDirectory(
                    $directory->path(),
                    $directory->suffix(),
                    $directory->prefix()
                );
            }

            foreach ($configuration->source()->excludeFiles() as $file) {
                $this->filter->excludeFile($file->path());
            }

            $this->configured = true;
        }
    }

    public function configured(): bool
    {
        return $this->configured;
    }
}
