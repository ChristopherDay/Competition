<?php

    class contactTemplate extends template {
        
        public $contactUs = '

            <h2>Contact Us</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Ways to Contact Us</div>
                        <div class="panel-body">
                            <p>
                                <strong>Telephone:</strong><br />
                                01483 123456
                            </p>
                            <p>
                                <strong>Mobile:</strong><br />
                                07123 456789
                            </p>
                            <p>
                                <strong>Email:</strong><br />
                                your@email.com
                            </p>
                            <p>
                                <strong>Twitter:</strong><br />
                                <a href="#">@YourTwitter</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Email Us</div>
                        <div class="panel-body">
                            <form method="POST" action="?page=contact&action=email">
                                <p>
                                    <strong>Your Name:</strong><br />
                                    <input tpye="text" name="name" value="{name}" class="form-control" />
                                </p>
                                <p>
                                    <strong>Your Email Address:</strong><br />
                                    <input tpye="text" name="email" value="{email}" class="form-control" />
                                </p>
                                <p>
                                    <strong>Subject:</strong><br />
                                    <input tpye="text" name="subject" value="{subject}" class="form-control" />
                                </p>
                                <p>
                                    <strong>Enquiry:</strong><br />
                                    <textarea name="body" class="form-control" rows="10">{body}</textarea>
                                </p>
                                <p class="text-right">
                                    <input type="submit" class="btn btn-default" value="Send" />
                                </p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        ';
        
    }

?>