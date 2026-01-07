function studentManager() {
  return {
    selectedClass: "",
    search: "",
    students: [],

    async fetchStudents() {
      if (!this.selectedClass) {
        this.students = [];
        return;
      }

      const res = await fetch(
        `includes/getStudents.php?class_id=${
          this.selectedClass
        }&search=${encodeURIComponent(this.search)}`
      );
      this.students = await res.json();
    },
  };
}
