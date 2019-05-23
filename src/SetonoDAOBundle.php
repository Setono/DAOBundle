<?php

declare(strict_types=1);

namespace Setono\DAOBundle;

use Setono\DAOBundle\DependencyInjection\Compiler\RegisterFactoriesPass;
use Setono\DAOBundle\DependencyInjection\Compiler\RegisterHttpClientPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SetonoDAOBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new RegisterFactoriesPass());
        $container->addCompilerPass(new RegisterHttpClientPass());
    }
}
