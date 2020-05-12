<?php

	global $db, $page;

	$total = 0;

    $cart = $db->selectAll("
        SELECT *, 
            (CA_ans = 1) as 'ans1',
            (CA_ans = 2) as 'ans2',
            (CA_ans = 3) as 'ans3'
        FROM cart
        INNER JOIN competitions ON (CA_comp = C_id)
        WHERE CA_id = :id AND CA_qty > 0
    ", array(
        ":id" => $_SESSION["cartID"]
    ));

    foreach ($cart as $value) {
        $total += ($value["C_cost"] * $value["CA_qty"]);
    }

    $page->addToTemplate("cartQty", count($cart));
    $page->addToTemplate("cartTotal", number_format($total, 2));
