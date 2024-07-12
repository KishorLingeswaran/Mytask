<?php

require_once 'StudentModel.php';

class StudentController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function listStudents() {
        $results_per_page = 2;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $sort_field = isset($_GET['sort_by']) ? $_GET['sort_by'] : null;
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'asc';

        $students = $this->model->getPaginatedStudents($page, $results_per_page, $sort_field, $sort_dir);
        $total_pages = $this->model->getTotalPages($results_per_page);

        include 'view.php';
    }
}
$controller = new StudentController();
$controller->listStudents();
?>
