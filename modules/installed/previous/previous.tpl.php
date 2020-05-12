<?php

    class previousTemplate extends template {

        public $competitions = '

            <h2>Previous Competitions</h2>

            <div class="row">
                {#each competitions}
                    <div class="col-sm-4 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">{title}</div>
                            <div class="panel-feature" style="background-image:url(modules/installed/competitions/images/{id}.png)"></div>
                            <div class="panel-body text-center">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <p>&pound;{cost}</p>
                                    </div>
                                    <div class="col-xs-6">
                                        <p><a href="?page=competitions&action=view&id={id}">
                                            View
                                        </a></p>
                                    </div>
                                </div>
                                <small>{date}</small>
                            </div>
                        </div>
                    </div>
                {/each}
            </div>
        ';
        
    }

?>