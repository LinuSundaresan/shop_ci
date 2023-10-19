<?php include 'includes/header.php'; ?>
    
<div class="container">
            <form class="form-horizontal" role="form">
                <h2>Registration Form</h2>

                <h2><?php echo $this->session->flashdata('save'); ?></h2> 
                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="firstName" placeholder="Full Name" class="form-control" autofocus>
                        <span class="" id="fname_error">Please enter first name</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="lastName" placeholder="Full Name" class="form-control" autofocus>
                        <span class="" id="lname_error">Please enter last name</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="email" placeholder="Email" class="form-control">
                        <span class="" id="email_error">Please enter a valid email</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="address" id="address"></textarea>
                        <span class="" id="address_error">Please enter an address</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="test" id="city" placeholder="City" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Country</label>
                    <div class="col-sm-9">
                        <input type="text" id="country" placeholder="Country" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" placeholder="Password" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="cpassword" placeholder="Password" class="form-control">
                        <span class="" id="password_error">Password didn't match</span>
                    </div>
                </div>
             
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="button" class="btn btn-primary btn-block" onclick="validate()">Register</button>
                    </div>

                    <div class="col-sm-9 col-sm-offset-3" style="margin-top:20px;">
                        <a href="<?php echo base_url();?>user/login"><button type="button" class="btn btn-primary btn-block">Login</button></a>
                    </div>
                </div>
            </form> <!-- /form -->
        </div> <!-- ./container -->


        <script>

            $( document ).ready(function() {
                $('#fname_error').hide();
                $('#lname_error').hide();
                $('#address_error').hide();
                $('#password_error').hide();
                $('#email_error').hide();
            });

            function validate(){
                var base_url = 'http://localhost/trawex/';
                var first_name = $('#firstName').val();
                var last_name  = $('#lastName').val();
                var email      = $('#email').val();
                var address    = $('#address').val();
                var city       = $('#city').val();
                var country    = $('#country').val();
                var password   = $('#password').val();
                var cpassword  = $('#cpassword').val();


                if(first_name==""){
                    $('#fname_error').show();
                }else{
                    $('#fname_error').hide();
                }

                if(last_name==""){
                    $('#lname_error').show();
                }else{
                    $('#lname_error').hide();
                }


                var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

                if (email_reg.test(email) == false) {
                    $('#email_error').show();
                }else{
                    $('#email_error').hide(); 
                }

                if(password==""){
                    $('#password_error').html('please add a password');
                    $('#password_error').show();
                }
                else{
                    if(password!=cpassword){
                        $('#password_error').html('Passwords didn\'t');
                        $('#password_error').show();
                    }else{
                        $('#password_error').hide();
                    }
                }


                if(first_name!="" && last_name!="" && email!="" && password!="" && cpassword!="" && (email_reg.test(email) == true) && (password==cpassword)){
                    var post_data = {
                        first_name: first_name,
                        last_name: last_name,
                        email : email,
                        password : password,
                        address : address,
                        city : city,
                        country : country
                    };
                    $.ajax({
                        url: base_url + "user/register",
                        type: 'POST',
                        data: post_data,
                        dataType: "json",
                        async: false,
                        success: function(data) {
                            console.log(data);
                            $('#firstName').val("");
                            $('#lastName').val("");
                            $('#email').val("");
                            $('#address').val("");
                            $('#city').val("");
                            $('#country').val("");
                            $('#password').val("");
                            $('#cpassword').val("");

                            if(data == true){
                                alert("registration successful");
                            }
                        }
                    });
                 }
                


            }
        
        </script>

        <?php include 'includes/footer.php'; ?>