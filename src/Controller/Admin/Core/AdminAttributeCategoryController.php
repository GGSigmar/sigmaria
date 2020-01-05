<?php

namespace App\Controller\Admin\Core;

use App\Controller\Base\BaseController;
use App\Entity\Core\AttributeCategory;
use App\Form\Core\AttributeCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminAttributeCategoryController extends BaseController
{
    /**
     * @Route("/admin/core/attribute-category/list", name="attribute_category_list")
     * @Template("core/attribute_category/list.html.twig")
     */
    public function listAttributeCategoriesAction()
    {
        $attributeCategorys = $this->getDoctrine()->getRepository(AttributeCategory::class)->findAll();

        $templateData = [
            'attributeCategories' => $attributeCategorys,
            'entityName' => 'attribute_category',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/attribute_category/create", name="attribute_category_create")
     * @Template("core/attribute_category/create.html.twig")
     */
    public function createAttributeCategoryAction(Request $request)
    {
        $form = $this->createForm(AttributeCategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeCategory = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attributeCategory);
            $entityManager->flush();

            $this->addFlash('success', 'Kategoria atrybutów stworzona!');

            return $this->redirectToRoute('attribute_category_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'attribute_category',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/attribute_category/{id}/edit", name="attribute_category_edit")
     * @Template("core/attribute_category/edit.html.twig")
     */
    public function editAttributeCategoryAction(Request $request, AttributeCategory $attributeCategory)
    {
        $form = $this->createForm(AttributeCategoryType::class, $attributeCategory);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributeCategory = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($attributeCategory);
            $entityManager->flush();

            $this->addFlash('success', 'Kategoria atrybutów zmieniona!');

            return $this->redirectToRoute('attribute_category_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => 'attribute_category',
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/attribute_category/{id}/kill", name="attribute_category_kill")
     */
    public function killAttributeCategoryAction(AttributeCategory $attributeCategory)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $attributeCategory->setIsActive(false);

        $entityManager->persist($attributeCategory);
        $entityManager->flush();

        $this->addFlash('warning', 'Kategoria atrybutów zabita!');

        return $this->redirectToRoute('attribute_category_list');
    }

    /**
     * @Route("/admin/core/attribute_category/{id}/revive", name="attribute_category_revive")
     */
    public function reviveAttributeCategoryAction(AttributeCategory $attributeCategory)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $attributeCategory->setIsActive(false);

        $entityManager->persist($attributeCategory);
        $entityManager->flush();

        $this->addFlash('success', 'Kategoria atrybutów wskrzeszona!');

        return $this->redirectToRoute('attribute_category_list');
    }

    /**
     * @Route("/admin/core/attribute_category/{id}/delete", name="attribute_category_delete")
     */
    public function deleteAttributeCategoryAction(AttributeCategory $attributeCategory)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($attributeCategory);
        $entityManager->flush();

        $this->addFlash('danger', 'Kategoria atrybutów usunięta!');

        return $this->redirectToRoute('attribute_category_list');
    }
}