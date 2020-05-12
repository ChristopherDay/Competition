<?php

    class cartTemplate extends template {
        
        public $cartItem = '
            <hr>
            <div class="row">
                <div class="col-xs-2">
                    <div class="cart-image" style="background-image: url(modules/installed/competitions/images/{C_id}.png)"></div>
                </div>
                <div class="col-xs-4">
                    <h4 class="product-name">
                        <a href="?page=competitions&action=view&id={C_id}">
                            <strong>{C_title}</strong>
                        </a>
                    </h4>
                    <h4><small>{C_question}</small></h4>
                    <div class="row questions">
                        <div class="col-md-4">
                            <div class="label {#unless ans1}label-default{/unless} {#if ans1}label-success{/if}">A) {C_ans1}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="label {#unless ans2}label-default{/unless} {#if ans2}label-success{/if}">B) {C_ans2}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="label {#unless ans3}label-default{/unless} {#if ans3}label-success{/if}">C) {C_ans3}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="col-xs-6 text-right">
                        <h6><strong>&pound;{C_cost} <span class="text-muted">x</span></strong></h6>
                    </div>
                    <div class="col-xs-6">

                        <form method="post" action="?page=cart">
                            <input type="hidden" name="comp" value="{C_id}" />
                            <input type="hidden" name="answer" value="{CA_ans}" />
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button name="action" value="remove" class="btn btn-danger" type="submit">
                                        &nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;
                                    </button>
                                </span>
                                <input type="text" class="form-control" name="qty" value="{CA_qty}" />
                                <span class="input-group-btn">
                                    <button name="action" value="edit" class="btn btn-primary" type="submit">
                                        <span class="glyphicon glyphicon-sync"></span> Update
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="btn btn-link btn-xs">
                        </button>
                    </div>
                </div>
            </div>
        ';

        public $cart = '
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                            </div>
                            <div class="col-xs-6">
                                <a href="?page=competitions" class="btn btn-primary btn-sm btn-block">
                                    <span class="glyphicon glyphicon-share-alt"></span> View Competitions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {#unless cart}
                        <div class="panel panel-default" style="margin: 0px">
                            <div class="panel-body">
                                <em>You have not added anything to your cart!</em>
                            </div>
                        </div>
                    {/unless}
                    {#each cart}
                        {>cartItem}
                    {/each}
                </div>
                <div class="panel-footer">
                    <div class="row text-center">
                        <div class="col-xs-9">
                            <a href="?page=cart" class="btn btn-default btn-sm pull-left">
                                Reload Cart
                            </a>
                            <h4 class="text-right">Total <strong>&pound;{total}</strong></h4>
                        </div>
                        <div class="col-xs-3">
                            <a href="?page=checkout" class="btn btn-success btn-block">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        ';        
    }

?>