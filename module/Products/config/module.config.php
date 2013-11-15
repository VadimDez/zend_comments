<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 10/11/13
 * Time: 10:09
 */


return array(
    'controllers' => array(
        'invokables' => array(
            'Products\Controller\Products' => 'Products\Controller\ProductsController',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'products_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Products/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Products\Entity' => 'products_entities'
                )
            ))),

    'router' => array(
        'routes' => array(
            'products' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/products[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Products\Controller\Products',
                        'action'     => 'index',
                    ),
                ),
            ),

        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'products' => __DIR__ . '/../view',
        ),
    ),
);