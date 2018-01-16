<?php
/*
 * This file is part of the php-code-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\CodeCoverage\Report;

use SebastianBergmann\CodeCoverage\TestCase;

/**
 * @covers SebastianBergmann\CodeCoverage\Report\Clover
 */
class CloverTest extends TestCase
{
    public function testCloverForBankAccountTest()
    {
        $clover = new Clover;

        $xml = $clover->process($this->getCoverageForBankAccount(), null, 'BankAccount');

        $this->assertStringMatchesFormatFile(TEST_FILES_PATH . 'BankAccount-clover.xml', $xml);

        $this->validate($xml);
    }

    public function testCloverForFileWithIgnoredLines()
    {
        $clover = new Clover;

        $xml = $clover->process($this->getCoverageForFileWithIgnoredLines());

        $this->assertStringMatchesFormatFile(TEST_FILES_PATH . 'ignored-lines-clover.xml', $xml);

        $this->validate($xml);
    }

    public function testCloverForClassWithAnonymousFunction()
    {
        $clover = new Clover;

        $xml = $clover->process($this->getCoverageForClassWithAnonymousFunction());

        $this->assertStringMatchesFormatFile(TEST_FILES_PATH . 'class-with-anonymous-function-clover.xml', $xml);

        $this->validate($xml);
    }

    private function validate(string $xml): void
    {
        $document = new \DOMDocument;
        $document->loadXML($xml);

        libxml_use_internal_errors(true);

        if (!$document->schemaValidate(__DIR__ . '/../_files/clover.xsd')) {
            $buffer = 'Validation against clover.xsd failed:' . PHP_EOL;

            foreach (libxml_get_errors() as $error) {
                $buffer .= $error->message;
            }

            libxml_clear_errors();

            throw new \RuntimeException($buffer);
        }
    }
}
