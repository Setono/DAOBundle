<?php

declare(strict_types=1);

namespace Tests\Setono\DAOBundle\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Setono\DAOBundle\DependencyInjection\Configuration;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    protected function getConfiguration(): Configuration
    {
        return new Configuration();
    }

    /**
     * @test
     */
    public function values_are_invalid_if_required_value_is_not_provided(): void
    {
        $this->assertConfigurationIsInvalid(
            [[]],
            'The child node "customer_id" at path "setono_dao" must be configured.' // (part of) the expected exception message - optional
        );
    }

    /**
     * @test
     */
    public function processed_value_contains_required_value(): void
    {
        $this->assertProcessedConfigurationEquals([
            ['customer_id' => 'first customer id', 'password' => 'first password'],
            ['customer_id' => 'second customer id', 'password' => 'second password'],
        ], [
            'customer_id' => 'second customer id',
            'password' => 'second password',
            'base_url' => 'https://api.dao.as',
        ]);
    }
}
