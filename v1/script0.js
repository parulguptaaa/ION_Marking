// version 0 js

document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('AD').addEventListener('click', function() {
        fetchADNames();
    });
});

function fetchADNames() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_ad_names.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log('Raw response:', xhr.responseText); // Log the raw response for debugging
            if (xhr.status == 200) {
                try {
                    var adNames = JSON.parse(xhr.responseText);
                    if (adNames.error) {
                        console.error('Error from server:', adNames.error);
                    } else {
                        console.log("1st checkpoint reached");
                        displayADCheckboxes(adNames);
                    }
                } catch (e) {
                    console.error('Invalid JSON:', e);
                }
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };
    xhr.send();
}

function displayADCheckboxes(adNames) {
    var container = document.getElementById('adCheckboxContainer');
    container.innerHTML = ''; // Clear any existing checkboxes
    adNames.forEach(function(adName) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = adName;
        checkbox.name = 'ad_names[]';
        checkbox.value = adName;

        var label = document.createElement('label');
        label.htmlFor = adName;
        label.appendChild(document.createTextNode(adName));

        container.appendChild(checkbox);
        container.appendChild(label);
        container.appendChild(document.createElement('br'));
    });
}

