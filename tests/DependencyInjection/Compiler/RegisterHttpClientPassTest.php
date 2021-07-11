<?php

declare(strict_types=1);

namespace Tests\Setono\DAOBundle\DependencyInjection\Compiler;

use Setono\DAOBundle\DependencyInjection\Compiler\RegisterHttpClientPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class RegisterHttpClientPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RegisterHttpClientPass());
    }

    /**
     * @test
     */
    public function if_http_client_parameter_is_set_the_service_alias_exists(): void
    {
        $this->setParameter('setono_dao.http_client', 'http_client_service_id');
        $this->setDefinition('http_client_service_id', new Definition());

        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_dao.http_client', 'http_client_service_id');
    }

    /**
     * @test
     */
    public function if_buzz_http_client_service_exists_the_service_alias_exists(): void
    {
        $this->setDefinition('Buzz\Client\BuzzClientInterface', new Definition());

        $this->compile();

        $this->assertContainerBuilderHasAlias('setono_dao.http_client', 'Buzz\Client\BuzzClientInterface');
    }
}
