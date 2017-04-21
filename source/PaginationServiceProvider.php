<?php

/**
 * Part of the SilexPagination.
 *
 * @author  Kilte Leichnam <nwotnbm@gmail.com>
 */
namespace Kilte\Silex\Pagination;

use Kilte\Pagination\Pagination;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * PaginationServiceProvider Class.
 */
class PaginationServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['pagination.per_page'] = isset($app['pagination.per_page']) ? (int) $app['pagination.per_page'] : 20;
        $app['pagination.neighbours'] = isset($app['pagination.neighbours']) ? (int) $app['pagination.neighbours'] : 4;
        $app['pagination.factory'] = function (Container $app) {
            return new PaginationFactory($app['pagination.per_page'], $app['pagination.neighbours']);
        };
        $app['pagination'] = $app->protect(
            function ($total, $current, $perPage = null, $neighbours = null) use ($app) {
                $factory = $app['pagination.factory'];

                return $factory->create($total, $current, $perPage, $neighbours);
            }
        );
    }
}
