<?php

function getStudents() {
    $json_file = 'students.json'; 
    $json_data = file_get_contents($json_file);
    $students = json_decode($json_data, true); 
    return $students;
}

function getPaginatedStudents($page, $results_per_page, $sort_field = null) {
    $students = getStudents();

    if (isset($_GET['sort_by'])) {
        $sort_field = $_GET['sort_by'];
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'asc';
    
        if ($sort_field) {
            usort($students, function($a, $b) use ($sort_field, $sort_dir) {
                $cmp = $a[$sort_field] <=> $b[$sort_field];
                return ($sort_dir === 'asc') ? $cmp : -$cmp;
            });
        }
    }

    $start = ($page - 1) * $results_per_page;
    $paginated_students = array_slice($students, $start, $results_per_page);

    return $paginated_students;
}


function getTotalPages($results_per_page) {
    $students = getStudents();
    $total_pages = ceil(count($students) / $results_per_page);
    return $total_pages;
}

?>
