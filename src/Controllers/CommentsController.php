<?php

namespace DUT\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use DUT\Models\Blogpost;

class CommentsController {

    /**
     * Gets all the comments of a post from the Database and sends them to a twig template
     */
    public function listAction($post_index, Application $app) {
        
        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');
        $posts = $repository->findAll();
        
        foreach($posts as $post) { foreach($post->getComments() as $com) { var_dump($com->getContent()); } } /* TEMP */
        
        
        /*$url = $app['url_generator']->generate('article',1);
        return $app->redirect($url);*/
        
        
        // Sends those values to the twig template
        return $app['twig']->render('page_allposts.twig', ['posts' => $posts]);
    }

    /**
     * Gets one single post from the Database and sends it to a twig template
     */
    public function singleAction($post_index, $com_index, Application $app) {
        
        // Gets the values from the Database
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Blogpost');        
        $post = $entityManager->find('DUT\\Models\\Blogpost', $post_index);
        
        // Sends those values to the twig template
        return $app['twig']->render('page_singlepost.twig', ['post' => $post]);
    }
    
    
    
    /*

    protected $storage;

    public function __construct() {
        $this->storage = new SessionStorage();
    }
    
    /* ===== ===== ===== Méthodes "TP1 Correction" : Session ===== ===== ===== //*

    public function listAction_OLD() {
        $storage = new SessionStorage();
        $html = '<h2>Home</h2>';
        $html .= '<a href="create">Ajouter</a>';
        $html .= '<ul>';

        foreach ($storage->getElements() as $index => $value) {
            $html .= '<li>' . $value . ' <a href="remove_old/' . $index . '">Suppr.</a></li>';
        }

        $html .= '</li>';

        return new Response($html);
    }

    public function createAction_OLD(Request $request, Application $app) {
        $name = $request->get('name', null);
        $url = $app['url_generator']->generate('home_old');

        if (!is_null($name)) {
            $this->storage->addElement($name);

            return $app->redirect($url);
        }

        $html = '<h2>Ajouter</h2><form action="create_old" method="post">';
        $html .= '<label for="input">Nom</label><input id="input" type="text" name="name">';
        $html .= '<button>Valider</button></form>';

        return new Response($html);
    }

    public function deleteAction_OLD($index, Application $app) {
        $this->storage->removeElement($index);

        $url = $app['url_generator']->generate('home');

        return $app->redirect($url);
    }
    
    /* ===== ===== ===== Méthodes TP2 : Base de Données ===== ===== ===== //*

    public function listAction(Application $app) {
        
        // Récupérer les valeurs de la base de données
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\Item');
        $items = $repository->findAll();
        
        /*
        // Formatage HTML de la page
        $html = '<h2>Liste</h2>';
        $html .= '<a href="create">Ajouter</a>';
        $html .= '<ul>';

        // Parcourir & Afficher les valeurs récupérées
        foreach ($items as $item) {
            
            if($item->getCheck() == 1){ $checked = "checked"; $checked_text = "Uncheck"; }
            else { $checked = ""; $checked_text = "Check"; }
            
            
            $html .= '<li><input type="checkbox" name="check"' . $checked . ' disabled>' . $item->getTitle() . '
            <a href="remove/' . $item->getID() . '">Delete it !</a>
            <a href="check/' . $item->getID() . '">' . $checked_text . ' it !</a></li>';
        }

        $html .= '</li>';

        return new Response($html);//*
        
        return $app['twig']->render('displaylist.twig', ['items' => $items]);
    }

    public function createAction(Request $request, Application $app) {
        
        // Récupérer l'entity manager (Permet la manipulation des Entity => BD)
        $entityManager = $app['em'];        
        
        // Récupérer la requête, ou NULL si il n'y en a pas
        $name = $request->get('name', null);
        
        $url = $app['url_generator']->generate('home');

        if (!is_null($name)) {
            
            try {
                
            // Création d'un nouvel Item
            $newItem = new Item($name);
            
            // "Validation" puis Ajout à la BD
            $entityManager->persist($newItem);
            $entityManager->flush();
            }
            
            catch (Exception $e) {
                
                //echo 'Exception reçue : ',  $e->getMessage(), "\n";
                $this->storage->addElement($e->getMessage());                           
                
            }

            return $app->redirect($url);
        }

        $html = '<h2>Ajouter</h2><form action="create" method="post">';
        $html .= '<label for="input">Titre</label><input id="input" type="text" name="name">';
        $html .= '<button>Valider</button></form>';

        return new Response($html);
    }

    public function deleteAction($index, Application $app) {
        
        // Récupérer l'entity manager (Permet la manipulation des Entity => BD)
        $entityManager = $app['em'];
        
        // Trouver l'item à enlever
        $itemToRemove = $entityManager->find('DUT\\Models\\Item', $index);

        $entityManager->remove($itemToRemove);
        $entityManager->flush();

        $url = $app['url_generator']->generate('home');

        return $app->redirect($url);
    }

    public function checkAction($index, Application $app) {
        
        // Récupérer l'entity manager (Permet la manipulation des Entity => BD)
        $entityManager = $app['em'];
        
        // Trouver l'item à modifier
        $itemToCheck = $entityManager->find('DUT\\Models\\Item', $index);
        
        var_dump($itemToCheck);
        
        if($itemToCheck->getCheck() == 1) { $itemToCheck->setCheck(0); }
        else  { $itemToCheck->setCheck(1); }
        
        // "Validation" puis Ajout à la BD
        $entityManager->persist($itemToCheck);
        $entityManager->flush();

        $url = $app['url_generator']->generate('home');

        return $app->redirect($url);
    }*/
    
    
}