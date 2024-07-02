class StudentController {
    constructor(model, view) {
        this.model = model;
        this.view = view;
        this.init();
    }

    init() {
        this.renderPage();
   
    }

    renderPage() {
        const students = this.model.getStudentsByPage(this.model.currentPage);
        this.view.renderStudentTable(students);
        const totalPages = this.model.getTotalPages();
        this.view.renderPagination(totalPages, this.model.currentPage);
    }

    setCurrentPage(pageNumber) {
        this.model.currentPage = pageNumber;
        this.renderPage();
    }

    sortTable(columnIndex) {
        this.model.sortStudents(columnIndex);
        this.renderPage();
    }
}


