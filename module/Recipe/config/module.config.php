<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 10:31
 */


return array(
    'controllers' => array(
        'invokables' => array(
            'Recipe\Controller\Recipe' => 'Recipe\Controller\RecipeController',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'recipe_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Recipe/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Recipe\Entity' => 'recipe_entities'
                )
            ))),

    'router' => array(
        'routes' => array(
            'recipe' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/recipe[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Recipe\Controller\Recipe',
                        'action'     => 'index',
                    ),
                ),
            ),

        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'recipe' => __DIR__ . '/../view',
        ),
    ),
);