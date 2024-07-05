<?php
require_once 'students.php';

$results_per_page = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$sort_field = isset($_GET['sort_by']) ? $_GET['sort_by'] : null;

$paginated_students = getPaginatedStudents($page, $results_per_page, $sort_field);
$total_pages = getTotalPages($results_per_page);


include 'view.php';
?>
