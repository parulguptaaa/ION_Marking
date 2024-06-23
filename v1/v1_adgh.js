document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('AD').addEventListener('click', function () {
        fetchGroups();
        showSubmitButton('wholeSubmitButton');

    });
    document.getElementById('EMPLOYEES').addEventListener('click', function () {
        document.getElementById('groupDropdownContainer').style.display = 'none';
        fetchEmployeeNames();
        showSubmitButton('employeesSubmitButton');

    });

    document.getElementById('groupSelect').addEventListener('change', function () {
        var groupId = this.value;
        if (groupId) {
            fetchADnames(groupId);
        }
    });
    // document.getElementById('mark-form').addEventListener('submit', function(event) {
    //     console.log("submitting...");
    //     event.preventDefault();
    //     submitForm();
    // });
});
function showSubmitButton(buttonId) {
    document.getElementById('wholeSubmitButton').style.display = 'none';
    document.getElementById('employeesSubmitButton').style.display = 'none';
    document.getElementById(buttonId).style.display = 'block';
}
function fetchADnames(groupId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_ad_names.php?groupId=' + groupId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            console.log('Raw response:', xhr.responseText); // Log the raw response for debugging
            if (xhr.status == 200) {
                try {
                    var names = JSON.parse(xhr.responseText);
                    if (names.error) {
                        console.error('Error from server:', names.error);
                    } else {
                        displayCheckboxesAD(names);
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

function fetchGroups() {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = '';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_groups.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            console.log('Raw response:', xhr.responseText); // Log the raw response for debugging
            if (xhr.status == 200) {
                try {
                    var groups = JSON.parse(xhr.responseText);
                    if (groups.error) {
                        console.error('Error from server:', groups.error);
                    } else {
                        displayGroupDropdown(groups);
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

function fetchEmployeeNames() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_employee_names.php', true);
    xhr.onreadystatechange = function () {
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

function displayGroupDropdown(groups) {
    var groupSelect = document.getElementById('groupSelect');
    groupSelect.innerHTML = '<option value="">Select a group</option>';
    groups.forEach(function (group) {
        var option = document.createElement('option');
        option.value = group.id;
        option.textContent = group.name;
        groupSelect.appendChild(option);
    });
    document.getElementById('groupDropdownContainer').style.display = 'block';
}
// original
// function displayCheckboxes(names) {
//     var container = document.getElementById('checkboxContainer');
//     container.innerHTML = ''; // Clear any existing checkboxes
//     names.forEach(function(name) {
//         var checkbox = document.createElement('input');
//         checkbox.type = 'checkbox';
//         checkbox.id = name;
//         checkbox.name = 'names[]';
//         checkbox.value = name;

//         var label = document.createElement('label');
//         label.htmlFor = name;
//         label.appendChild(document.createTextNode(name));

//         container.appendChild(checkbox);
//         container.appendChild(label);
//         container.appendChild(document.createElement('br'));
//     });
// }
// selected display
function displayCheckboxesAD(names) {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = ''; // Clear any existing checkboxes
    names.forEach(function (employee) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = employee.adgh_id; // Use adgh_id as id
        checkbox.name = 'employees[]';
        checkbox.value = employee.adgh_id; // Use adgh_id as value

        var label = document.createElement('label');
        label.htmlFor = employee.id;
        label.appendChild(document.createTextNode(employee.name)); // Display full name

        container.appendChild(checkbox);
        container.appendChild(label);
        container.appendChild(document.createElement('br'));
    });
}
function displayCheckboxes(names) {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = ''; // Clear any existing checkboxes
    names.forEach(function (employee) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = employee.id; // Use emp_id as id
        checkbox.name = 'employees[]';
        checkbox.value = employee.id; // Use emp_id as value

        var label = document.createElement('label');
        label.htmlFor = employee.id;
        label.appendChild(document.createTextNode(employee.name)); // Display full name

        container.appendChild(checkbox);
        container.appendChild(label);
        container.appendChild(document.createElement('br'));
    });
}



function submitForm(actionUrl) {
    console.log("about to enter php");
    var form = document.getElementById('mark-form');
    var formData = new FormData(form);

    var selectedEmployees = [];
    document.querySelectorAll('#checkboxContainer input[type="checkbox"]:checked').forEach(function (checkbox) {
        selectedEmployees.push(checkbox.value);
    });

    formData.append('selected_employees', JSON.stringify(selectedEmployees));

    var xhr = new XMLHttpRequest();
    xhr.open('POST', actionUrl, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Marked successfully!');
                    } else {
                        console.error('Error from server:', response.error);
                    }
                } catch (e) {
                    console.error('Invalid JSON:', e);
                    console.error('Response:', xhr.responseText); // Log the raw response
                }
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };
    xhr.send(formData);
}

// REFERENCE FROM V0.5 SCRIPT2.JS
// SELECT AD/GH GROUPWISE AND DISPLAY EMPLOYEES OF THE GROUP TO WHICH AD BELONGS TO 
