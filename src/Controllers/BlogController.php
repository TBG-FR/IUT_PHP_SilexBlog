<?php

namespace DUT\Controllers;
use DUT\Models\Blogpost;
use DUT\Models\Comment;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\Application\UrlGeneratorTrait;

/**
 * @class BlogController
 * Manages all actions related to the blog (posts, comments, admin functionnalities)
 */
class BlogController {
    
    /* ===== ===== ===== Actions related to Posts [Display] ===== ===== ===== */

    /**
     * Gets all the posts from the Database and sends them to a twig template
     */
    public function listPostsAction(Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');
        //$posts = $repository->findAll();
        $posts = $repository->findBy(array(),array('date' => 'DESC'));
        
        // Returns the corresponding page, based on the user state (logged or not)        
        if($app['user']->isLogged() == false) {
            
            return $app['twig']->render('page_allposts.twig', ['posts' => $posts]);
            
        }
        
        else {
            
            return $app['twig']->render('page_allposts.twig', ['posts' => $posts, 'user' => $_SESSION['user']]);
            
        }
        
    }

    /**
     * Gets one single post from the Database and sends it to a twig template
     */
    public function singlePostAction($post_index, Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);
        
        // Returns the corresponding page, based on the user state (logged or not)
        if($app['user']->isLogged() == false) {
            
            return $app['twig']->render('page_singlepost.twig', ['post' => $post, 'comments' => $post->getComments()]);
            
        }
        
        else {
            
            return $app['twig']->render('page_singlepost.twig', ['post' => $post, 'comments' => $post->getComments(), 'user' => $_SESSION['user']]);
            
        }
        
    }
    
    /* ===== ===== ===== Actions related to Admin actions on Posts [Creation & Edition] ===== ===== ===== */

    /**
     * ADMIN : Displays the interface allowing user to edit/create a post
     */
    public function newPostAction(Request $request, Application $app) {
        
        // Returns the error page or continue the execution, based on the user state (admin or not)
        if($app['user']->isAdmin() == false) {
            
            // Gets the user back to the list of posts
            $url = $app['url_generator']->generate('error', array('error' => 'Access Denied : You need to be Admin'));
            return $app->redirect($url);
            
        }
        
        else {

            // Gets the sent values form the form (the "request") or null if there is nothing
            $id = $request->get('id', null);
            $title = $request->get('title', null);
            $content = $request->get('content', null);
            
            // Gets & generates the values related to post's image
            $directory = __DIR__ . '/../../web/posts_imgs/';
            $image_file = $request->files->get('image', null);            
            if(is_null($image_file) == false) { $image_name = $image_file->getClientOriginalName(); }
            else { $image_name = null; }
            
            // IF some values have been entered (=> this isn't a new post)
            if( is_null($title) == false && is_null($content) == false) {

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
                            $newpost = new Blogpost($title, $content, null, $image_name);

                            // Inserts the entry to the DB
                            $entityManager->persist($newpost);
                            $entityManager->flush();
                            
                            if(is_null($image_name) == false) {$image_file->move($directory, $image_name);}
                            
                        }

                        catch (Exception $e) {

                            echo 'Exception : ',  $e->getMessage(), '\n';
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
                            if(is_null($image_name) == false) {$postToUpdate->setImage($image_name);}

                            // Updates the entry in the DB
                            $entityManager->persist($postToUpdate);
                            $entityManager->flush();
                            
                            if(is_null($image_name) == false) {$image_file->move($directory, $image_name);}       

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
                return $app['twig']->render('admin_editpost.twig', ['post' => $newpost, 'user' => $_SESSION['user']]);

            }
            
        }

    }

    /**
     * ADMIN : Allows user to edit or delete a post
     */
    public function adminPostAction($post_index, Application $app, $action) {
        
        // Returns the error page or continue the execution, based on the user state (admin or not)
        if($app['user']->isAdmin() == false) {
            
            // Gets the user back to the list of posts
            $url = $app['url_generator']->generate('error', array('error' => 'Access Denied : You need to be Admin'));
            return $app->redirect($url);
            
        }
        
        else {

            // Gets the values from the Database
            $entityManager = $app['em'];
            $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
            $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);

            switch($action) {

                case "edit":

                    return $app['twig']->render('admin_editpost.twig', ['post' => $post, 'user' => $_SESSION['user']]);

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
    
    /* ===== ===== ===== Actions related to Admin actions on Posts/Comments [Display] ===== ===== ===== */

    /**
     * ADMIN : Gets all the posts from the Database and sends them to another twig template
     */
    public function listPostsShortAction(Application $app) {
        
        // Returns the error page or continue the execution, based on the user state (admin or not)
        if($app['user']->isAdmin() == false) {
            
            // Gets the user back to the list of posts
            $url = $app['url_generator']->generate('error', array('error' => 'Access Denied : You need to be Admin'));
            return $app->redirect($url);
            
        }
        
        else {
            
            // Gets the values from the Database
            $entityManager = $app['em'];
            $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');
            //$posts = $repository->findAll();
            $posts = $repository->findBy(array(),array('date' => 'DESC'));
            
            return $app['twig']->render('admin_allposts.twig', ['posts' => $posts, 'short' => 1, 'user' => $_SESSION['user']]);
            
        }
    }

    /**
     * Gets all the comments from the entire site and sends them to a twig template
     */
    public function listAllCommentsAction(Application $app) {
        
        // Returns the error page or continue the execution, based on the user state (admin or not)
        if($app['user']->isAdmin() == false) {
            
            // Gets the user back to the list of posts
            $url = $app['url_generator']->generate('error', array('error' => 'Access Denied : You need to be Admin'));
            return $app->redirect($url);
            
        }
        
        else {
            
            // Gets the values from the Database
            $entityManager = $app['em'];
            $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');
            //$posts = $repository->findAll();
            $posts = $repository->findBy(array(),array('date' => 'ASC'));;
            
            return $app['twig']->render('page_managecomments.twig', ['posts' => $posts, 'user' => $_SESSION['user']]);
            //return $app['twig']->render('page_managecomments.twig', ['posts' => $posts, 'out_of_post' => 1, 'user' => $_SESSION['user']]);
            
        }
    }
    
    /* ===== ===== ===== Actions related to Comments [Display] ===== ===== ===== */

    /**
     * Gets all the comments from one single post and sends them to a twig template
     */
    public function listCommentsAction($post_index, Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);
        
        // Returns the corresponding page, based on the user state (logged or not)
        if($app['user']->isLogged() == false) {
            
            return $app['twig']->render('page_allcomments.twig', ['post' => $post, 'comments' => $post->getComments(), 'out_of_post' => 1]);
            
        }
        
        else {
            
            return $app['twig']->render('page_allcomments.twig', ['post' => $post, 'comments' => $post->getComments(), 'out_of_post' => 1, 'user' => $_SESSION['user']]);
            
        }
    }

    /**
     * Gets one single comment and sends it to a twig template
     */
    public function singleCommentAction($post_index, $com_index, Application $app) {

        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);

        // Gets the wanted Comment
        foreach($post->getComments() as $com) { if($com->getID() == $com_index) { $comment = $com; } }

        if(isset($comment)) { 
            
            // Returns the corresponding page, based on the user state (logged or not)
            if($app['user']->isLogged() == false) {
            
                return $app['twig']->render('page_singlecomment.twig', ['post' => $post, 'comment' => $comment, 'out_of_post' => 1]);
                
            }
            
            else {
                
                return $app['twig']->render('page_singlecomment.twig', ['post' => $post, 'comment' => $comment, 'out_of_post' => 1, 'user' => $_SESSION['user']]);
                
            }
            
        }
        
        // Returns the error page if the Comment doesn't exist
        else { return $app['twig']->render('page_error.twig', ['error' => "Comment not found"]); }

    }
    
    /* ===== ===== ===== Actions related to Comments [Creation & Edition] ===== ===== ===== */

    /**
     * Displays the interface allowing user to edit/create a comment
     */
    public function newCommentAction($post_index, Request $request, Application $app) {
        
        // Returns the error page or continue the execution, based on the user state (logged or not)
        if($app['user']->isLogged() == false) {
            
            // Gets the user back to the list of posts
            $url = $app['url_generator']->generate('error', array('error' => 'Access Denied : You need to be Logged'));
            return $app->redirect($url);
            
        }
        
        else {

            // Gets the sent values form the form (the "request") or null if there is nothing
            $id = $request->get('id', null);
            $content = $request->get('content', null);

            // IF some values have been entered (=> this isn't a new comment)
            if( is_null($content) == false ) {

                $entityManager = $app['em'];

                // IF there is no content (=> probably an error)
                if( $content == '' ) {

                    /* TODO : ADD ERROR */
                    echo 'Exception : OWN_ERR_:_NO_CONTENT \n';

                    return $app['twig']->render('comments_edit.twig', ['postID' => $post_index, 'comment' => new Comment($content, $id)]);

                }

                // ELSE [there is content] (=> insert or update needed)
                else {

                    // IF there is no ID (=> insertion requested, new post)
                    if($id == '') {

                        try {

                            // Creates a new post
                            $newcom = new Comment($content, null);
                            
                            // Add to the new post the related User and Post
                            $newcom->setUser($entityManager->find('DUT\\Models\\User', $_SESSION['user']->getID()));                            
                            $relatedPost = $entityManager->find('DUT\\Models\\Blogpost', $post_index);                            
                            $newcom->setPost($relatedPost);

                            // Inserts the entry to the DB
                            $entityManager->persist($newcom);
                            $entityManager->flush();
                        }

                        catch (Exception $e) {

                            echo 'Exception : ',  $e->getMessage(), '\n';
                            //$this->storage->addElement($e->getMessage());                           

                        }

                    }

                    // ELSE [there is an ID] (=> update requested, not a new post)
                    else {

                        try {

                            // Gets the comment we want to edit
                            $comToUpdate = $entityManager->find('DUT\\Models\\Comment', $id);
                            $comToUpdate->setContent($content);

                            // Updates the entry in the DB
                            $entityManager->persist($comToUpdate);
                            $entityManager->flush();

                        }

                        catch (Exception $e) {

                            echo 'Exception : ',  $e->getMessage(), "\n";
                            //$this->storage->addElement($e->getMessage());                           

                        }

                    }
                    
                    /*
                    $app->get('/post/{post_index}/comments', 'DUT\\Controllers\\BlogpostsController::listCommentsAction')
    ->bind('comments');*/

                    // Gets the user back to the list of comments
                    //$url = $app['url_generator']->generate('admin-posts');
                    //$url = $app['url_generator']->url('post/'.$comment->getPost()->getID().'/comments');
                    if(isset($newcom)) { $comment = $newcom; }
                    else if(isset($comToUpdate)) { $comment = $comToUpdate; }
                    else { $comment = new Comment($content, null); }
                    
                    //$url = $app['url_generator']->generate('comments',['post_index' => $comment->getPost()->getID()]);
                    $url = $app['url_generator']->generate('comments',['post_index' => $post_index]);
                    return $app->redirect($url);

                }

            }

            // ELSE [nothing have been entered] (=> this is a new post)
            else {

                // Creates a new empty post
                $newcom = new Comment("");

                // Sends those values to the twig template
                return $app['twig']->render('comments_edit.twig', ['postID' => $post_index, 'comment' => $newcom]);

            }
            
        }

    }

    /**
     * ADMIN : Allows user to edit or delete a post
     */
    public function manageCommentAction($post_index, $com_index, Application $app, $action) {
        
        // Returns the error page or continue the execution, based on the user state (logged or not)
        if($app['user']->isLogged() == false) {
            
            $url = $app['url_generator']->generate('error', array('error' => 'Access Denied : You need to be Logged'));
            return $app->redirect($url);
            
        }
        
        else {

            // Gets the values from the Database
            $entityManager = $app['em'];
            $repository = $entityManager->getRepository('DUT\\Models\\Comment');        
            $comment = $entityManager->find('DUT\\Models\\Comment', $com_index);
            
            // Checks if the User is the owner of that Comment
            if($_SESSION['user']->getAdmin() == 0 and $_SESSION['user']->getID() != $comment->getUser()->getID()) {
                
                $url = $app['url_generator']->generate('error', array('error' => 'Access Denied : You need to be the author of that Comment'));
                return $app->redirect($url);
            }

            switch($action) {

                case "edit":

                    return $app['twig']->render('comments_edit.twig', ['postID' => $post_index, 'comment' => $comment]);

                    break;

                case "delete":

                    $entityManager->remove($comment);
                    $entityManager->flush();
                    
                    //$url = $app->url('post/'.$comment->getPost()->getID().'/comments');
                    $url = '/post/'.$comment->getPost()->getID().'/comments';
                    return $app->redirect($url);

                    break;

                default :

                    /* TODO : Add error notification */

                    $url = $app['url_generator']->generate('error');
                    return $app->redirect($url);

            }
            
        }
            
    }
    
    /* ===== ===== ===== Other Actions (errors, etc) ===== ===== ===== */

    /**
     * Sends the user to the error page with the given error
     */
    public function errorAction(Request $request, Application $app) {

        // Gets the sent values form the form (the "request") or null if there is nothing
        $error = $request->get('error', null);
        
        return $app['twig']->render('page_error.twig', ['error' => $error]);
        
    }

}