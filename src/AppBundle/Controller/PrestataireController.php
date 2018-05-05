<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Prestataire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Prestataire controller.
 *
 * @Route("prestataire")
 */
class PrestataireController extends Controller
{
    /**
     * Lists all prestataire entities.
     *
     * @Route("/", name="prestataire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $prestataires = $em->getRepository('AppBundle:Prestataire')->findAll();

        return $this->render('prestataire/index.html.twig', array(
            'prestataires' => $prestataires,
        ));
    }

    /**
     * Creates a new prestataire entity.
     *
     * @Route("/new", name="prestataire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $prestataire = new Prestataire();
        $form = $this->createForm('AppBundle\Form\PrestataireType', $prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestataire);
            $em->flush();

            return $this->redirectToRoute('prestataire_show', array('id' => $prestataire->getId()));
        }

        return $this->render('prestataire/new.html.twig', array(
            'prestataire' => $prestataire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a prestataire entity.
     *
     * @Route("/{id}", name="prestataire_show")
     * @Method("GET")
     */
    public function showAction(Prestataire $prestataire)
    {
        $deleteForm = $this->createDeleteForm($prestataire);

        return $this->render('prestataire/show.html.twig', array(
            'prestataire' => $prestataire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing prestataire entity.
     *
     * @Route("/{id}/edit", name="prestataire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Prestataire $prestataire)
    {
        $deleteForm = $this->createDeleteForm($prestataire);
        $editForm = $this->createForm('AppBundle\Form\PrestataireType', $prestataire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestataire_edit', array('id' => $prestataire->getId()));
        }

        return $this->render('prestataire/edit.html.twig', array(
            'prestataire' => $prestataire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a prestataire entity.
     *
     * @Route("/{id}", name="prestataire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Prestataire $prestataire)
    {
        $form = $this->createDeleteForm($prestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($prestataire);
            $em->flush();
        }

        return $this->redirectToRoute('prestataire_index');
    }

    /**
     * Creates a form to delete a prestataire entity.
     *
     * @param Prestataire $prestataire The prestataire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Prestataire $prestataire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prestataire_delete', array('id' => $prestataire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
