<?php

    class forgotPasswordTemplate extends template {
    
        public $resetPasswordEmail = '
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <form action="?page=forgotPassword&action=reset" method="post">
                        <p>
                            To reset your password enter your email address, you will then be sent instructions on how to reset your password!
                        </p>
                        <p>
                            <input class="form-control" type="email" name="email" placeholder="Email Address" />
                        </p>

                        <p class="text-right">
                            <button type="submit" class="btn btn-default">Reset Password</button>
                        </p>
                    </form>
                </div>
            </div>
        ';

        public $resetPassword = '

            <p>
                Please enter a new password!
            </p>

            <form action="?page=forgotPassword&action=resetPassword&auth={auth}&id={id}" method="post">
                <input class="form-control" type="password" name="password" placeholder="Password" />
                <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" />

                <div class="text-right">
                    <button type="submit" class="btn">Reset Password</button>
                </div>
            </form>
        ';
        
    }

?>