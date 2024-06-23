
document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('WHOLE').addEventListener('click', function() {
        document.getElementById('groupDropdownContainer').style.display = 'none';
        fetchAllGroups();
        showSubmitButton('wholeSubmitButton');
    });
    document.getElementById('EMPLOYEES').addEventListener('click', function() {
        fetchGroups();
        showSubmitButton('employeesSubmitButton');
    });

    document.getElementById('groupSelect').addEventListener('change', function() {
        var groupId = this.value;
        if (groupId) {
            fetchEmployeeNames(groupId);
        }
    });
});

function showSubmitButton(buttonId) {
    document.getElementById('wholeSubmitButton').style.display = 'none';
    document.getElementById('employeesSubmitButton').style.display = 'none';
    document.getElementById(buttonId).style.display = 'block';
}

function fetchGroups() {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = '';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_groups.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log('Raw response:', xhr.responseText);
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

function fetchAllGroups() {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = '';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_groups.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log('Raw response:', xhr.responseText);
            if (xhr.status == 200) {
                try {
                    var groups = JSON.parse(xhr.responseText);
                    if (groups.error) {
                        console.error('Error from server:', groups.error);
                    } else {
                        displayCheckboxes1(groups);
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

function fetchEmployeeNames(groupId) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_employee_names.php?group_id=' + groupId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            console.log('Raw response:', xhr.responseText);
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
    groups.forEach(function(group) {
        var option = document.createElement('option');
        option.value = group.id;
        option.textContent = group.name;
        groupSelect.appendChild(option);
    });
    document.getElementById('groupDropdownContainer').style.display = 'block';
}

function displayCheckboxes(names) {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = '';
    names.forEach(function(employee) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = employee.id;
        checkbox.name = 'employees[]';
        checkbox.value = employee.id;

        var label = document.createElement('label');
        label.htmlFor = employee.id;
        label.appendChild(document.createTextNode(employee.name));

        container.appendChild(checkbox);
        container.appendChild(label);
        container.appendChild(document.createElement('br'));
    });
}

function displayCheckboxes1(names) {
    var container = document.getElementById('checkboxContainer');
    container.innerHTML = '';
    names.forEach(function(group) {
        var checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = group.id;
        checkbox.name = 'employees[]';
        checkbox.value = group.id;

        var label = document.createElement('label');
        label.htmlFor = group.id;
        label.appendChild(document.createTextNode(group.name));

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
    document.querySelectorAll('#checkboxContainer input[type="checkbox"]:checked').forEach(function(checkbox) {
        selectedEmployees.push(checkbox.value);
    });

    formData.append('selected_employees', JSON.stringify(selectedEmployees));
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', actionUrl, true);
    xhr.onreadystatechange = function() {
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
                    console.error('Response:', xhr.responseText);
                }
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        }
    };
    xhr.send(formData);
}
