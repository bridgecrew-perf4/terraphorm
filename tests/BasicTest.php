<?php 
declare(strict_types=1);

use Terraphorm\Terraphorm;
use PHPUnit\Framework\TestCase;
use Composer\Semver\Comparator;
use Symfony\Component\Process\ExecutableFinder;

final class BasicTest extends TestCase
{
    protected $cwd = './tests/terraform';

    /** @test */
    public function it_checks_for_terraform_executable()
    {
        $executableFinder = new ExecutableFinder();
        $path = $executableFinder->find('terraform');
        $this->assertStringContainsString('terraform', $path);
    }

    /** @test */
    public function it_tests_basic_functionality_of_the_object()
    {
        $this->assertInstanceOf(Terraphorm::class, (new Terraphorm(realpath($this->cwd))));
    }

}
