<?php

declare(strict_types=1);

namespace Tests\Setono\DAOBundle\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Setono\DAO\Client\Client;
use Setono\DAO\Client\ClientInterface;
use Setono\DAOBundle\DependencyInjection\SetonoDAOExtension;

final class SetonoDAOExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [new SetonoDAOExtension()];
    }

    protected function getMinimalConfiguration(): array
    {
        return [
            'customer_id' => 'customer id',
            'password' => 'p4ssw0rd',
        ];
    }

    /**
     * @test
     */
    public function after_loading_the_correct_parameter_has_been_set(): void
    {
        $this->load([
            'base_url' => 'base_url',
            'http_client' => 'http_client_service_id',
            'request_factory' => 'request_factory_service_id',
            'stream_factory' => 'stream_factory_service_id',
        ]);

        $this->assertContainerBuilderHasParameter('setono_dao.customer_id', 'customer id');
        $this->assertContainerBuilderHasParameter('setono_dao.password', 'p4ssw0rd');
        $this->assertContainerBuilderHasParameter('setono_dao.base_url', 'base_url');
        $this->assertContainerBuilderHasParameter('setono_dao.http_client', 'http_client_service_id');
        $this->assertContainerBuilderHasParameter('setono_dao.request_factory', 'request_factory_service_id');
        $this->assertContainerBuilderHasParameter('setono_dao.stream_factory', 'stream_factory_service_id');
    }

    /**
     * @test
     */
    public function after_loading_the_services_exist(): void
    {
        $this->load();

        $this->assertContainerBuilderHasService('setono_dao.client', Client::class);
    }

    /**
     * @test
     */
    public function after_loading_the_aliases_exist(): void
    {
        $this->load();

        $this->assertContainerBuilderHasAlias(ClientInterface::class, 'setono_dao.client');
    }
}
