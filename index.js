function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    // Toggle the 'collapsed' class on the sidebar
    sidebar.classList.toggle('collapsed');

    // Toggle the 'expanded' class on the content
    content.classList.toggle('expanded');
}