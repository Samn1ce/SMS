document.addEventListener("alpine:init", () => {
  Alpine.data("featuresSection", () => ({
    tab: "administrators",
    panelVisible: true,

    setTab(key) {
      if (key === this.tab) return;
      this.panelVisible = false;
      setTimeout(() => {
        this.tab = key;
        this.panelVisible = true;
      }, 160);
    },

    tabs: [
      { key: "administrators", label: "Administrators" },
      { key: "teachers", label: "Teachers" },
      { key: "students", label: "Students" },
      { key: "parents", label: "Parents" },
    ],

    panels: {
      administrators: [
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
          title: "Admin Dashboard",
          body: "Full school overview: enrolment, finances, staff records, and real-time analytics — all from one central hub.",
          tags: [],
        },
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
          title: "Reports & Analytics",
          body: "Generate detailed academic, financial, and attendance reports. Export to PDF or share with stakeholders instantly.",
          tags: [],
        },
        {
          accent: true,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
          title: "Timetable Manager",
          body: "Drag-and-drop timetable builder. Automatically detects clashes and generates optimal class schedules.",
          tags: ["⏰ Auto-schedule", "🔁 Conflict check"],
        },
      ],

      teachers: [
        {
          accent: true,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>',
          title: "Teacher Portal",
          body: "Mark attendance, grade assignments, share lesson materials, and message students from one clean interface.",
          tags: ["📝 Gradebook", "📅 Timetable", "💬 Messaging"],
        },
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>',
          title: "Assignment Manager",
          body: "Create, distribute, and auto-grade assignments. Students submit online; teachers review with inline feedback.",
          tags: [],
        },
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
          title: "Class Messaging",
          body: "Send announcements, broadcast to the whole class, or DM individual students and parents with ease.",
          tags: [],
        },
      ],

      students: [
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
          title: "Student Portal",
          body: "Access timetables, assignments, grades, the library, and announcements in one personalised student space.",
          tags: [],
        },
        {
          accent: true,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>',
          title: "Digital Library",
          body: "Browse thousands of e-books, past exam papers, and learning resources available 24/7 from any device.",
          tags: ["📖 E-books", "📄 Past papers"],
        },
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
          title: "Achievements & Badges",
          body: "Earn badges for attendance, grades, and improvements. Climb the class leaderboard and collect honours.",
          tags: [],
        },
      ],

      parents: [
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
          title: "Parent Dashboard",
          body: "Monitor your child's attendance, grades, and behaviour from one simple parent portal. Always stay informed.",
          tags: [],
        },
        {
          accent: true,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>',
          title: "Instant Notifications",
          body: "Get real-time push, SMS, or email alerts for grades, absenteeism, events, and new messages from teachers.",
          tags: ["📱 Push", "✉️ Email", "📞 SMS"],
        },
        {
          accent: false,
          svg: '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
          title: "Teacher Communication",
          body: "Message teachers directly, request meetings, and receive homework updates — all without leaving the platform.",
          tags: [],
        },
      ],
    },

    get activeCards() {
      return this.panels[this.tab] ?? [];
    },
  }));
});
