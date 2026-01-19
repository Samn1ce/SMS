document.addEventListener("alpine:init", () => {
  Alpine.data("studentManager", () => ({
    selectedClass: "",
    search: "",
    students: [],
    selectedStudentId: null,
    toastActive: false,

    activateToast() {},

    async fetchStudents() {
      if (!this.selectedClass) {
        this.students = [];
        return;
      }

      try {
        const baseUrl = "/schoolManagementSystem/includes/getStudents.php";

        const res = await fetch(
          `${baseUrl}?class_id=${
            this.selectedClass
          }&search=${encodeURIComponent(this.search)}`
        );

        if (!res.ok) throw new Error("Network response was not ok");

        this.students = await res.json();
      } catch (error) {
        console.error("Error fetching students:", error);
        this.students = [];
      }
    },
  }));
});
