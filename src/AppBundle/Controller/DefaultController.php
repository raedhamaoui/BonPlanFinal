<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Publication;
use AppBundle\Entity\Rating;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [

        ]);
    }


    /**
     * @Route("/admin/", name="admin_homepage")
     */
    public function adminHomepageAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('@App/admin/index.html.twig', [

        ]);
    }

    /**
     * @Route("/experiences", name="experiences_page")
     */
    public function experiencesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $experiences = $em->getRepository("AppBundle:Publication")->findBy(['enabled' => true]);
        $experiences = $this->get('knp_paginator')->paginate($experiences,$request->get('page',1),3);
        // replace this example code with whatever you need
        return $this->render('@App/experiences/index.html.twig', [
            'experiences' => $experiences
        ]);
    }

    /**
     * @Route("/experiences/{id}", name="experiences_detailed")
     */
    public function experiencesDetailedAction(Request $request,Publication $experience)
    {
        $rate = new Rating();
        $form = $this->createForm("AppBundle\Form\RatingType",$rate);
        $form->handleRequest($request);
        $em =$this->getDoctrine()->getManager();
        if($form->isSubmitted() && $form->isValid()){

            $rateValue = $rate->getRate();

            if($experience->getRate() == 0)
                $experience->setRate($rateValue);
            else
                $experience->setRate(($experience->getRate() + $rateValue) /2 );
            $user = $this->getUser();
            $user->addRating($rate);
            $rate->setVotedBy($this->getUser());
            $rate->setVotedTo($experience);

            $em->persist($user);
            $em->persist($experience);
            $em->persist($rate);
            $em->flush();
            return $this->redirectToRoute("experiences_detailed",['id' => $experience->getId()]);
        }

        $showVote = true;
        $voted = $em->getRepository("AppBundle:Rating")->findBy(['votedBy' => $this->getUser(),'votedTo' => $experience]);

        if($voted)
            $showVote = false;

        return $this->render('@App/experiences/detailed.html.twig', [
            'publication' => $experience,
            'form'=> $form->createView(),
            'showVote' => $showVote
        ]);

    }
}
