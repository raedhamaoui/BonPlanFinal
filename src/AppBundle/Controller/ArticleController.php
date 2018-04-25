<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\LikesArticle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 *
 * @Route("article")
 */
class ArticleController extends Controller
{
    /**
     * Lists all article entities.
     *
     * @Route("/", name="article_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findBy(['createdBy' => $this->getUser()]);

        return $this->render('article/index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * Lists all article entities.
     *
     * @Route("/show/all", name="article_show_all")
     * @Method("GET")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findBy(['enabled' => true]);

        return $this->render('@App/article/index.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * Lists all article entities.
     *
     * @Route("/disable/{id}", name="article_disable")
     * @Method("GET")
     */
    public function disableAction(Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $article->setEnabled(false);
        $em->persist($article);
        $em->flush();

        return $this->redirectToRoute("admin_articles_all");
    }

    /**
     * Creates a new article entity.
     *
     * @Route("/new", name="article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('AppBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setCreatedBy($this->getUser());
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render('article/new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);

        $likes = $article->getLikes();
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
        $liked = $em->getRepository("AppBundle:LikesArticle")->findOneBy(['article' => $article,'likesBy' => $this->getUser()]);


        return $this->render('article/show.html.twig', array(
            'article' => $article,
            'delete_form' => $deleteForm->createView(),
            'liked' => $liked,
            'totalLikes' => $totalLike,
            'totalDislikes' => $totalDisLike
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/likes/{id}", name="article_like")
     * @Method("GET")
     */
    public function likesAction(Article $article)
    {
        $like = new LikesArticle();
        $like->setArticle($article);
        $like->setLikesBy($this->getUser());
        $like->setNote(1);
        $article->addLike($like);
        $user  =$this->getUser();
        $user->addLike($like);
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->persist($user);
        $em->persist($article);
        $em->flush();
        return $this->redirectToRoute("article_show",['id' => $article->getId()]);
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/dislikes/{id}", name="article_dislike")
     * @Method("GET")
     */
    public function dislikesAction(Article $article)
    {
        $like = new LikesArticle();
        $like->setArticle($article);
        $like->setLikesBy($this->getUser());
        $like->setNote(-1);
        $article->addLike($like);
        $user  =$this->getUser();
        $user->addLike($like);
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->persist($user);
        $em->persist($article);
        $em->flush();
        return $this->redirectToRoute("article_show",['id' => $article->getId()]);
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('AppBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_edit', array('id' => $article->getId()));
        }

        return $this->render('article/edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a article entity.
     *
     * @Route("/{id}", name="article_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * Creates a form to delete a article entity.
     *
     * @param Article $article The article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
