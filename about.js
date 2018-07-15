
        var  arr = new Array();
        var letters = /^[A-Za-z]+$/;  
        var call ;

        jQuery(document).ready(function() {

            $('#closeSignup').click(function()  // click x in signup modal  
            {
                document.getElementById('signupbtn').disabled = true ;
                $('#signupModal').modal('hide');
                clearsignupModal();
            });

             $('#closeLogin').click(function()  // click x in login modal  
            {
                $('#loginModal').modal('hide');
                clearloginModal();
            });


            validateFirstName();
            validateSecondName();
            validateid();
            validateemail();
            validatePassword();
            validateConfirmPassword();
            call = setInterval (signup , 300);


            if($('#loginModal').hasClass('in'))
            {
                    document.getElementById('userEmail').onchange = function() {
                     if(this.value === '') {
                         document.getElementById('userPsw').value = '';
                     }
                     }
            };
 });

                function clearsignupModal() {

                    $("#FirstName").val('');
                    document.getElementById('form-group-first-name').className = "";
                    document.getElementById('form-span-first-name').className = "";

                    $("#SecondName").val('');
                    document.getElementById('form-group-second-name').className = "";
                    document.getElementById('form-span-second-name').className = "";

                    $("#id").val('');
                    document.getElementById('form-group-id').className = "";
                    document.getElementById('form-span-id').className = "";

                     $("#email").val('');
                    document.getElementById('form-group-email').className = "";
                    document.getElementById('form-span-email').className = "";

                    $("#psw").val('');
                    document.getElementById('form-group-password').className = "";
                    document.getElementById('form-span-password').className = "";

                     $("#psw-repeat").val('');
                    document.getElementById('form-group-password-confirm').className = "";
                    document.getElementById('form-span-password-confirm').className = "";
                }
    

        function signup(){

            
            console.log('im in signup');
            if($('#signupModal').hasClass('in'))
            {
                if(arr[0] && arr[1] && arr[2] && arr[3] && arr[4] && arr[5])
                {
                    document.getElementById('signupbtn').disabled = false ;
                    console.log(arr[0] && arr[1] && arr[2] && arr[3] && arr[4] && arr[5]);
                    console.log('Im enable now') ;
                }
                else
                {
                    document.getElementById('signupbtn').disabled = true ;
                    console.log(arr[0] && arr[1] && arr[2] && arr[3] && arr[4] && arr[5]);
                    console.log('Im unenable now') ;
                }
            }
            else{
                clearsignupModal();
            }
    }


        /**
         * register
         * validate: first name
         */
        function validateFirstName() {
            var firstname = document.getElementById('FirstName');
            var fn=document.forms["SignUpForm"]["FirstName"].value;
            firstname.addEventListener("keyup", function (event) {
               if (document.getElementById('FirstName').value.length > 12 )
                    {
                        document.getElementById('form-group-first-name').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-first-name').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('is too long');
                        arr[0]=0 ;
                    }
                    else if (document.getElementById('FirstName').value.length < 3 )
                    {
                        document.getElementById('form-group-first-name').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-first-name').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('is too short');
                        arr[0]=0 ;
                    }
                    else 
                        if (document.getElementById('FirstName').value.match(letters))
                            {
                                document.getElementById('form-group-first-name').className = "form-group has-success has-feedback";
                                document.getElementById('form-span-first-name').className = "glyphicon glyphicon-ok form-control-feedback";
                                console.log('true');
                                arr[0]=1 ;
                            }
                             else 
                            {
                                document.getElementById('form-group-first-name').className = "form-group has-error has-feedback";
                                document.getElementById('form-span-first-name').className = "glyphicon glyphicon-remove form-control-feedback";
                                $('input#FirstName').get(0).setCustomValidity(fn +' is Not Valid ! Name should contain only alphabets and spaces .');
                                arr[0]=0 ;
                            }
                    }, false);
        }

        /**
         * register
         * validate: Second name
         */
            function validateSecondName() {
             var secondname = document.getElementById('SecondName');
            var sn = document.forms["SignUpForm"]["SecondName"].value;
            secondname.addEventListener("keyup", function (event) {
                if (document.getElementById('SecondName').value.length > 12 )
                    {
                        document.getElementById('form-group-second-name').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-second-name').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('too long');
                        arr[1]=0 ;
                    }
                    else if (document.getElementById('SecondName').value.length < 3 )
                    {
                        document.getElementById('form-group-second-name').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-second-name').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('too short');
                        arr[1]=0 ;
                    }
                 else 
                    if (document.getElementById('SecondName').value.match(letters))
                        {
                            document.getElementById('form-group-second-name').className = "form-group has-success has-feedback";
                            document.getElementById('form-span-second-name').className = "glyphicon glyphicon-ok form-control-feedback";
                            console.log('true');
                            arr[1]=1 ;
                        }
                         else
                        {
                            document.getElementById('form-group-second-name').className = "form-group has-error has-feedback";
                            document.getElementById('form-span-second-name').className = "glyphicon glyphicon-remove form-control-feedback";
                            console.log('not valid');
                            arr[1]=0 ;
                        }
                    }, false);
        }

        /**
         * register
         * validate: id
         */
        function validateid() {
            var id = document.getElementById('id');
            var myid = document.forms["SignUpForm"]["id"].value;
            id.addEventListener("keyup", function (event) {
               
               if (document.forms["SignUpForm"]["id"].value=="")
                    {
                        document.getElementById('form-group-id').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-id').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('Required !');
                        arr[2]=0 ;
                    }
                    else if (document.getElementById('id').value.match(letters))
                    {
                        document.getElementById('form-group-id').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-id').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('not valid should be integer');
                        arr[2]=0 ;
                    }
                     else 
                    {
                        document.getElementById('form-group-id').className = "form-group has-success has-feedback";
                        document.getElementById('form-span-id').className = "glyphicon glyphicon-ok form-control-feedback";
                        console.log('true');
                        arr[2]=1 ;
                    }
                    }, false);
        }

        /**
         * register
         * validate: password
         */
        function validatePassword() {
            var inputpassword = document.getElementById('psw');
            inputpassword.addEventListener("keyup", function (event) {
                var password = document.forms["SignUpForm"]["psw"].value;
                var passwordcf = document.forms["SignUpForm"]["psw-repeat"].value;

                     if (password=="")
                    {
                        document.getElementById('form-group-password').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-password').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('Required !');
                        arr[3]=0 ;
                    }
                    else if (document.getElementById('psw').value.length < 4)
                    {
                        document.getElementById('form-group-password').className = "form-group has-error has-feedback";
                        document.getElementById('form-span-password').className = "glyphicon glyphicon-remove form-control-feedback";
                        console.log('too short !');
                        arr[3]=0 ;
                    }else 
                     {
                        document.getElementById('form-group-password').className = "form-group has-success has-feedback";
                        document.getElementById('form-span-password').className = "glyphicon glyphicon-ok form-control-feedback";
                        console.log('Accepted !');
                        arr[3]=1 ;
                    } 
                // check confirm password in case password is modified after confirm
                // password
                validateConfirmPasswordIn();
            }, false);
        }


        /**
         * register
         * validate: password confirmation listener
         */
        function validateConfirmPassword() {
            var passwordconfirm = document.getElementById('psw-repeat');
            passwordconfirm.addEventListener("keyup", function (event) {
                 validateConfirmPasswordIn();
            }, false);

        }
        /**
         * only do the confirm password validate
         */
        function validateConfirmPasswordIn() {
            console.log("Im in Confirm Validate");
            var password = document.forms["SignUpForm"]["psw"].value;
            var passwordcf = document.forms["SignUpForm"]["psw-repeat"].value;
            console.log(arr[3]);
            if(arr[3]){
                if (passwordcf == password && arr[3]) {
                    document.getElementById('form-group-password-confirm').className = "form-group has-success has-feedback";
                    document.getElementById('form-span-password-confirm').className = "glyphicon glyphicon-ok form-control-feedback";
                    console.log('true');
                    arr[4]=1 ;
                } else {
                    document.getElementById('form-group-password-confirm').className = "form-group has-error has-feedback";
                    document.getElementById('form-span-password-confirm').className = "glyphicon glyphicon-remove form-control-feedback";
                    console.log('not the same');
                    arr[4]=0 ;
                }
            }else
            {
                document.getElementById('form-group-password-confirm').className = "form-group has-error has-feedback";
                    document.getElementById('form-span-password-confirm').className = "glyphicon glyphicon-remove form-control-feedback";
                    console.log('not the same');
                    arr[4]=0 ;
            }
        }

         /**
         * register
         * validate: email
         */
        function validateemail()
        {
            var email = document.getElementById('email').value;
            var myemail = document.getElementById('email');
            myemail.addEventListener("keyup", function (event) {
                if ( document.getElementById('email').value != "") { 
                    document.getElementById('form-group-email').className = "form-group has-success has-feedback";
                    document.getElementById('form-span-email').className = "glyphicon glyphicon-ok form-control-feedback";
                    arr[5]=1 ;
                    console.log("valid email");
                } else {
                    document.getElementById('form-group-email').className = "form-group has-error has-feedback";
                    document.getElementById('form-span-email').className = "glyphicon glyphicon-remove form-control-feedback";
                    console.log('email not valid ');
                    arr[5]=0 ;
                }
        } , false);
}
/*------------------------ log in modal ------------------------------------*/


function clearloginModal(){

     $("#userEmail").val('');
         document.getElementById('form-group-user-email').className = "";
         document.getElementById('form-span-user-email').className = "";


     $("#userPsw").val('');
         document.getElementById('form-group-user-psw').className = "";
         document.getElementById('form-span-user-psw').className = "";

}


var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
function validate()
{
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if ( username == "Formget" && password == "formget#123")
        {
            alert ("Login successfully");
            window.location = "success.html"; // Redirecting to other page.
            return false;
        }
        else
        {
            attempt --;// Decrementing by one.
            alert("You have left "+attempt+" attempt;");
            // Disabling fields after 3 attempts.
            if( attempt == 0)
            {
                document.getElementById("username").disabled = true;
                document.getElementById("password").disabled = true;
                document.getElementById("submit").disabled = true;
                return false;
            }
        }
}



