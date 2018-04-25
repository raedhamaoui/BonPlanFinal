<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LikesPublication;
use AppBundle\Entity\Media;
use AppBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Publication controller.
 *
 * @Route("publication")
 */
class PublicationController extends Controller
{
    /**
     * Lists all publication entities.
     *
     * @Route("/", name="publication_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publications = $em->getRepository('AppBundle:Publication')->findBy(['createdBy' => $this->getUser()]);

        return $this->render('publication/index.html.twig', array(
            'publications' => $publications,
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/likes/{id}", name="publication_like")
     * @Method("GET")
     */
    public function likesAction(Publication $publication)
    {
        $like = new LikesPublication();
        $like->setPublication($publication);
        $like->setLikesBy($this->getUser());
        $like->setNote(1);
        $publication->addLike($like);
        $user  =$this->getUser();
        $user->addLikesPub($like);
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->persist($user);
        $em->persist($publication);
        $em->flush();
        return $this->redirectToRoute("experiences_detailed",['id' => $publication->getId()]);
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/dislikes/{id}", name="publication_dislike")
     * @Method("GET")
     */
    public function dislikesAction(Publication $publication)
    {
        $like = new LikesPublication();
        $like->setPublication($publication);
        $like->setLikesBy($this->getUser());
        $like->setNote(-1);
        $publication->addLike($like);
        $user  =$this->getUser();
        $user->addLikesPub($like);
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->persist($user);
        $em->persist($publication);
        $em->flush();
        return $this->redirectToRoute("experiences_detailed",['id' => $publication->getId()]);
    }

    /**
     * Creates a new publication entity.
     *
     * @Route("/new", name="publication_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $publication = new Publication();
        $form = $this->createForm('AppBundle\Form\PublicationType', $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file =  $request->files->get('file'); // eli mawjoude fel form input type=file
            $media = new Media();
            $media->setFile($file);

            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $publication->addMedia($media);
            $em->flush();
            $publication->setCreatedBy($this->getUser());
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
        }

        return $this->render('publication/new.html.twig', array(
            'publication' => $publication,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publication entity.
     *
     * @Route("/{id}", name="publication_show")
     * @Method("GET")
     */
    public function showAction(Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);

        return $this->render('publication/show.html.twig', array(
            'publication' => $publication,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publication entity.
     *
     * @Route("/{id}/edit", name="publication_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Publication $publication)
    {
        $deleteForm = $this->createDeleteForm($publication);
        $editForm = $this->createForm('AppBundle\Form\PublicationType', $publication);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file =  $request->files->get('file'); // eli mawjoude fel form input type=file
            $media = new Media();
            $media->setFile($file);
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $publication->addMedia($media);
            $em->flush();

            return $this->redirectToRoute('publication_edit', array('id' => $publication->getId()));
        }

        return $this->render('publication/edit.html.twig', array(
            'publication' => $publication,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publication entity.
     *
     * @Route("/{id}", name="publication_delete")
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

        return $this->redirectToRoute('publication_index');
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
            ->setAction($this->generateUrl('publication_delete', array('id' => $publication->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
