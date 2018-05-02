<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Media;
use AppBundle\Entity\LikesPlan;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
/**
 * Plan controller.
 *
 * @Route("plan")
 */
class PlanController extends Controller
{
    /**
     * Lists all plan entities.
     *
     * @Route("/", name="plan_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $transport =(new \Swift_SmtpTransport('smtp.gmail.com'));
        $transporft = \Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl');
        $transporft->setUsername('bonplanbady@gmail.com');
        $transporft->setPassword('bonplanbady01052018');
        $transporft->setAuthMode('login');

        $mailer = new \Swift_Mailer($transporft);

        $message = (new \Swift_Message(('Wonderful aagaegaegaeg')))
            ->setFrom(['bonplanbady@gmail.com'=>'BonPlanBady'])
            ->setTo(['badi3.ben.salah@gmail.com'])
            ->setBody('aegaegmljaegjf');

        $result = $mailer->send($message);




        $em = $this->getDoctrine()->getManager();
        $plans = $em->getRepository('AppBundle:Plan')->findAll();
        return $this->render('plan/index.html.twig', array(
            'plans' => $plans,
        ));
    }
    /**
     * Finds and displays a article entity.
     *
     * @Route("/likes/{id}", name="plan_like")
     * @Method("GET")
     */
    public function likesAction(Plan $plan)
    {
        $like = new LikesPlan();
        $like->setPlan($plan);
        $like->setLikesBy($this->getUser());
        $like->setNote(1);
        $plan->addLike($like);
        $user  =$this->getUser();
        $user->addLikesPlan($like);
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->persist($user);
        $em->persist($plan);
        $em->flush();
        return $this->redirectToRoute("experiences_detailed",['id' => $plan->getId()]);
    }
    /**
     * Finds and displays a article entity.
     *
     * @Route("/dislikes/{id}", name="plan_dislike")
     * @Method("GET")
     */
    public function dislikesAction(Plan $plan)
    {
        $like = new LikesPlan();
        $like->setPlan($plan);
        $like->setLikesBy($this->getUser());
        $like->setNote(-1);
        $publication->addLike($like);
        $user  =$this->getUser();
        $user->addLikesPlan($like);
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->persist($user);
        $em->persist($plan);
        $em->flush();
        return $this->redirectToRoute("experiences_detailed",['id' => $plan->getId()]);
    }
    /**
     * Creates a new plan entity.
     *
     * @Route("/new", name="plan_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plan = new Plan();
        $form = $this->createForm('AppBundle\Form\PlanType', $plan);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file =  $request->files->get('file'); // eli mawjoude fel form input type=file
            $media = new Media();
            $media->setFile($file);
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $plan->addMedia($media);
            $em->flush();
            $plan->setUserName($this->getUser());
            $em->persist($plan);
            $em->flush();
            return $this->redirectToRoute('plan_show', array('id' => $plan->getId()));
        }
        return $this->render('plan/new.html.twig', array(
            'plan' => $plan,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a plan entity.
     *
     * @Route("/{id}", name="plan_show")
     * @Method("GET")
     */
    public function showAction(Plan $plan)
    {
        $deleteForm = $this->createDeleteForm($plan);
        return $this->render('plan/show.html.twig', array(
            'plan' => $plan,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing plan entity.
     *
     * @Route("/{id}/edit", name="plan_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Plan $plan)
    {
        $deleteForm = $this->createDeleteForm($plan);
        $editForm = $this->createForm('AppBundle\Form\PlanType', $plan);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('plan_edit', array('id' => $plan->getId()));
        }
        return $this->render('plan/edit.html.twig', array(
            'plan' => $plan,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a plan entity.
     *
     * @Route("/{id}", name="plan_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Plan $plan)
    {
        $form = $this->createDeleteForm($plan);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plan);
            $em->flush();
        }
        return $this->redirectToRoute('plan_index');
    }
    /**
     * Creates a form to delete a plan entity.
     *
     * @param Plan $plan The plan entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Plan $plan)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('plan_delete', array('id' => $plan->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}