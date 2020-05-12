<?php

    class pageNotFoundTemplate extends template {
        
        public $pageNotFound = '

            <div class="panel panel-default">
                <div class="panel-heading">Something went wrong</div>
                <div class="panel-body">
                    <p> We could not find the page you requested!</p>
                </div>
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
  

        public $pageNotFoundList = '
            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="150px">URL</th>
                        <th>Title</th>
                        <th width="120px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    {#each pageNotFound}
                        <tr>
                            <td>{url}</td>
                            <td>{title}</td>
                            <td>
                                [<a href="?page=admin&module=pageNotFound&action=edit&id={id}">Edit</a>] 
                                [<a href="?page=admin&module=pageNotFound&action=delete&id={id}">Delete</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $pageNotFoundDelete = '
            <form method="post" action="?page=admin&module=pageNotFound&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Are you sure you want to delete this news post?</p>

                    <p><em>"{title}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this news post</button>
                </div>
            </form>
        
        ';


        public $pageNotFoundNewForm = '
            <form method="post" action="?page=admin&module=pageNotFound&action={editType}&id={id}">
                <div class="form-group">
                    <label class="pull-left">Page URL</label>
                    <input type="text" class="form-control" name="url" value="{url}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Page Title</label>
                    <input type="text" class="form-control" name="title" value="{title}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Page Text</label>
                    <textarea rows="8" type="text" class="form-control" data-editor="html" name="text">{text}</textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
        ';
        
    }

?>