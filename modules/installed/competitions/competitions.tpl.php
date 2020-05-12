<?php

    class competitionsTemplate extends template {
        
        public $competition = '
            <h1>
                {title}
                <small class="pull-right">
                    &pound;{cost}
                </small>
            </h1>
            <div class="row">
                <div class="col-md-6">
                    <img src="modules/installed/competitions/images/{id}.png" alt="{title} image" class="img-responsive img-thumbnail" />
                </div>
                <div class="col-md-6">



                    <div class="panel panel-default">
                        <div class="panel-heading">Enter Draw</div>
                        <div class="panel-body">
                            <p>
                                <strong>Question:</strong><br />
                                {question}
                            </p>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p>
                                        A) {ans1}
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        B) {ans2}
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        C) {ans3}
                                    </p>
                                </div>
                            </div>


                            <hr />

                            {#if locked}
                                <div class="alert alert-warning">
                                    This competition is now closed!
                                </div>
                            {/if}
                            {#unless locked}
                                <form method="post" action="?page=cart&action=add">
                                    <input type="hidden" name="comp" value="{id}" />
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <strong>Answer</strong>
                                            <select class="form-control" name="answer">
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                                <option value="3">C</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <strong>Entries</strong>
                                            <select class="form-control" name="qty">
                                                {#each entries}
                                                    <option>{number}</option>
                                                {/each}
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            &nbsp;<br />
                                            <button class="btn btn-default btn-block">
                                                Enter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            {/unless}
                        </div>
                    </div>
                    <h3>Tickets Sold</h3>

                    <strong>0 <span class="pull-right">{maxTickets}</span></strong>
                    <div class="progress">
                        <div class="progress-bar" style="width: 1%;">
                        <span class="sr-only"></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <h3>Description</h3>
            <{text}>

        ';

        public $competitions = '

            <h2>Current Competitions</h2>
            
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
        
        public $pageText = '

            <div class="panel panel-default">
                <div class="panel-heading">{title}</div> 
                <div class="panel-body"> 
                    <{text}>
                </div> 
        </div>
        ';
  

        public $competitionsList = '
            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th width="150px">Cost</th>
                        <th width="120px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    {#each competitions}
                        <tr>
                            <td>{title}</td>
                            <td>&pound;{cost}</td>
                            <td>
                                [<a href="?page=admin&module=competitions&action=edit&id={id}">Edit</a>] 
                                [<a href="?page=admin&module=competitions&action=delete&id={id}">Delete</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $competitionsDelete = '
            <form method="post" action="?page=admin&module=competitions&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Are you sure you want to delete this news post?</p>

                    <p><em>"{title}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this news post</button>
                </div>
            </form>
        
        ';


        public $competitionsNewForm = '
            <form method="post" action="?page=admin&module=competitions&action={editType}&id={id}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="pull-left">Competition Title</label>
                            <input type="text" class="form-control" name="title" value="{title}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Image <small>(Leave blank to stay the same)</small></label>
                            <input type="file" class="form-control" name="image" value="">
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Draw Date</label>
                            <input type="datetime-local" class="form-control" name="date" value="{date}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="pull-left">Competition Text</label>
                    <textarea rows="8" type="text" class="form-control" data-editor="html" name="text">{text}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Maximum Tickets Available</label>
                            <input type="text" class="form-control" name="maxTickets" value="{maxTickets}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Maximum Tickets Users Can Buy</label>
                            <input type="text" class="form-control" name="maxPurchase" value="{maxPurchase}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="pull-left">Tickets Cost</label>
                            <input type="text" class="form-control" name="cost" value="{cost}">
                        </div>
                    </div>
                </div>

                <hr />

                <div class="form-group">
                    <label class="pull-left">Question</label>
                    <input type="text" class="form-control" name="question" value="{question}">
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Answer 1</label>
                            <input type="text" class="form-control" name="ans1" value="{ans1}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Answer 2</label>
                            <input type="text" class="form-control" name="ans2" value="{ans2}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Answer 3</label>
                            <input type="text" class="form-control" name="ans3" value="{ans3}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="pull-left">Correct Answer</label>
                            <select type="text" class="form-control" name="correct" data-value="{correct}">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
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