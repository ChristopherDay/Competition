<?php

    class loginTemplate extends template {
    
        public $loginForm = '
                
                <{text}>

                <div class="row">
                    <div class="col-md-6">
                        <h3>Login</h3>
                        <form action="?page=login&action=login" method="post">
                            <input autocomplete="new-password" type="input" class="form-control" name="email" placeholder="Email" /><br />
                            <input autocomplete="new-password" type="password" class="form-control" name="password" placeholder="Password" /><br />

                            <div class="row">
                                <div class="col-xs-8 text-left">
                                    <a href="?page=forgotPassword">Forgot Password?</a>
                                </div>
                                <div class="col-xs-4">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-default">Login</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-6">
                        <h3>Register</h3>
                        <form action="?page=register&action=register{#if ref}&ref={ref}{/if}" method="post">
                            <input class="form-control" type="text" name="username" placeholder="Username" /><br />
                            <input class="form-control" type="text" autocomplete="off" name="email" placeholder="EMail" /><br />
                            <div class="row">
                                <div class="col-xs-6">
                                    <input class="form-control" type="password" name="password" placeholder="Password" />
                                </div>
                                <div class="col-xs-6">
                                    <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" />
                                </div>
                            </div><br />
                            <div class="text-right">
                                <button type="submit" class="btn btn-default">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

        ';

        public $loginOptions = '

            <form method="post" action="?page=admin&module=login&action=settings">

                <div class="row">
                    <div class="col-md-12">
                        <label class="">Login Suffix</label>
                        <div class="form-group">
                            <textarea type="text" class="form-control" data-editor="html" name="loginSuffix" rows="5">{loginSuffix}</textarea>
                        </div>
                    </div">
                    "                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="">Login Postfix</label>
                        <div class="form-group">
                            <textarea type="text" class="form-control" data-editor="html" name="loginPostfix" rows="5">{loginPostfix}</textarea>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
        ';
        
    }

?>