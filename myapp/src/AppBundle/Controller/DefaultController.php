<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    /**
     * 
     * @Route("/")
     */
    public function newAction(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $users = new User();
        // $users->setFirstName("asma");
        // $users->setLastName("bena");
        // $users->setEmail("asma@gmail.com");
        // $users->setAddress("tunis");

        $form = $this->createFormBuilder($users)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', TextType::class)
            ->add('address', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $users = $form->getData();


            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();
            // return $this->redirectToRoute('task_success');
        }

        return $this->render('default/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * 
     * @Route("/users")
     */

    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render('default/affichage.html.twig', array("users" => $users));
    }
}
