<?php 
declare(strict_types=1);

use Terraphorm\Terraphorm;
use PHPUnit\Framework\TestCase;
use Composer\Semver\Comparator;

final class VersionTest extends TestCase
{
    protected $cwd = './tests/terraform';

    /** @test */
    public function it_tests_getting_terraform_version()
    {
        // We should receive a version like 0.14.7
        $this->assertIsString((new Terraphorm($this->cwd))
            ->version());
    }

    /** @test */
    public function it_tests_minimal_supported_terraform_version()
    {
        $this->assertTrue(Comparator::greaterThan((new Terraphorm(realpath($this->cwd)))
            ->version(), '0.11'));
    }
}
