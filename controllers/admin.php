<?php

namespace Halo;

use \MKR\Products;


class admin extends Controller
{
    public $template = 'admin';
    public $requires_auth = true;

    function index()
    {
        $this->products = Products::getAll();
        $this->product_types = Products::getAllProductTypes();

    }


    function ajax_addStock()
    {
        $id = $_POST['id'];
        q("UPDATE products SET product_qty = product_qty + 1 WHERE product_id = '$id'");

    }

    function ajax_rmvStock()
    {
        $id = $_POST['id'];
        q("UPDATE products SET product_qty = product_qty - 1 WHERE product_id = '$id' AND product_qty > 0");

    }

    function ajax_destroyStock()
    {
        $id = $_POST['id'];
        q("DELETE FROM products WHERE product_id = '$id'");

    }

    function ajax_createStock()
    {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $qty = $_POST["qty"];
        $description = $_POST["description"];
        $category = $_POST['category'];

        q("INSERT INTO products (product_name, product_type_id, product_details, product_price, product_qty)
VALUES ('$name', '$category', '$description', $price, $qty)");

    }

    function furniture()
    {
        $this->products = Products::get(Products::FURNITURE);
    }

    function woodturning()
    {
        $this->products = Products::get(Products::WOODTURNING);
    }

    function sketchbooks()
    {
        $this->products = Products::get(Products::SKETCHBOOKS);
    }

    function home()
    {

    }

    function about()
    {

    }

    function contact()
    {

    }

    function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
        exit();
    }

}