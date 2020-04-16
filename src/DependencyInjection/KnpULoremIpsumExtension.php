<?php

namespace KnpU\LoremIpsumBundle\DependencyInjection;

use KnpU\LoremIpsumBundle\WordProviderInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class KnpULoremIpsumExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $configs = $this->processConfiguration($configuration, $configs);
        $definition = $container->getDefinition('knpu_lorem_ipsum.knpu_ipsum');

        $definition->setArgument(1, $configs['unicorns_are_true']);
        $definition->setArgument(2, $configs['min_sunshine']);

        $container->registerForAutoconfiguration(WordProviderInterface::class)
            ->addTag('knpu_ipsum_word_provider');
    }

    public function getAlias()
    {
        return 'knpu_lorem_ipsum';
    }
}