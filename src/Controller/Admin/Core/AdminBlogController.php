<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\BlogPost;
use App\Form\Core\BlogPostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminBlogController extends BaseController
{
    /**
     * @Route("admin/core/blog/post/list", name="blog_post_list")
     * @Template("core/blog/post/list.html.twig")
     */
    public function listBlogPostsAction()
    {
        $blogPosts = $this->getDoctrine()->getRepository(BlogPost::class)->findAll();

        $templateData = [
            'blogPosts' => $blogPosts,
            'entityName' => 'blog_post',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("admin/core/blog/post/create", name="blog_post_create")
     * @Template("core/blog/post/create.html.twig")
     */
    public function createBlogPostAction(Request $request)
    {
        $form = $this->createForm(BlogPostType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogPost = $form->getData();
            $blogPost->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPost);
            $entityManager->flush();

            $this->addFlash('success', 'Post stworzony!');

            return $this->redirectToRoute('blog_post_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'blog_post',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_BLOG));
    }

    /**
     * @Route("admin/core/blog/post/{id}/edit", name="blog_post_edit")
     * @Template("core/blog/post/edit.html.twig")
     */
    public function editBlogPostAction(Request $request, BlogPost $blogPost)
    {
        $form = $this->createForm(BlogPostType::class, $blogPost);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogPost = $form->getData();
            $blogPost->setAuthor($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPost);
            $entityManager->flush();

            $this->addFlash('success', 'Post zmieniony!');

            return $this->redirectToRoute('blog_post_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'blog_post',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_BLOG));
    }

    /**
     * @Route("/admin/core/blog/post/{id}/kill", name="blog_post_kill")
     */
    public function killBlogPostAction(BlogPost $blogPost)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $blogPost->setIsActive(false);

        $entityManager->persist($blogPost);
        $entityManager->flush();

        $this->addFlash('warning', 'Post zabity!');

        return $this->redirectToRoute('blog_post_list');
    }

    /**
     * @Route("/admin/core/blog/post/{id}/revive", name="blog_post_revive")
     */
    public function reviveBlogPostAction(BlogPost $blogPost)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $blogPost->setIsActive(true);

        $entityManager->persist($blogPost);
        $entityManager->flush();

        $this->addFlash('success', 'Post wskrzeszony!');

        return $this->redirectToRoute('blog_post_list');
    }

    /**
     * @Route("/admin/core/blog/post/{id}/delete", name="blog_post_delete")
     */
    public function deleteBlogPostAction(BlogPost $blogPost)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($blogPost);
        $entityManager->flush();

        $this->addFlash('danger', 'Post usunięty!');

        return $this->redirectToRoute('blog_post_list');
    }
}