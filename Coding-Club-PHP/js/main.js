function validateForm() {

                const phoneNumberPattern = /^(?:\+?1[-.\s]?)?(?:(\(\d{3}\))|(\d{3}))[-.\s]?\d{3}[-.\s]?\d{4}$/;
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                const firstName = document.getElementById('firstName').value;
                const lastName = document.getElementById('lastName').value;
                const phone = document.getElementById('phone').value;
                const email = document.getElementById('email').value;
                const radioButtons = document.getElementsByName('skillLevel');
                const objective = document.getElementById('objective').value;

                if (!firstName) {
                    alert('Please enter your "First Name"');
                    return false; // prevent form submission
                }
                else if (!lastName) {
                    alert('Please enter your "Last Name"');
                    return false; // prevent form submission
                }
                 
                if(!phoneNumberPattern.test(phone)) {
                    alert('Please correct your "Phone Number"');
                    return false; // prevent form submission
                }

                if(!emailPattern.test(email)) {
                    alert('Please correct your "Email Address"');
                    return false; // prevent form submission
                }

                for (let i = 0; i < radioButtons.length; i++) {
                    if (radioButtons[i].checked) {
                        isChecked = true;
                        break; // prevent form submission
                    }
                }
                
                if(!isChecked){
                    alert('Please select a "Skill level"');
                    return false; // prevent form submission
                }
                

                if (!objective) {
                    alert('Please enter your "Objective"');
                    return false; // prevent form submission
                }

                
                return true; // Change to true when debugging is complete to submit the the form.
           } 
                            
      