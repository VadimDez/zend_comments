<?php
/**
 * Created by PhpStorm.
 * User: vadimdez
 * Date: 09/11/13
 * Time: 17:51
 */


return array(
    'controllers' => array(
        'invokables' => array(
            'Comments\Controller\Comments' => 'Comments\Controller\CommentsController',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'comments_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Comments/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Comments\Entity' => 'comments_entities'
                )
            ))),

    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Comments\Controller\Comments',
                        'action'     => 'index',
                    ),
                ),
            ),
            'comments' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/comments[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Comments\Controller\Comments',
                        'action'     => 'index',
                    ),
                ),
            ),

        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'comments' => __DIR__ . '/../view',
        ),
    ),
);