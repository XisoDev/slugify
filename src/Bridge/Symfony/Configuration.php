<?php

/*
 * This file is part of the xisodev/slugify package.
 *
 * (c) Enrico Stahn <enrico.stahn@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace XisoDev\Slugify\Bridge\Symfony;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('xisodev_slugify');

        // Keep compatibility with symfony/config < 4.2
        if (\method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $rootNode = $treeBuilder->root('xisodev_slugify');
        }

        $rootNode
            ->children()
                ->booleanNode('lowercase')->end()
                ->booleanNode('lowercase_after_regexp')->end()
                ->booleanNode('trim')->end()
                ->booleanNode('strip_tags')->end()
                ->scalarNode('separator')->end()
                ->scalarNode('regexp')->end()
                ->arrayNode('rulesets')->prototype('scalar')->end()
            ->end();

        return $treeBuilder;
    }
}
