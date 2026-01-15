document.addEventListener("alpine:init", () => {
  Alpine.data("studentManager", () => ({
    selectedClass: "",
    search: "",
    students: [],
    selectedStudentId: null,

    async fetchStudents() {
      if (!this.selectedClass) {
        this.students = [];
        return;
      }

      try {
        // Ensure the path to your PHP file is correct relative to public root
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
