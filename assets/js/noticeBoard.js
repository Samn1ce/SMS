document.addEventListener('alpine:init', () => {
  Alpine.data('noticeBoard', () => ({
    open: false,
    submitting: false,
    success: false,

    form: {
      priority: 'normal',
      subject: '',
      message: '',
      audience: ['all'],
      expires_at: '',
      expiryPreset: 1,
    },

    errors: { subject: '', message: '', audience: '', expires_at: '' },

    priorities: [
      { value: 'normal', label: 'Normal', activeClass: 'bg-blue-100 text-blue-700' },
      { value: 'urgent', label: 'Urgent', activeClass: 'bg-amber-100 text-amber-700' },
      { value: 'critical', label: 'Critical', activeClass: 'bg-red-100 text-red-700' },
    ],

    audiences: [
      { value: 'all', label: 'Everyone', icon: '🏫' },
      { value: 'students', label: 'Students', icon: '🎒' },
      { value: 'teachers', label: 'Teachers', icon: '📋' },
    ],

    expiryPresets: [
      { label: '⚡ Tomorrow', days: 1 },
      { label: '📅 1 Week', days: 7 },
      { label: '🗓️ 1 Month', days: 30 },
      { label: '📆 3 Months', days: 90 },
    ],

    init() {
      this.applyPreset(1);
    },

    applyPreset(days) {
      this.form.expiryPreset = days;
      const d = new Date();
      d.setDate(d.getDate() + days);
      this.form.expires_at = d.toISOString().split('T')[0];
      this.errors.expires_at = '';
    },

    minDate() {
      return new Date().toISOString().split('T')[0];
    },

    formatExpiry(dateStr) {
      if (!dateStr) return '';
      const expiry = new Date(dateStr);
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const diffDays = Math.round((expiry - today) / (1000 * 60 * 60 * 24));

      const formatted = expiry.toLocaleDateString('en-GB', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
      });

      if (diffDays === 1) return 'tomorrow — ' + formatted;
      if (diffDays <= 7) return `in ${diffDays} days — ` + formatted;
      return 'on ' + formatted;
    },

    toggleAudience(val) {
      if (val === 'all') {
        this.form.audience = ['all'];
        return;
      }
      this.form.audience = this.form.audience.filter((v) => v !== 'all');
      if (this.form.audience.includes(val)) {
        this.form.audience = this.form.audience.filter((v) => v !== val);
        if (this.form.audience.length === 0) this.form.audience = ['all'];
      } else {
        this.form.audience.push(val);
      }
      this.errors.audience = '';
    },

    validate() {
      let valid = true;
      this.errors = { subject: '', message: '', audience: '', expires_at: '' };

      if (!this.form.subject.trim()) {
        this.errors.subject = 'Subject is required.';
        valid = false;
      }

      if (!this.form.message.trim()) {
        this.errors.message = 'Message cannot be empty.';
        valid = false;
      } else if (this.form.message.length > 500) {
        this.errors.message = 'Max 500 characters.';
        valid = false;
      }

      if (!this.form.expires_at) {
        this.errors.expires_at = 'Please pick an expiry date.';
        valid = false;
      } else if (this.form.expires_at < this.minDate()) {
        this.errors.expires_at = 'Expiry date must be today or later.';
        valid = false;
      }

      return valid;
    },

    async submitNotice() {
      if (!this.validate()) return;
      this.submitting = true;

      try {
        const res = await fetch('/schoolManagementSystem/api/noticeBoard_api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            action: 'post_notice',
            subject: this.form.subject,
            message: this.form.message,
            priority: this.form.priority,
            audience: this.form.audience,
            expires_at: this.form.expires_at,
          }),
        });

        const data = await res.json();

        if (!data.success) {
          if (data.errors) this.errors = { ...this.errors, ...data.errors };
          else this.errors.subject = data.message ?? 'Something went wrong.';
          return;
        }

        this.success = true;
        setTimeout(() => {
          this.success = false;
          this.closeModal();
        }, 2000);
      } catch (err) {
        this.errors.subject = 'Network error. Please try again.';
      } finally {
        this.submitting = false;
      }
    },

    async deleteNotice(id) {
      if (!confirm('Delete this notice?')) return;

      try {
        const res = await fetch('/schoolManagementSystem/api/noticeBoard_api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ action: 'delete_notice', id }),
        });

        const data = await res.json();

        if (data.success) {
          document.getElementById(`notice-${id}`)?.remove();
        } else {
          alert(data.message ?? 'Could not delete notice.');
        }
      } catch (err) {
        alert('Network error. Please try again.');
      }
    },

    closeModal() {
      this.open = false;
      this.success = false;
      this.errors = { subject: '', message: '', audience: '', expires_at: '' };
      this.form = {
        priority: 'normal',
        subject: '',
        message: '',
        audience: ['all'],
        expires_at: '',
        expiryPreset: 1,
      };
      this.applyPreset(1);
    },
  }));
});
