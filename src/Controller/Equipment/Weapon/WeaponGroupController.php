<?php

namespace App\Controller\Equipment\Weapon;

use App\Entity\Equipment\Weapon\WeaponGroup;
use App\Form\Equipment\Weapon\WeaponGroupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WeaponGroupController extends AbstractController
{
    /**
     * @Route("/equipment/weapon/group/list", name="list_weapon_groups")
     * @Template("equipment/weapon/group/list.html.twig")
     */
    public function listWeaponGroupsAction() {
        $weaponGroups = $this->getDoctrine()->getRepository(WeaponGroup::class)
            ->findBy(['isActive' => true]);

        return [
            'weaponGroups' => $weaponGroups,
        ];
    }

    /**
     * @Route("/equipment/weapon/group/create", name="create_weapon_group")
     * @Template("equipment/weapon/group/form.html.twig")
     */
    public function createWeaponGroupAction(Request $request) {
        $form = $this->createForm(WeaponGroupType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponGroup = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weaponGroup);
            $entityManager->flush();

            $this->addFlash('success', 'Weapon group created!');

            return $this->redirectToRoute('list_weapon_groups');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/equipment/weapon/group/{id}/edit", name="edit_weapon_group")
     * @Template("equipment/weapon/group/form.html.twig")
     */
    public function editWeaponGroupAction(Request $request, WeaponGroup $weaponGroup) {
        $form = $this->createForm(WeaponGroupType::class, $weaponGroup);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponGroup = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($weaponGroup);
            $entityManager->flush();

            $this->addFlash('success', 'Weapon group edited!');

            return $this->redirectToRoute('list_weapon_groups');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/equipment/weapon/group/{id}/delete", name="delete_weapon_group")
     */
    public function deleteWeaponGroupAction(WeaponGroup $weaponGroup) {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($weaponGroup);
        $entityManager->flush();

        $this->addFlash('success', 'Weapon group deleted!');

        return $this->redirectToRoute('list_weapon_groups');
    }
}