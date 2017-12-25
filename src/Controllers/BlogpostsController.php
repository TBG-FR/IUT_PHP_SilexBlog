<?php

namespace DUT\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use DUT\Models\Blogpost;

/**
 * @class BlogpostsController
 * Manages all actions related to the blog (main actions on articles)
 */
class BlogpostsController {

    /**
     * Gets all the posts from the Database and sends them to a twig template
     */
    public function listPostsAction(Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');
        $posts = $repository->findAll();

        /*$url = $app['url_generator']->generate('article',1);
        return $app->redirect($url);*//*TEMP */

        if(isAdmin()) { return $app['twig']->render('page_allposts.twig', ['posts' => $posts, 'user' => "admin"]); } /* TEMP */
        else { return $app['twig']->render('page_allposts.twig', ['posts' => $posts]); }

        //        // Sends those values to the twig template
        //        return $app['twig']->render('page_allposts.twig', ['posts' => $posts]);
    }

    /**
     * Gets all the posts from the Database and sends them to another twig template
     */
    public function listPostsShortAction(Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');
        $posts = $repository->findAll();

        /*$url = $app['url_generator']->generate('article',1);
        return $app->redirect($url);*//*TEMP */


        if(isAdmin()) { return $app['twig']->render('page_allposts.twig', ['posts' => $posts, 'short' => 1, 'user' => "admin"]); } /* TEMP */
        else { return $app['twig']->render('page_allposts.twig', ['posts' => $posts, 'short' => 1]); }

        //        // Sends those values to the twig template
        //        return $app['twig']->render('page_allposts.twig', ['posts' => $posts, 'short' => 1]);
    }

    /**
     * Gets one single post from the Database and sends it to a twig template
     */
    public function singlePostAction($post_index, Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);

        // Sends those values to the twig template
        return $app['twig']->render('page_singlepost.twig', ['post' => $post, 'comments' => $post->getComments()]);
    }

    /**
     * Gets all the comments from one single post and sends it to a twig template
     */
    public function listCommentsAction($post_index, Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);

        // Sends those values to the twig template
        return $app['twig']->render('page_allcomments.twig', ['post' => $post, 'comments' => $post->getComments(), 'out_of_post' => 1]);
    }

    /**
     * Gets one single comment and sends it to a twig template
     */
    public function singleCommentAction($post_index, $com_index, Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);

        foreach($post->getComments() as $com) { 

            if($com->getID() == $com_index) { $comment = $com; }

        }

        if(isset($comment)) { return $app['twig']->render('page_singlecomment.twig', ['post' => $post, 'comment' => $comment, 'out_of_post' => 1]); }

        else { return $app['twig']->render('page_error.twig', ['error' => "Comment not found"]); }

    }

    /**
     * Gets one single post from the Database and sends it to a twig template
     */
    public function newPostAction(Request $request, Application $app) {

        // Gets the sent values form the form (the "request") or null if there is nothing
        $id = $request->get('id', null);
        $title = $request->get('title', null);
        $content = $request->get('content', null);
        $image = $request->get('image', null);

        var_dump($id);
        var_dump($title);
        var_dump($content);

        // IF some values have been entered (=> this isn't a new post)
        if( is_null($title) == false && is_null($content) == false) {

            // Gets the values from the Database
            $entityManager = $app['em'];

            // IF there is no content (=> probably an error)
            if( $title == '' || $content == '' ) {

                /* TODO : ADD ERROR */
                echo 'Exception : OWN_ERR_:_NO_CONTENT \n';

                return $app['twig']->render('admin_editpost.twig', ['post' => new Blogpost($title, $content, $id, $image)]);

            }

            // ELSE [there is content] (=> insert or update needed)
            else {

                // IF there is no ID (=> insertion requested, new post)
                if($id == '') {

                    try {

                        // Creates a new post
                        $newpost = new Blogpost($title, $content, null, $image);

                        // Inserts the entry to the DB
                        $entityManager->persist($newpost);
                        $entityManager->flush();
                    }

                    catch (Exception $e) {

                        echo 'Exception : ',  $e->getMessage(), "\n";
                        //$this->storage->addElement($e->getMessage());                           

                    }

                }

                // ELSE [there is an ID] (=> update requested, not a new post)
                else {

                    try {

                        // Gets the post we want to edit
                        $postToUpdate = $entityManager->find('DUT\\Models\\Blogpost', $id);

                        $postToUpdate->setTitle($title);
                        $postToUpdate->setContent($content);
                        $postToUpdate->setImage($image);

                        // Updates the entry in the DB
                        $entityManager->persist($postToUpdate);
                        $entityManager->flush();

                    }

                    catch (Exception $e) {

                        echo 'Exception : ',  $e->getMessage(), "\n";
                        //$this->storage->addElement($e->getMessage());                           

                    }

                }

                // Gets the user back to the list of posts
                $url = $app['url_generator']->generate('admin-posts');
                return $app->redirect($url);

            }

        }

        // ELSE [nothing have been entered] (=> this is a new post)
        else {

            // Creates a new empty post
            $newpost = new Blogpost("", "");

            // Sends those values to the twig template
            return $app['twig']->render('admin_editpost.twig', ['post' => $newpost]);

        }

    }

    /**
     * Gets one single post from the Database and sends it to a twig template
     */
    public function adminPostAction($post_index, Application $app, $action) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);

        switch($action) {

            case "edit":

                return $app['twig']->render('admin_editpost.twig', ['post' => $post]);

                break;

            case "delete":

                $entityManager->remove($post);
                $entityManager->flush();

                $url = $app['url_generator']->generate('admin-posts');
                return $app->redirect($url);

                break;

            default :

                /* TODO : Add error notification */

                $url = $app['url_generator']->generate('admin-posts');
                return $app->redirect($url);

        }
    }

}