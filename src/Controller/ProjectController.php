<?php

declare(strict_types=1);


namespace App\Controller;


use App\Entity\Project;
use App\Entity\Comment;
use App\Form\ProjectType;
use App\Form\Dto\ProjectDto;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function list()
    {
        $areas = $this->getDoctrine()
            ->getRepository(Project::class)
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
            ->getRepository(Project::class)
            ->findAll();

        $form = $this->createForm(ProjectType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $areaDto = $form->getData();
            $area = $areaDto->toEntity();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($area);
            $entityManager->flush();

            $this->addFlash('success', 'Sukces! Utworzyłeś nowy obszar!');
            return $this->redirectToRoute('app_project_show', ['id' => $area->id]);
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
    public function show(Project $area, Request $request, EntityManagerInterface $entityManager)
    {
        $areas = $entityManager
            ->getRepository(Project::class)
            ->findAll();

        $comments = $entityManager
            ->getRepository(Comment::class)
            ->findBy(['area' => $area]);

        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->area = $area;
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_project_show', ['id' => $area->id]);
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
    public function update(Project $area, Request $request)
    {
        $areas = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findAll();

        $form = $this->createForm(ProjectType::class, ProjectDto::fromEntity($area));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $areaDto = $form->getData();
            $area = $areaDto->toEntity($area);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Sukces! Twoje zmiany zostały zapisane!');
            return $this->redirectToRoute('app_project_show', ['id' => $area->id]);
        }

        return $this->render('update.twig',
            [
                'area' => $area,
                'areas' => $areas,
                'form' => $form->createView(),
            ]);
    }
}
