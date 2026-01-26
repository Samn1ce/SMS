document.addEventListener("alpine:init", () => {
  Alpine.data("setupApp", () => ({
    step: 1,
    success: false,
    submitting: false,
    showPassword: false,
    school: {
      name: "",
      slug: "",
      email: "",
      phone: "",
      address: "",
    },
    admin: {
      name: {
        surname: "",
        firstname: "",
        othername: "",
      },
      email: "",
      password: "",
      confirm_password: "",
    },
    setupResult: {},
    notification: {
      show: false,
      message: "",
      type: "success",
    },

    showNotification(message, type = "success") {
      this.notification.message = message;
      this.notification.type = type;
      this.notification.show = true;

      setTimeout(() => {
        this.notification.show = false;
      }, 4000);
    },

    nextStep() {
      if (!this.school.name || !this.school.slug || !this.school.email) {
        this.showNotification("Please fill all required fields", "error");
        return;
      }

      // Validate email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.school.email)) {
        this.showNotification("Please enter a valid email address", "error");
        return;
      }
      this.step = 2;
    },

    async submitSetup() {
      // Validate admin information
      if (
        !this.admin.name.surname ||
        !this.admin.name.firstname ||
        !this.admin.email ||
        !this.admin.password ||
        !this.admin.confirm_password
      ) {
        this.showNotification("Please fill all required fields", "error");
        return;
      }

      // Validate email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.admin.email)) {
        this.showNotification("Please enter a valid email address", "error");
        return;
      }

      // Validate password length
      if (this.admin.password.length < 8) {
        this.showNotification(
          "Password must be at least 8 characters long",
          "error"
        );
        return;
      }

      // Validate password match
      if (this.admin.password !== this.admin.confirm_password) {
        this.showNotification("Passwords do not match", "error");
        return;
      }

      this.submitting = true;

      try {
        const response = await fetch(
          "/schoolmanagementsystem/api/admin_setup_api.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              action: "create_school_and_admin",
              school: this.school,
              admin: {
                name: {
                  surname: this.admin.name.surname,
                  firstname: this.admin.name.firstname,
                  othername: this.admin.name.othername,
                },
                email: this.admin.email,
                password: this.admin.password,
              },
            }),
          }
        );

        const data = await response.json();
        // const text = await response.text();
        console.log(data);

        if (data.success) {
          this.setupResult = data.data;
          console.log(this.setupResult);
          this.success = true;
          this.showNotification("Setup completed successfully!", "success");
        } else {
          this.showNotification(data.message || "Setup failed", "error");
        }
      } catch (error) {
        this.showNotification("Error: " + error.message, "error");
      } finally {
        this.submitting = false;
      }
    },
  }));
});
