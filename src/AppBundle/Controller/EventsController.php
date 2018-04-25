<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 * @Route("events")
 */
class EventsController extends Controller
{
    /**
     * Lists all event entities.
     *
     * @Route("/", name="events_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Events')->findBy(['createdBy' => $this->getUser()]);

        return $this->render('events/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Lists all event entities.
     *
     * @Route("/show/all", name="events_show_all")
     * @Method("GET")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Events')->findBy(['enabled' => true]);

        return $this->render('@App/events/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     * Creates a new event entity.
     *
     * @Route("/new", name="events_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $event = new Events();
        $form = $this->createForm('AppBundle\Form\EventsType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $event->setCreatedBy($this->getUser());
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('events_show', array('id' => $event->getId()));
        }

        return $this->render('events/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/participate/{id}", name="events_participate")
     * @Method("GET")
     */
    public function participateAction(Events $event)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $user->addEventsParticipated($event);
        $event->addParticipant($user);
        $em->persist($event);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute("events_show",['id' => $event->getId()]);
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/{id}", name="events_show")
     * @Method("GET")
     */
    public function showAction(Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('events/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     * @Route("/disable/{id}", name="events_disable")
     * @Method("GET")
     */
    public function disableAction(Events $event)
    {
        $em = $this->getDoctrine()->getManager();
        $event->setEnabled(false);
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute("admin_events_index");
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     * @Route("/{id}/edit", name="events_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('AppBundle\Form\EventsType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('events_edit', array('id' => $event->getId()));
        }

        return $this->render('events/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     * @Route("/{id}", name="events_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Events $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('events_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Events $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Events $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('events_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
