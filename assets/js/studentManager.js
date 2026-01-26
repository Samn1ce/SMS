document.addEventListener("alpine:init", () => {
  Alpine.data("studentManager", () => ({
    selectedClass: "",
    search: "",
    students: [],
    selectedStudentId: null,
    toastActive: false,
    toastMessage: "",
    toastType: "success",

    activateToast(message, type) {
      this.toastMessage = message;
      this.toastType = type;
      this.toastActive = true;
      setTimeout(() => {
        this.toastActive = false;
      }, 5000);
    },
    deactivateToast() {
      this.toastActive = false;
    },

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

    async markAttendance(student_id, status) {
      try {
        const res = await fetch(
          "/schoolManagementSystem/api/markAttendance.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
              user_id: student_id,
              term_id: window.TERM_ID, // we'll define this in PHP
              status: status,
            }),
          }
        );
        const data = await res.json();

        if (data.error) {
          this.activateToast(data.error, "error");
        } else {
          this.activateToast("Attendance marked successfully", "success");
        }
      } catch (error) {
        this.activateToast("Network error. Try again.", "error");
      }
    },
  }));
});
