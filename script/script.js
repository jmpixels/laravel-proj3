function removeQueryString() {
    // Get the current URL
    var url = window.location.href;
  
    // Remove the query string
    var cleanUrl = url.split('?')[0];
  
    // Redirect to the clean URL
    window.location.href = cleanUrl;
  }


  const menuButtons = document.querySelectorAll('.menu-btn');
  menuButtons.forEach(function(button) {
      button.addEventListener('click', function() {
          const menu = this.parentElement;
          menu.classList.remove('active');
      });
  });



//   page pagination

function paginateTable(itemsPerPage, currentPage) {
    var table = document.getElementById('userTable');
    var rows = table.tBodies[0].rows;
    var totalItems = rows.length;
    var pageCount = Math.ceil(totalItems / itemsPerPage);

    // Calculate the maximum pagination numbers to display
    var maxPaginationNumbers = 5; // Set the desired maximum pagination numbers
    var startPage = Math.max(currentPage - Math.floor(maxPaginationNumbers / 2), 1);
    var endPage = Math.min(startPage + maxPaginationNumbers - 1, pageCount);

    // Calculate the start and end indices for displaying table rows
    var startIndex = (currentPage - 1) * itemsPerPage;
    var endIndex = Math.min(startIndex + itemsPerPage - 1, totalItems - 1);

    for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = (i >= startIndex && i <= endIndex) ? 'table-row' : 'none';
    }

    // Generate pagination controls
    var paginationDiv = document.getElementById('pagination');
    paginationDiv.innerHTML = '';

    // Previous button
    var prevButton = document.createElement('a');
    prevButton.href = '#';
    prevButton.innerHTML = 'Previous';
    prevButton.classList.add('pag-btn')
    prevButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            paginateTable(itemsPerPage, currentPage - 1);
        }
    });
    paginationDiv.appendChild(prevButton);

    // Page numbers
    for (var i = startPage; i <= endPage; i++) {
        var pageLink = document.createElement('a');
        pageLink.href = '#';
        pageLink.innerHTML = i;
        pageLink.className = (i === currentPage) ? 'active' : '';

        // Add additional class to the pageLink element
        pageLink.classList.add('pagination-link');

        pageLink.addEventListener('click', function(e) {
            e.preventDefault();
            paginateTable(itemsPerPage, parseInt(this.innerHTML));
        });

        paginationDiv.appendChild(pageLink);
    }

    // Next button
    var nextButton = document.createElement('a');
    nextButton.href = '#';
    nextButton.innerHTML = 'Next';
    nextButton.classList.add('pag-btn')
    nextButton.addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage < pageCount) {
            paginateTable(itemsPerPage, currentPage + 1);
        }
    });
    paginationDiv.appendChild(nextButton);
}

var itemsPerPage = 6;
var currentPage = 1;
paginateTable(itemsPerPage, currentPage);













// search function

var searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', searchTable);


function searchTable() {
    var input = document.getElementById('searchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('userTable');
    var rows = table.tBodies[0].rows;
    var visibleCount = 0;

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var found = false;

        for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];
            if (filter === '' || cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
                break;
            }
        }

        rows[i].style.display = found ? 'table-row' : 'none';

        if (found) {
            visibleCount++;
            if (visibleCount > itemsPerPage) {
                rows[i].style.display = 'none';
            }
        }
    }
}

function handleSearch() {
    searchTable();
}

var searchButton = document.getElementById('searchButton');
searchButton.addEventListener('click', handleSearch);

var searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', handleSearch);

var searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', searchTable);

        





