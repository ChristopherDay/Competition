<?php

    class accountTemplate extends template {
        

        public $editPassword = '


            <div class="panel panel-default">
                <div class="panel-heading">My Account > Edit Password</div>
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="?page=account&action=edit">Billing / Shipping Address</a></li>
                    <li class="active"><a href="?page=account&action=password">Change Password</a></li>
                </ul>
                <div class="panel-body">


                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>Old Password</strong>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="old" class="form-control" value="" placeholder="******" />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>New Password</strong>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="new" class="form-control" value="" placeholder="******" />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-3 text-right">
                                <strong>Confirm Password</strong>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="confirm" class="form-control" value="" placeholder="******" />
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" name="submit" value="true" class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            ';

        public $editProfile = '

            <div class="panel panel-default">
                <div class="panel-heading">My Account > Edit Addresses</div>
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="?page=account&action=edit">Billing / Shipping Address</a></li>
                    <li><a href="?page=account&action=password">Change Password</a></li>
                </ul>
                <div class="panel-body">
                    <form action="#" method="post">


                        <div class="row">
                            <div class="col-md-6">
                                <h4>Billing Address</h4>

                                <strong>Street Address</strong>
                                <input type="text" name="street" class="form-control" value="{info.US_street}"  />

                                <strong>Line 2</strong>
                                <input type="text" name="line2" class="form-control" value="{info.US_line2}"  />

                                <strong>City</strong>
                                <input type="text" name="city" class="form-control" value="{info.US_city}"  />

                                <strong>County</strong>
                                <input type="text" name="county" class="form-control" value="{info.US_county}"  />

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Postcode</strong>
                                        <input type="text" name="postcode" class="form-control" value="{info.US_postcode}"  />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 billing">
                                <h4>
                                    Shipping Address
                                    <small class="pull-right">
                                        <input type="checkbox" name="same" onClick="copyAddress()" /> 
                                        Same as Billing Address
                                    </small>
                                </h4>

                                <strong>Street Address</strong>
                                <input type="text" name="billStreet" class="form-control" value="{info.US_billStreet}"  />

                                <strong>Line 2</strong>
                                <input type="text" name="billLine2" class="form-control" value="{info.US_billLine2}"  />

                                <strong>City</strong>
                                <input type="text" name="billCity" class="form-control" value="{info.US_billCity}"  />

                                <strong>County</strong>
                                <input type="text" name="billCounty" class="form-control" value="{info.US_billCounty}"  />

                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Postcode</strong>
                                        <input type="text" name="billPostcode" class="form-control" value="{info.US_billPostcode}"  />
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" name="submit" value="true" class="btn btn-default">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            ';
        
    }

?>