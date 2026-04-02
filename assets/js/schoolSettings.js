document.addEventListener('alpine:init', () => {
  Alpine.data('schoolSetting', (initialData) => ({
    sessions: initialData.sessions,
    terms: initialData.terms,
    selectedSessionId: initialData.selectedSessionId,
    selectedTermId: initialData.selectedTermId,
    displaySession: initialData.displaySession,
    displayTerm: initialData.displayTerm,

    termOpen: false,
    confirmOpen: false,
    saving: false,
    saveError: '',

    newSessionName: '',
    newSessionError: '',
    newSessionLoading: false,

    openConfirm() {
      if (!this.selectedSessionId || !this.selectedTermId) {
        this.saveError = 'Please select both a session and a term';
        return;
      }
      this.saveError = '';
      this.confirmOpen = true;
    },

    async saveSettings() {
      this.saving = true;
      this.saveError = '';
      this.confirmOpen = false;

      try {
        const res = await fetch('/schoolmanagementsystem/api/school_settings_handler.php', {
          method: 'POST',
          body: new URLSearchParams({
            action: 'save_settings',
            term_id: this.selectedTermId,
            session_id: this.selectedSessionId,
          }),
        }).then((r) => r.json());

        if (!res.success) {
          this.saveError = res.message;
          return;
        }

        // update display labels only after confirmed DB write
        this.displaySession =
          this.sessions.find((s) => s.id == this.selectedSessionId)?.session_name ?? '';
        this.displayTerm = this.terms.find((t) => t.id == this.selectedTermId)?.term_name ?? '';
        this.termOpen = false;
      } catch (e) {
        this.saveError = 'Network error. Please try again.';
      } finally {
        this.saving = false;
      }
    },

    async createSession() {
      this.newSessionError = '';
      console.log('session error:', this.newSessionError);

      if (!this.newSessionName.trim()) {
        this.newSessionError = 'Session name cannot be empty';
        return;
      }
      console.log('session name:', this.newSessionName);

      if (!/^\d{4}\/\d{4}$/.test(this.newSessionName)) {
        this.newSessionError = 'Format must be YYYY/YYYY e.g. 2025/2026';
        return;
      }

      const [yearOne, yearTwo] = this.newSessionName.split('/').map(Number);
      if (yearTwo !== yearOne + 1) {
        this.newSessionError = 'Years must be consecutive e.g. 2025/2026';
        return;
      }

      this.newSessionLoading = true;

      try {
        const res = await fetch('/schoolmanagementsystem/api/school_settings_handler.php', {
          method: 'POST',
          body: new URLSearchParams({
            action: 'create_session',
            session_name: this.newSessionName,
          }),
        }).then((r) => r.json());

        if (!res.success) {
          this.newSessionError = res.message;
          return;
        }

        this.sessions.unshift(res.session);
        this.newSessionName = '';
      } catch (e) {
        this.newSessionError = 'Network error. Please try again.';
      } finally {
        this.newSessionLoading = false;
      }
    },
  }));
});
