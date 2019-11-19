<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="students")
     */
    public function index()
    {
        $data = $this->provideStudents();
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'dataArray' => $data
        ]);
    }

    /**
     * @Route("/student", name="student")
     */
    public function viewStudent()
    {
        $request = Request::createFromGlobals();
        $name = $request->query->get('name');
        $project = $request->query->get('project');

        return $this->render('project/student.html.twig', [
            'controller_name' => 'ProjectController',
            'name' => $name,
            'project' => $project
        ]);
    }

    /**
     * @Route ("/student.json", name="viewFile")
     */
    public function viewFile()
    {
        $data = $this->provideStudents();
        return new JsonResponse($data);
    }

    /**
     * @return mixed
     */
    private function provideStudents()
    {
        $studentsJson = file_get_contents('https://hw1.nfq2019.online/students.json');
        return json_decode($studentsJson, true);
    }
}
