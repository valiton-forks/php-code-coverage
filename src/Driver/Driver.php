<?php
/*
 * This file is part of the php-code-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\CodeCoverage\Driver;

use SebastianBergmann\CodeCoverage\Filter;

/**
 * Interface for code coverage drivers.
 */
interface Driver
{
    /**
     * @var int
     *
     * @see http://xdebug.org/docs/code_coverage
     */
    public const LINE_EXECUTED = 1;

    /**
     * @var int
     *
     * @see http://xdebug.org/docs/code_coverage
     */
    public const LINE_NOT_EXECUTED = -1;

    /**
     * @var int
     *
     * @see http://xdebug.org/docs/code_coverage
     */
    public const LINE_NOT_EXECUTABLE = -2;

    /**
     * Start collection of code coverage information.
     */
    public function start(bool $determineUnusedAndDead = true): void;

    /**
     * Stop collection of code coverage information.
     */
    public function stop(): array;

    /**
     * Returns true if whitelist filtering is supported.
     */
    public function supportsWhitelistFiltering(): bool;

    /**
     * Sets the filter.
     */
    public function setFilter(Filter $filter): void;
}
