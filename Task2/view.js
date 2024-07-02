class StudentView {
    constructor() {
        this.tableBody = document.querySelector('#student tbody');
        this.paginationContainer = document.getElementById('pagination');
    }

    renderStudentTable(students) {
        this.tableBody.innerHTML = "";
        students.forEach(item => {
            const tableRow = document.createElement("tr");
            for (const [key, data] of Object.entries(item)) {
                const tableData = document.createElement("td");
                tableData.textContent = data;
                tableRow.appendChild(tableData);
            }
            this.tableBody.appendChild(tableRow);
        });
    }

    renderPagination(totalPages, currentPage) {
        this.paginationContainer.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
            const paginationButton = document.createElement("button");
            paginationButton.textContent = i;
            paginationButton.onclick = () => {
                controller.setCurrentPage(i);
            };
            if (i === currentPage) {
                paginationButton.classList.add('active');
            }
            this.paginationContainer.appendChild(paginationButton);
        }
    }
}
