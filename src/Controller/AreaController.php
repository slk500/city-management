<?php

declare(strict_types=1);


namespace App\Controller;


use App\Entity\Area;
use App\Entity\Comment;
use App\Form\AreaType;
use App\Form\Dto\AreaDto;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AreaController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function list()
    {
        $areas = $this->getDoctrine()
            ->getRepository(Area::class)
            ->findAll();

        return $this->render('list.twig', [
            'areas' => $areas
        ]);
    }

    /**
     * @Route("/utworz")
     */
    public function create(Request $request)
    {
        $areas = $this->getDoctrine()
            ->getRepository(Area::class)
            ->findAll();

        $form = $this->createForm(AreaType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $areaDto = $form->getData();
            $area = $areaDto->toEntity();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($area);
            $entityManager->flush();

            $this->addFlash('success', 'Sukces! Utworzyłeś nowy obszar!');
            return $this->redirectToRoute('app_area_show', ['id' => $area->id]);
        }

        return $this->render('create.twig',
            [
                'areas' => $areas,
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/{id}")
     */
    public function show(Area $area, Request $request, EntityManagerInterface $entityManager)
    {
        $areas = $entityManager
            ->getRepository(Area::class)
            ->findAll();

        $comments = $entityManager
            ->getRepository(Comment::class)
            ->findAll();

        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_area_show', ['id' => $area->id]);
        }

        return $this->render('show.twig',
            [
                'areas' => $areas,
                'area' => $area,
                'comments' => $comments,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/edytuj/{id}")
     */
    public function update(Area $area, Request $request)
    {
        $areas = $this->getDoctrine()
            ->getRepository(Area::class)
            ->findAll();

        $form = $this->createForm(AreaType::class, AreaDto::fromEntity($area));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $areaDto = $form->getData();
            $area = $areaDto->toEntity($area);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Sukces! Twoje zmiany zostały zapisane!');
            return $this->redirectToRoute('app_area_show', ['id' => $area->id]);
        }

        return $this->render('update.twig',
            [
                'area' => $area,
                'areas' => $areas,
                'form' => $form->createView(),
            ]);
    }
}
