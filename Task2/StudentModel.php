<?php


class StudentModel {
    private $students;
    
    public function __construct() {
        $json_data = file_get_contents('students.json');
        $this->students = json_decode($json_data, true);
    }
    
    public function getPaginatedStudents($page, $results_per_page, $sort_field = null, $sort_dir = 'asc') {
        if ($sort_field) {
            usort($this->students, function($a, $b) use ($sort_field, $sort_dir) {
                $cmp = $a[$sort_field] <=> $b[$sort_field];
                return ($sort_dir === 'asc') ? $cmp : -$cmp;
            });
        }
        $start = ($page - 1) * $results_per_page;
        return array_slice($this->students, $start, $results_per_page);
    }

    public function getTotalPages($results_per_page) {
        return ceil(count($this->students) / $results_per_page);
    }
}
?>
