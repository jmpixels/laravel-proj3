// function openSidebar() {
//     var sidebar = document.getElementById('sidebar');
//     sidebar.style.left = '0';
// }

// function closeSidebar() {
//     var sidebar = document.getElementById('sidebar');
//     sidebar.style.left = '-280px';
// }


// document.querySelectorAll(".sidebar .side-wrapper .link a").forEach(function (link) {
//     link.addEventListener("click", function (e) {
//         e.preventDefault();
//         var parent = e.target.parentNode;
//         var subMenu = parent.querySelector(".sub-menu");
//         parent.classList.toggle("active");
//         subMenu.style.maxHeight = parent.classList.contains("active") ? subMenu.scrollHeight + "px" : "0px";
//     });
// });


// document.querySelectorAll(".sidebar .side-wrapper .link.s-menu").forEach(function (link) {
//     var anchor = link.querySelector(".page-link");
//     var subMenu = link.querySelector(".sub-menu");

//     anchor.addEventListener("click", function (e) {
//         e.preventDefault();
//         link.classList.toggle("active");
//         subMenu.style.maxHeight = link.classList.contains("active") ? subMenu.scrollHeight + "px" : "0px";
//     });
// });

// document.querySelectorAll(".sidebar .side-wrapper .link.s-menu").forEach(function (link) {
//     var anchor = link.querySelector(".page-link");
//     var subMenu = link.querySelector(".sub-menu");

//     // Get the current page's URL
//     var currentURL = window.location.pathname;

//     // Check if the current page matches the anchor's href
//     if (anchor.getAttribute("href") === currentURL) {
//         anchor.classList.add("active");
//         link.classList.add("active");
//         subMenu.style.maxHeight = subMenu.scrollHeight + "px";
//     }

//     anchor.addEventListener("click", function (e) {
//         if (anchor.getAttribute("href") === currentURL) {
//             e.preventDefault();
//             return; // Prevent collapsing submenu for the active page
//         }
//         e.preventDefault();
//         link.classList.toggle("active");
//         subMenu.style.maxHeight = link.classList.contains("active") ? subMenu.scrollHeight + "px" : "0px";
//     });
// });



document.querySelectorAll(".sidebar .side-wrapper .link.s-menu").forEach(function (link) {
    var anchor = link.querySelector(".page-link");
    var subMenu = link.querySelector(".sub-menu");

    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        link.classList.toggle("active");
        subMenu.style.maxHeight = link.classList.contains("active") ? subMenu.scrollHeight + "px" : "0px";
    });
});