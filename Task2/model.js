class StudentModel {
    constructor() {
        this.studentDetails = [];
        this.rowPerPage = 2;
        this.currentPage = 1;
        this.sortDirection = {};
        this.renderData();
    }

    async renderData() {
        try {
            const response = await fetch('http://127.0.0.1:8080/students.json');
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
        
            const jsonData = await response.json();
            console.log(jsonData); 
            this.studentDetails = jsonData;
            
            this.render();
        
        } catch (error) {
            console.error('Error Rendering data:', error.message);
        }
    }

    getStudents() {
        return this.studentDetails;
    }

    getStudentsByPage(pageNumber) {
        const start = (pageNumber - 1) * this.rowPerPage;
        const end = pageNumber * this.rowPerPage;
        return this.studentDetails.slice(start, end);
    }

    getTotalPages() {
        return Math.ceil(this.studentDetails.length / this.rowPerPage);
    }

    sortStudents(columnIndex) {
        const keys = ['Id', 'Name', 'Department'];
        const key = keys[columnIndex];

        if (this.sortDirection[key] === undefined) {
            this.sortDirection[key] = true;
        } else {
            this.sortDirection[key] = !this.sortDirection[key];
        }

        this.studentDetails.sort((a, b) => {
            if (a[key] < b[key]) {
                return this.sortDirection[key] ? -1 : 1;
            }
            if (a[key] > b[key]) {
                return this.sortDirection[key] ? 1 : -1;
            }
            return 0;
        });

        this.currentPage = 1;
        this.render(); 
    }

    render() {
        const tableBody = document.querySelector('#student tbody');
        tableBody.innerHTML = "";

        const studentsToDisplay = this.getStudentsByPage(this.currentPage);
        studentsToDisplay.forEach(item => {
            const tableRow = document.createElement("tr");
            for (const [key, data] of Object.entries(item)) {
                const tableData = document.createElement("td");
                tableData.textContent = data;
                tableRow.appendChild(tableData);
            }
            tableBody.appendChild(tableRow);
        });

        this.renderPagination();
    }

    renderPagination() {
        const pageButton = document.getElementById('pagination');
        pageButton.innerHTML = "";

        const totalPages = this.getTotalPages();
        for (let i = 1; i <= totalPages; i++) {
            const paginationButton = document.createElement("button");
            paginationButton.textContent = i;
            paginationButton.onclick = () => {
                this.currentPage = i;
                this.render();
            };
            pageButton.appendChild(paginationButton);
        }
    }
}

