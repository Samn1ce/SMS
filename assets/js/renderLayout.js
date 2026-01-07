document.addEventListener("alpine:init", () => {
  Alpine.data("layoutRender", (layoutData) => ({
    basePath: layoutData.basePath,
    currentView: layoutData.currentView,
    isLoading: false,
    content: "",

    // Function to change views
    navigate(view) {
      if (this.currentView === view) return;

      this.currentView = view;
      this.isLoading = true;

      history.pushState({}, "", this.basePath + "/" + view);
      this.loadContent(view);
    },

    // Function to load content via AJAX
    async loadContent(view) {
      try {
        const response = await fetch(
          this.basePath + "/app/view-router.php?view=" + view
        );
        this.content = await response.text();
      } catch (error) {
        this.content = "<div>Error loading content</div>";
      }
      this.isLoading = false;
    },

    // Initialize
    init() {
      // Load initial content
      this.loadContent(this.currentView);

      // Handle browser back/forward buttons
      window.addEventListener("popstate", () => {
        const path =
          window.location.pathname
            .replace(this.basePath, "")
            .replace("/", "") || "dashboard";
        this.currentView = path;
        this.loadContent(path);
      });
    },
  }));
});
