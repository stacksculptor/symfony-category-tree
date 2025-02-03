<?php

declare(strict_types=1);

namespace App\Category\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

final class IndexController extends AbstractController
{
    #[Route(path: '/', name: 'category_index', methods: [Request::METHOD_GET])]
    public function index(
        CategoryRepository $categoryRepository
    ): Response {
        $categories = $categoryRepository->findBy(['parent' => null]);

        return $this->render('pages/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/category/add', name: 'category_add', methods: [Request::METHOD_POST])]
    public function add(
        Request $request, 
        EntityManagerInterface $em, 
        CategoryRepository $categoryRepository
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);
        if (!$data || !isset($data['name']) || !isset($data['parentId'])) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid data or missing data'], 400);
        }

        $name = $data['name'];
        $parentId = $data['parentId'] ?? null;
        $parentId = $parentId !== null ? (int) $parentId : null;

        $parent = $categoryRepository->find($parentId);

        $category = new Category();
        $category->setName($name);
        $category->setParent($parent);

        $em->persist($category);
        $em->flush();

        return new JsonResponse(['success' => true, 'category' => $category]);
    }

    #[Route('/category/edit', name: 'category_edit', methods: [Request::METHOD_POST])]
    public function edit(
        Request $request, 
        EntityManagerInterface $em, 
        CategoryRepository $categoryRepository
    ): JsonResponse {

        $data = json_decode($request->getContent(), true);
        if (!$data || !isset($data['name']) || !isset($data['categoryId'])) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid data or missing data'], 400);
        }

        $name = $data['name'];
        $categoryId = $data['categoryId'] ?? null;
        $categoryId = $categoryId !== null ? (int) $categoryId : null;

        $category = $categoryRepository->find($categoryId);

        $category->setName($name);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/category/delete', name: 'category_delete', methods: [Request::METHOD_POST])]
    public function delete(
        Request $request, 
        EntityManagerInterface $em, 
        CategoryRepository $categoryRepository
    ): JsonResponse {
 
        $data = json_decode($request->getContent(), true);
        if (!$data || !isset($data['categoryId'])) {
            return new JsonResponse(['success' => false, 'message' => 'Invalid data or missing data'], 400);
        }

        $categoryId = $data['categoryId'] ?? null;
        $categoryId = $categoryId !== null ? (int) $categoryId : null;

        $category = $categoryRepository->find($categoryId);

        $em->remove($category);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }
}