document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('AD').addEventListener('click', function() {
        fetchNames('AD');
    });
    document.getElementById('EMPLOYEES').addEventListener('click', function() {
        fetchNames('EMPLOYEES');
    });
});

function fetchNames(type) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_names.php?type=' + type, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log('Raw response:', xhr.responseText); // Log the raw response for debugging
            if (xhr.status == 200) {
                try {
                    var names = JSON.parse(xhr.responseText);
                    if (names.error) {
                        console.error('Error from server:', names.error);
                    } else {
                        displayCheckboxes(names);
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

function displayCheckboxes(names) {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = ''; // Clear any existing checkboxes
    names.forEach(function(name) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = name;
        checkbox.name = 'names[]';
        checkbox.value = name;

        var label = document.createElement('label');
        label.htmlFor = name;
        label.appendChild(document.createTextNode(name));

        container.appendChild(checkbox);
        container.appendChild(label);
        container.appendChild(document.createElement('br'));
    });
}
