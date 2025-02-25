<?php 

return static function($definition)
{
    $definition->rootNode()->children()

        ->arrayNode('tables_name')
            ->addDefaultsIfNotSet()
            ->children()
            
                ->scalarNode('faq')
                    ->info("The table name of the entity Faq")
                    ->defaultValue('faq')
                ->end()
                    
                ->scalarNode('category')
                    ->info("The table name of the entity Category")
                    ->defaultValue('faq_category')
                ->end()
                    
                ->scalarNode('translation')
                    ->info("The table name of the entity Translation")
                    ->defaultValue('faq_translation')
                ->end()
                    
                ->scalarNode('vote')
                    ->info("The table name of the entity Vote")
                    ->defaultValue('faq_vote')
                ->end()
                    
                ->scalarNode('tag')
                    ->info("The table name of the entity Tag")
                    ->defaultValue('faq_tag')
                ->end()

            ->end()
        ->end()

    ->end();
};