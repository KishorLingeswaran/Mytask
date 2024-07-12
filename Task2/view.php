
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student List with Pagination and Sorting</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            cursor: pointer;
        }
        .pagination {
            display: flex;
            justify-content: center;
            padding: 10px;
        }
    </style>
    <script>
        function navigateToPage(page) {
            let currentSort = '<?php echo isset($_GET['sort_by']) ? $_GET['sort_by'] : ''; ?>';
            let sortDir = '<?php echo isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'asc'; ?>';
            let url = `?page=${page}`;
            if (currentSort) {
                url += `&sort_by=${currentSort}&sort_dir=${sortDir}`;
            }
            window.location.href = url;
        }

        function sortStudents(field) {
            let currentPage = '<?php echo isset($_GET['page']) ? $_GET['page'] : 1; ?>';
            let currentSort = '<?php echo isset($_GET['sort_by']) ? $_GET['sort_by'] : ''; ?>';
            let sortDir = '<?php echo isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'asc'; ?>';

            if (field === currentSort) {
                sortDir = (sortDir === 'asc') ? 'desc' : 'asc'; 
            } else {
                sortDir = 'asc'; 
            }

            window.location.href = `?page=${currentPage}&sort_by=${field}&sort_dir=${sortDir}`;
        }
    </script>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th onclick="sortStudents('id')">ID</th>
            <th onclick="sortStudents('studentname')">Student Name</th>
            <th onclick="sortStudents('Department')">Department</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo $student['id']; ?></td>
                <td><?php echo $student['studentname']; ?></td>
                <td><?php echo $student['Department']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <button onclick="navigateToPage(<?php echo $i; ?>)"><?php echo $i; ?></button>
        <?php endfor; ?>
    </div>
</body>
</html>
