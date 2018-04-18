<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Deals;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Deal controller.
 *
 * @Route("deals")
 */
class DealsController extends Controller
{
    /**
     * Lists all deal entities.
     *
     * @Route("/activesDeals", name="deals_actives")
     * @Method("GET")
     */
    public function activeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $id = $user= $this->container->get('security.token_storage')->getToken()->getUser();
       $deals = $em->getRepository('AppBundle:Deals')->findActivedeals();
        //$deals = $em->getRepository('AppBundle:Deals')->findBy(
          //  array('active'=>1)
       // );
var_dump($deals).die();
        return $this->render('deals/index.html.twig', array(
            'deals' => $deals,
        ));
    }
    /**
     * Lists all deal entities.
     *
     * @Route("/", name="deals_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $deals = $em->getRepository('AppBundle:Deals')->findAll();

        return $this->render('deals/index.html.twig', array(
            'deals' => $deals,
        ));
    }

    /**
     * Creates a new deal entity.
     *
     * @Route("/new", name="deals_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $deal = new Deals();
        $form = $this->createForm('AppBundle\Form\DealsType', $deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($deal);
            $em->flush();

            return $this->redirectToRoute('deals_show', array('id' => $deal->getId()));
        }

        return $this->render('deals/new.html.twig', array(
            'deal' => $deal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a deal entity.
     *
     * @Route("/{id}", name="deals_show")
     * @Method("GET")
     */
    public function showAction(Deals $deal)
    {
        $deleteForm = $this->createDeleteForm($deal);

        return $this->render('deals/show.html.twig', array(
            'deal' => $deal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing deal entity.
     *
     * @Route("/{id}/edit", name="deals_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Deals $deal)
    {
        $deleteForm = $this->createDeleteForm($deal);
        $editForm = $this->createForm('AppBundle\Form\DealsType', $deal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('deals_edit', array('id' => $deal->getId()));
        }

        return $this->render('deals/edit.html.twig', array(
            'deal' => $deal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a deal entity.
     *
     * @Route("/{id}", name="deals_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Deals $deal)
    {
        $form = $this->createDeleteForm($deal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($deal);
            $em->flush();
        }

        return $this->redirectToRoute('deals_index');
    }
    /**
     * Finds and displays a deal entity.
     *
     * @Route("/actives", name="aff_deals")
     */
    public function affdealsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id =$this->getUser()->getId();

        var_dump($id);
        $user= $this->container->get('security.token_storage')->getToken()->getUser();
        //$deals = $em->getRepository('AppBundle:Deals')->findActiveDeals($user->getId());

        $deals = $em->getRepository("AppBundle:Deals")->findAll();
        return $this->render(':deals:affdeals.html.twig', array('deals' => $deals));
    }

    /**
     * Creates a form to delete a deal entity.
     *
     * @param Deals $deal The deal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Deals $deal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('deals_delete', array('id' => $deal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
