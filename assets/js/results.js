document.addEventListener("alpine:init", () => {
  Alpine.data("resultComponent", (resultData) => ({
    classId: resultData.classId,
    termId: resultData.termId,
    studentId: resultData.studentId,
    results: resultData.results || [],
    hasResults: resultData.hasResults || false,
    className: resultData.className || "",
    termName: resultData.termName || "",
    loading: false,

    async updateResults() {
      if (!this.classId || !this.termId) return;

      this.loading = true;

      try {
        console.log(window.location.pathname);
        const baseUrl = "/schoolManagementSystem/app/views/result.php";
        const response = await fetch(
          `${baseUrl}?ajax=1&class_id=${this.classId}&term_id=${this.termId}&user_id=${this.studentId}`
        );
        const data = await response.json();

        if (data.success) {
          this.results = data.results;
          this.hasResults = data.hasResults;
          this.className = data.className;
          this.termName = data.termName;
        }
      } catch (error) {
        console.error("Error fetching results:", error);
      } finally {
        this.loading = false;
      }
    },

    getGrade(total) {
      if (total >= 75) return "A1";
      if (total >= 65) return "B2";
      if (total >= 60) return "B3";
      if (total >= 55) return "C4";
      if (total >= 50) return "C5";
      if (total >= 40) return "D7";
      if (total >= 30) return "E8";
      return "F9";
    },
  }));
});
