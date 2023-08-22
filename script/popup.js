// Popup window
function showPopup() {
    document.getElementById('customPopup').style.display = 'block';
}

function hidePopup() {
    document.getElementById('customPopup').style.display = 'none';
}

// Attach the showPopup function to the button's click event to show the popup
document.getElementById('popupButton').addEventListener('click', showPopup);

// Attach the hidePopup function to the close button's click event to hide the popup
document.getElementById('closeButton').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent form submission
    hidePopup();
});

function switchTab(tabId) {
    // Hide all tab contents
    var tabContents = document.getElementsByClassName('tab-content');
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].classList.remove('active');
    }

    // Show the selected tab content
    document.getElementById(tabId).classList.add('active');

    // Update active tab button
    var tabButtons = document.getElementsByClassName('tab-button');
    for (var j = 0; j < tabButtons.length; j++) {
      tabButtons[j].classList.remove('active');
    }
    document.querySelector('[data-tab="' + tabId + '"]').classList.add('active');
  }

  // Attach the showPopup function to the button's click event to show the popup
  document.getElementById('popupButton').addEventListener('click', showPopup);

  // Attach the hidePopup function to the close button's click event to hide the popup
  document.getElementById('closeButton').addEventListener('click', hidePopup);

  // Attach the switchTab function to the tab buttons' click event
  var tabButtons = document.getElementsByClassName('tab-button');
  for (var k = 0; k < tabButtons.length; k++) {
    tabButtons[k].addEventListener('click', function(event) {
      var tabId = event.target.dataset.tab;
      switchTab(tabId);
      event.preventDefault(); // Prevent form submission
    });
  }

  // Automatically show Tab 1 content when the page loads
  document.addEventListener('DOMContentLoaded', function() {
    switchTab('tab1');
  });