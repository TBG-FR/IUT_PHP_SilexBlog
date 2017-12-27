<?php

namespace DUT\Controllers;
use DUT\Models\Blogpost;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

/**
 * @class CommentsController
 * Manages specific actions related to comments
 */
class CommentsController {

//    /**
//     * Gets all the comments of a post from the Database and sends them to a twig template
//     */
//    public function listAction($post_index, Application $app) {
//        
//        // Gets the values from the Database
//        $entityManager = $app['em'];
//        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');
//        $posts = $repository->findAll();
//        
//        foreach($posts as $post) { foreach($post->getComments() as $com) { var_dump($com->getContent()); } } /* TEMP */
//        
//        
//        /*$url = $app['url_generator']->generate('article',1);
//        return $app->redirect($url);*/
//        
//        
//        // Sends those values to the twig template
//        return $app['twig']->render('page_allposts.twig', ['posts' => $posts]);
//    }
//
//    /**
//     * Gets one single post from the Database and sends it to a twig template
//     */
//    public function singleAction($post_index, $com_index, Application $app) {
//        
//        // Gets the values from the Database
//        $entityManager = $app['em'];
//        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
//        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);
//        
//        // Sends those values to the twig template
//        return $app['twig']->render('page_singlepost.twig', ['post' => $post]);
//    }
    
}
