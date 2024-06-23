// function displayCheckBox(){
//     var ele=document.getElementsByName('select_mark_to');
//     for(i=0;i<ele.length;i++){
//         if(ele[i].checked){
//             if(ele[i].value=="AD")
//         }
//     }
// }
// document.addEventListener('DOMContentLoaded',()=>{
//     console.log("eventfired");
//     const AD=document.getElementById("AD");
//     const EMPLOYEES=document.getElementById("EMPLOYEES");
//     const checkboxContainer=document.getElementById("checkboxContainer")
//     AD.addEventListener('click',()=>{console.log('ad radio button clicked');fetchUsernames('AD')});
//     EMPLOYEES.addEventListener('click',()=>{console.log('employee radio button clicked');fetchUsernames('EMPLOYEES')});
//     function fetchUsernames(val){
//         console.log('entered function');
//         checkboxContainer.innerHTML='';
//         fetch('fetch_usernames.php?val=${val}')
//             .then(response=>response.json())
//             .then(data=>{
//                 data.forEach(user=>{
//                     console.log('exited function');
//                     const checkbox=document.createElement('input');
//                     checkbox.type='checkbox';
//                     checkbox.name='selectedUser[]';
//                     checkbox.value=user.id;
//                     checkbox.id='user_${user.id}';
//                     const label=document.createElement('label');
//                     label.htmlFor='user_${user.id}';
//                     label.textContent=user.username;
//                     checkboxContainer.appendChild(checkbox);
//                     checkboxContainer.appendChild(label);
//                     checkboxContainer.appendChild(document.createElement('br'));
//                 });
//             })
//             .catch(error=>console.error('Error fetching usernames:',error));
//     }
// })
// document.addEventListener('DOMContentLoaded', () => {
//     console.log("event fired");
//     const AD = document.getElementById("AD");
//     const EMPLOYEES = document.getElementById("EMPLOYEES");
//     const checkboxContainer = document.getElementById("checkboxContainer");

//     if (AD && EMPLOYEES && checkboxContainer) {
//         AD.addEventListener('click', () => {
//             console.log('AD radio button clicked');
//             fetchUsernames('AD');
//         });

//         EMPLOYEES.addEventListener('click', () => {
//             console.log('EMPLOYEES radio button clicked');
//             fetchUsernames('EMPLOYEES');
//         });

//         function fetchUsernames(val) {
//             console.log('entered function');
//             checkboxContainer.innerHTML = '';
//             fetch(`fetch_usernames.php?val=${val}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     data.forEach(user => {
//                         console.log('exited function');
//                         const checkbox = document.createElement('input');
//                         checkbox.type = 'checkbox';
//                         checkbox.name = 'selectedUser[]';
//                         checkbox.value = user.id;
//                         checkbox.id = `user_${user.id}`;

//                         const label = document.createElement('label');
//                         label.htmlFor = `user_${user.id}`;
//                         label.textContent = user.username;

//                         checkboxContainer.appendChild(checkbox);
//                         checkboxContainer.appendChild(label);
//                         checkboxContainer.appendChild(document.createElement('br'));
//                     });
//                 })
//                 .catch(error => console.error('Error fetching usernames:', error));
//         }
//     } else {
//         console.error('One or more elements not found in the DOM');
//     }
// });
