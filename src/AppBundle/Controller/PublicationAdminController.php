<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Publication controller.
 *
 * @Route("admin/publication")
 */
class PublicationAdminController extends Controller
{
    /**
     * Lists all publication entities.
     *
     * @Route("/", name="admin_publication_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publications = $em->getRepository('AppBundle:Publication')->findAll();

        return $this->render('admin/publication/index.html.twig', array(
            'publications' => $publications,
        ));
    }

    /**
     * Finds and displays a publication entity.
     *
     * @Route("/{id}", name="admin_publication_show")
     * @Method("GET")
     */
    public function showAction(Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);

        return $this->render(':admin/publication:show.html.twig', array(
            'publication' => $publication,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a publication entity.
     *
     * @Route("/disable/{id}", name="admin_publication_disable")
     * @Method("GET")
     */
    public function disableAction(Publication $publication)
    {
        $em = $this->getDoctrine()->getManager();
        $publication->setEnabled(false);
        $em->persist($publication);
        $em->flush();
        return $this->redirectToRoute("admin_publication_show",['id' => $publication->getId()]);
    }

    /**
     * Deletes a publication entity.
     *
     * @Route("/{id}", name="admin_publication_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Publication $publication)
    {
        $form = $this->createDeleteForm($publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publication);
            $em->flush();
        }

        return $this->redirectToRoute('admin_publication_index');
    }

    /**
     * Creates a form to delete a publication entity.
     *
     * @param Publication $publication The publication entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publication $publication)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_publication_delete', array('id' => $publication->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
