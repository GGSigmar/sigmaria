<?php

namespace App\Service\Helper;

use App\Entity\Core\Feat;
use App\Form\Core\FeatType;
use App\Service\Core\SourceableService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class EntityControllerHelper
{
    private const ENTITY_TO_FORM_MAP = [
        Feat::class => FeatType::class,
    ];

    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var SourceableService */
    private $sourceableService;

    /** @var EntityManagerInterface */
    private $em;

    /** @var object|null */
    private $editedEntity;

    /** @var FormInterface|null */
    private $entityForm;

    public function __construct(
        FormFactoryInterface $formFactory,
        SourceableService $sourceableService,
        EntityManagerInterface $em
    ) {
        $this->formFactory = $formFactory;
        $this->sourceableService = $sourceableService;
        $this->em = $em;
    }

    public function getEditedEntity()
    {
        return $this->editedEntity;
    }

    public function getEntityForm(): ?FormInterface
    {
        return $this->entityForm;
    }

    public function createEntity(Request $request)
    {

    }

    public function getEntityArrayForList(string $entityClassName): array
    {
        return $this->em->getRepository($entityClassName)->findAll();
    }

    public function editEntity(Request $request, string $formClass, $entity)
    {
        $edits = $entity->getEdits();

        if ($entity->isEdit() || !$entity->isActive()) {
            $entityToBeEdited = $entity;
        } else {
            $entityToBeEdited = $edits ? $edits : clone $entity;
        }

        $form = $this->formFactory->create($formClass, $entityToBeEdited);
        $this->entityForm = $form;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($entityToBeEdited->isEdit() || !$entityToBeEdited->isActive()) {
                $editedEntity = $form->getData();
            } else {
                $editedEntity = $form->getData();
                $editedEntity->setIsEdit(true);
                $editedEntity->setIsActive(true);
                $editedEntity->isToBeReleased(false);
                $editedEntity->setEditParent($entity);
                $entity->setEdits($editedEntity);
                $entity->isToBeReleased(true);
            }

            if (property_exists($entity, 'source')) {
                $this->sourceableService->ensureEmptySourceNullification($editedEntity);
            }

            $this->em->persist($editedEntity);
            $this->em->persist($entity);

            $this->editedEntity = $editedEntity;
            return $editedEntity;
        }

        return null;
    }
}