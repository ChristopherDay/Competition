<?php

    class FAQTemplate extends template {
        
        public $FAQArticle = '

            <h2>Frequently Asked Questions</h2>
            {#each FAQ}
                <div class="panel panel-default faq-item faq-hidden">
                    <div class="panel-heading">
                        {title}
                    </div>
                    <div class="panel-body">
                        [{text}]
                    </div>
                </div>
            {/each}
        ';
  

        public $FAQList = '
            <table class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th width="120px">Options</th>
                    </tr>
                </thead>
                <tbody>
                    {#each FAQ}
                        <tr>
                            <td>{title}</td>
                            <td>
                                [<a href="?page=admin&module=FAQ&action=edit&id={id}">Edit</a>] 
                                [<a href="?page=admin&module=FAQ&action=delete&id={id}">Delete</a>]
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        ';

        public $FAQDelete = '
            <form method="post" action="?page=admin&module=FAQ&action=delete&id={id}&commit=1">
                <div class="text-center">
                    <p> Are you sure you want to delete this FAQ post?</p>

                    <p><em>"{title}"</em></p>

                    <button class="btn btn-danger" name="submit" type="submit" value="1">Yes delete this FAQ post</button>
                </div>
            </form>
        
        ';


        public $FAQNewForm = '
            <form method="post" action="?page=admin&module=FAQ&action={editType}&id={id}">
                <div class="form-group">
                    <label class="pull-left">Title</label>
                    <input type="text" class="form-control" name="title" value="{title}">
                </div>
                <div class="form-group">
                    <label class="pull-left">Text</label>
                    <textarea rows="8" type="text" class="form-control" name="text">{text}</textarea>
                </div>
                <div class="text-right">
                    <button class="btn btn-default" name="submit" type="submit" value="1">Save</button>
                </div>
            </form>
        ';
    }

?>