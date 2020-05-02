<?php

namespace XisoDev\Slugify\Bridge\League;

use XisoDev\Slugify\RuleProvider\DefaultRuleProvider;
use XisoDev\Slugify\RuleProvider\RuleProviderInterface;
use XisoDev\Slugify\Slugify;
use XisoDev\Slugify\SlugifyInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;

class SlugifyServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        SlugifyInterface::class,
    ];

    public function register()
    {
        $this->container->share(SlugifyInterface::class, function () {
            $options = [];
            if ($this->container->has('config.slugify.options')) {
                $options = $this->container->get('config.slugify.options');
            }

            $provider = null;
            if ($this->container->has(RuleProviderInterface::class)) {
                /* @var RuleProviderInterface $provider */
                $provider = $this->container->get(RuleProviderInterface::class);
            }

            return new Slugify(
                $options,
                $provider
            );
        });
    }
}
