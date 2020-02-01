<?php

namespace App\Controller\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\BlogPost;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends BaseController
{
    /**
     * @Route("/core/blog/{page}", name="blog")
     * @Template("core/blog/blog.html.twig")
     */
    public function blogAction(PaginatorInterface $paginator, int $page = 1)
    {
        $queryBuilder = $this->getDoctrine()->getRepository(BlogPost::class)->getBlogPostsQueryBuilder();

        $pagination = $paginator->paginate(
            $queryBuilder,
            $page,
            10
        );

        $templateData = [
            'blogPosts' => $pagination,
            'entityName' => 'blog_post',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_BLOG));
    }
}