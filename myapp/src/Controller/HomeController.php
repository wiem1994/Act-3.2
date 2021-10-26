<?php

namespace App\Controller;



use App\Entity\User;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController

{

    /**

     * @Route("/")

     * @return Response

     */

    public function postUser()

    {
        $users = new User();
        $users->setFirstName("asma");
        $users->setLastName("bena");
        $users->setEmail("asma@gmail.com");
        $users->setAddress("tunis");
        // $user->setBirthDate("2001-06-13");

        /* on confie l'objet $event au gestionnaire d'entités,
            l'objet n'est pas encore enregistrer en base de données */
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($users);
        /* on exécute maintenant les 2 requêtes qui vont ajouter
                les objets $event et $event2 en base de données */
        $entityManager->flush();

        return "user is added";
    }
}
