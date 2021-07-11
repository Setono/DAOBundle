<?php

declare(strict_types=1);

namespace Setono\DAOBundle\DependencyInjection\Compiler;

use Exception;
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
        } else {
            if (!$container->has('Buzz\Client\BuzzClientInterface')) {
                throw new Exception('You should specify setono_dao.http_client configuration parameter or define Buzz\Client\BuzzClientInterface service to be used by default');
            }

            $container->setAlias(self::HTTP_CLIENT_SERVICE_ID, 'Buzz\Client\BuzzClientInterface');
        }
    }
}
