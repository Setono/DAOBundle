<?php

declare(strict_types=1);

namespace Setono\DAOBundle\DependencyInjection\Compiler;

use Buzz\Client\BuzzClientInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

final class RegisterHttpClientPass implements CompilerPassInterface
{
    private const HTTP_CLIENT_PARAMETER = 'setono_dao.http_client';
    private const HTTP_CLIENT_SERVICE_ID = 'setono_dao.http_client';

    public function process(ContainerBuilder $container): void
    {
        if ($container->hasParameter(self::HTTP_CLIENT_PARAMETER)) {
            if (!$container->has($container->getParameter(self::HTTP_CLIENT_PARAMETER))) {
                throw new ServiceNotFoundException($container->getParameter(self::HTTP_CLIENT_PARAMETER));
            }

            $container->setAlias(self::HTTP_CLIENT_SERVICE_ID, $container->getParameter(self::HTTP_CLIENT_PARAMETER));
        } elseif ($container->has(BuzzClientInterface::class)) {
            $container->setAlias(self::HTTP_CLIENT_SERVICE_ID, BuzzClientInterface::class);
        }
    }
}
