document.addEventListener("alpine:init", () => {
  Alpine.data("trustedBy", () => ({
    schools: [
      { emoji: "🏫", name: "Greenfield Academy" },
      { emoji: "📚", name: "Horizon University" },
      { emoji: "🎓", name: "Sunrise College" },
      { emoji: "📐", name: "Apex High School" },
      { emoji: "🌟", name: "Pinnacle Academy" },
      { emoji: "🏆", name: "Brightpath Institute" },
    ],

    get ticker() {
      return [...this.schools, ...this.schools];
    },
  }));
});
