"use strict";

function toggleSidebar() {
  var sidebar = document.getElementById('sidebar');
  var content = document.getElementById('content'); // Toggle the 'collapsed' class on the sidebar

  sidebar.classList.toggle('collapsed'); // Toggle the 'expanded' class on the content

  content.classList.toggle('expanded');
}

function showSideBar() {
  document.querySelector('.sidebar').style.display = 'block';
  document.querySelector('.menu-open-btn').style.display = 'none';
}

function hideSideBar() {
  document.querySelector('.sidebar').style.display = 'none';
  document.querySelector('.menu-open-btn').style.display = 'block';
}