document.addEventListener("alpine:init", () => {
  Alpine.data("layoutRender", (layoutData) => ({
    basePath: layoutData.basePath,
    currentView: layoutData.currentView,
    isLoading: false,
    content: "",

    navigate(view) {
      if (this.currentView === view) return;
      this.currentView = view;
      this.isLoading = true;
      history.pushState({}, "", this.basePath + "/" + view);
      this.loadContent(view);
    },

    async loadContent(view) {
      try {
        const response = await fetch(this.basePath + "/" + view, {
          headers: {
            "X-Requested-With": "XMLHttpRequest",
          },
        });

        if (!response.ok) {
          this.content = "<div>Error loading content</div>";
        } else {
          this.content = await response.text();
        }
      } catch (error) {
        this.content = "<div>Error loading content</div>";
      }
      this.isLoading = false;
    },

    init() {
      this.loadContent(this.currentView);

      window.addEventListener("popstate", () => {
        const segments = window.location.pathname.split("/");
        const view = segments[segments.length - 1] || "dashboard";
        this.currentView = view;
        this.loadContent(view);
      });
    },
  }));
});
