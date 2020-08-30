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
     * @Route("/admin/core/trait-category/list", name="trait_category_list")
     * @Template("core/trait_category/list.html.twig")
     */
    public function listAttributeCategoriesAction()
    {
        $attributeCategories = $this->getDoctrine()->getRepository(AttributeCategory::class)->findAll();

        $templateData = [
            'attributeCategories' => $attributeCategories,
            'entityName' => AttributeCategory::ENTITY_NAME,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/trait_category/create", name="trait_category_create")
     * @Template("base/base_form.html.twig")
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

            $this->addEntityActionFlash(AttributeCategory::getFormattedName(), BaseController::ENTITY_CREATE_ACTION);

            return $this->redirectToRoute('trait_category_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => AttributeCategory::ENTITY_NAME,
            'formattedEntityName' => AttributeCategory::getFormattedName(),
            'actionName' => BaseController::ENTITY_CREATE_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/trait_category/{id}/edit", name="trait_category_edit")
     * @Template("base/base_form.html.twig")
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

            $this->addEntityActionFlash(AttributeCategory::getFormattedName(), BaseController::ENTITY_EDIT_ACTION);

            return $this->redirectToRoute('trait_category_list');
        }

        $templateData = [
            'form' => $form->createView(),
            'entityName' => AttributeCategory::ENTITY_NAME,
            'formattedEntityName' => AttributeCategory::getFormattedName(),
            'actionName' => BaseController::ENTITY_EDIT_ACTION,
        ];

        return array_merge($templateData, $this->getTemplateData(BaseController::NAV_TAB_ADMIN));
    }

    /**
     * @Route("/admin/core/trait_category/{id}/delete", name="trait_category_delete")
     */
    public function deleteAttributeCategoryAction(AttributeCategory $attributeCategory)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($attributeCategory);
        $entityManager->flush();

        $this->addEntityActionFlash(AttributeCategory::getFormattedName(), BaseController::ENTITY_DELETE_ACTION);

        return $this->redirectToRoute('trait_category_list');
    }
}