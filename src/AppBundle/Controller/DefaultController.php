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

        //---------------------------------------------------
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
     * @Route("/admin/articles", name="admin_articles_all")
     */
    public function articlesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findAll();
        // replace this example code with whatever you need
        return $this->render('article/admin/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Lists all event entities.
     *
     * @Route("/admin/events", name="admin_events_index")
     */
    public function eventsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Events')->findAll();

        return $this->render('events/admin/index.html.twig', array(
            'events' => $events,
        ));
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
     * @Route("/participations", name="participations_page")
     */
    public function participationsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $participations = $this->getUser()->getEventsParticipated();

        return $this->render('@App/events/index.html.twig', [
            'events' => $participations
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

        $likes = $experience->getLikes();
        $totalLike = 0;
        $totalDisLike = 0;
        foreach($likes as $like){
            if($like->getNote() == 1){
                $totalLike++;
            }else{
                $totalDisLike++;
            }
        }

        $em = $this->getDoctrine()->getManager();
        $liked = $em->getRepository("AppBundle:LikesPublication")->findOneBy(['publication' => $experience,'likesBy' => $this->getUser()]);

        return $this->render('@App/experiences/detailed.html.twig', [
            'publication' => $experience,
            'form'=> $form->createView(),
            'showVote' => $showVote,
            'liked' => $liked,
            'totalLikes' => $totalLike,
            'totalDislikes' => $totalDisLike
        ]);

    }




}
