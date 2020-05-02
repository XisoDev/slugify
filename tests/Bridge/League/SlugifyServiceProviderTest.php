<?php

namespace XisoDev\Slugify\Tests\Bridge\League;

use XisoDev\Slugify\Bridge\League\SlugifyServiceProvider;
use XisoDev\Slugify\RuleProvider\DefaultRuleProvider;
use XisoDev\Slugify\RuleProvider\RuleProviderInterface;
use XisoDev\Slugify\SlugifyInterface;
use League\Container\Container;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class SlugifyServiceProviderTest extends MockeryTestCase
{
    public function testProvidesSlugify()
    {
        $container = new Container();

        $container->addServiceProvider(new SlugifyServiceProvider());

        $slugify = $container->get(SlugifyInterface::class);

        $this->assertInstanceOf(SlugifyInterface::class, $slugify);
        $this->assertAttributeInstanceOf(DefaultRuleProvider::class, 'provider', $slugify);
    }

    public function testProvidesSlugifyAsSharedService()
    {
        $container = new Container();

        $container->addServiceProvider(new SlugifyServiceProvider());

        $slugify = $container->get(SlugifyInterface::class);

        $this->assertSame($slugify, $container->get(SlugifyInterface::class));
    }

    public function testProvidesSlugifyUsingSharedConfigurationOptions()
    {
        $container = new Container();

        $options = [
            'lowercase' => false,
        ];

        $container->share('config.slugify.options', $options);
        $container->addServiceProvider(new SlugifyServiceProvider());

        /* @var SlugifyInterface $slugify */
        $slugify = $container->get(SlugifyInterface::class);

        $slug = 'Foo-Bar-Baz';

        $this->assertSame($slug, $slugify->slugify($slug));
    }

    public function testProvidesSlugifyUsingSharedProvider()
    {
        $container = new Container();

        $ruleProvider = $this->getRuleProviderMock();

        $container->share(RuleProviderInterface::class, $ruleProvider);
        $container->addServiceProvider(new SlugifyServiceProvider());

        $slugify = $container->get(SlugifyInterface::class);

        $this->assertAttributeSame($ruleProvider, 'provider', $slugify);
    }

    /**
     * @return m\Mock|RuleProviderInterface
     */
    private function getRuleProviderMock()
    {
        $ruleProvider = m::mock(RuleProviderInterface::class);

        $ruleProvider
            ->shouldReceive('getRules')
            ->withAnyArgs()
            ->andReturn([])
        ;

        return $ruleProvider;
    }
}
