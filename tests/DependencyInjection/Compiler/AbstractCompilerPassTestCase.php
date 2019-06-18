<?php

declare(strict_types=1);

namespace Tests\Setono\DAOBundle\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractContainerBuilderTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Same as Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase,
 * but without compilation_should_not_fail_with_empty_container test as we want
 * service container to throw exception if required services not defined.
 */
abstract class AbstractCompilerPassTestCase extends AbstractContainerBuilderTestCase
{
    /**
     * Register the compiler pass under test, just like you would do inside a bundle's load()
     * method:.
     *
     *   $container->addCompilerPass(new MyCompilerPass());
     */
    abstract protected function registerCompilerPass(ContainerBuilder $container): void;

    protected function setUp(): void
    {
        parent::setUp();

        $this->registerCompilerPass($this->container);
    }
}
