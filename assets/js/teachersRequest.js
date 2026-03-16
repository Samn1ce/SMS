document.addEventListener('alpine:init', () => {
  Alpine.data('teacherRow', (teacherId) => ({
    confirming: null,
    loading: false,

    async handle(action) {
      this.loading = true;
      try {
        const res = await fetch('/schoolManagementSystem/api/teacherVerification.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ action, teacher_id: teacherId }),
        });
        const data = await res.json();
        if (data.success) {
          this.$dispatch('teacher-actioned', { id: teacherId, action, message: data.message });
        } else {
          alert(data.message);
        }
      } catch {
        alert('Something went wrong. Please try again.');
      } finally {
        this.loading = false;
        this.confirming = null;
      }
    },
  }));
});
