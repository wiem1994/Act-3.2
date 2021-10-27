<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class actController extends Controller
{
    /**
     * @Route("/user", name="activité")
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        return $this->render('activity/index.html.twig', array('users' => $users));
    }
    /**
     * @Route("/user/create", name="user_create")
     */
    public function createAction(Request $request)
    {
        $user = new User;
        $form = $this->createFormBuilder($user)
            ->add('firstName', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('lastName', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('email', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Adress', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Birthdate', DateTimeType::class, array('attr' => array('class' => 'form-control')))
            ->add('submit', SubmitType::class, array('label' => 'add user', 'attr' => array('class' => 'form-control')))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $firstname = $form['firstName']->getData();
            $lastname = $form['lastName']->getData();
            $email = $form['email']->getData();
            $adress = $form['Adress']->getData();
            $birthdate = $form['Birthdate']->getData();

            $user->setFirstname($firstname);
            $user->setLastname($firstname);
            $user->setEmail($email);
            $user->setAdress($adress);
            $user->setBirthdate($birthdate);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //  die('yes');
        }
        return $this->render('activity/create.html.twig', array('form' => $form->createView()));
    }

    /**

     * @Route("/getUserById/{id}", name="getUserById")

     */

    public function findUserById($id)

    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findById($id);
        return new Response($id);
        //  return $this->render('activity/index.html.twig', array('users' => $users));
    }



    /**

     * @Route("/getUserByCity/{city}", name="getUserByCity")

     */



    public function findAllByCity($city)

    {

        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAllByCity($city);

        // return new Response(vardump($users));

        return $this->render('activity/index.html.twig', array('users' => $users));
    }



    /**

     * @Route("/findByAddressAndEmail/{address}/{email}", name="getUserByCityAndEmail")

     */



    public function findByAddressAndName($adress, $email)

    {

        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findByAddressAndName($adress, $email);

        return new Response($adress, $email);

        //return $this->render('activity/index.html.twig', array('users' => $users));
    }
}
