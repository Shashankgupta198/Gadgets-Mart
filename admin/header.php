<?php session_start(); 
require_once("checks.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="index.php">Gadgets Mart</a>

                <!-- Links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Homepage</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Category Operations
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addcategory.php">Add New Category</a>
                            <a class="dropdown-item" href="viewcategory.php">View Category Details</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Sub Category Operations
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addsubcategory.php">Add Sub Category </a>
                            <a class="dropdown-item" href="viewsubcategory.php">View Sub Category Details</a>
                        </div>
                    </li>
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Company Operations
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addcompany.php">Add Company</a>
                            <a class="dropdown-item" href="viewcompany.php">View Company Details</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Product Operations
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addproduct.php">Add Product</a>
                            <a class="dropdown-item" href="viewproduct.php">View Product Details</a>
                        </div>
                    </li>                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Product Photo Operations
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addphoto.php">Add Photo</a>
                            <a class="dropdown-item" href="viewphoto.php">View Photo Details</a>
                        </div>
                    </li>                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Order Info
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addorderinfo.php">Add Order Info</a>
                            <a class="dropdown-item" href="vieworderinfo.php">View Order Info</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Order Details
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addorderdetails.php">Add Order Details</a>
                            <a class="dropdown-item" href="vieworderdetails.php">View Order Details</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Cart Item
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addcartitem.php">Add Cart Item </a>
                            <a class="dropdown-item" href="viewcartitem.php">View Cart Item Details</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Cart Info
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="addcartinfo.php">Add Cart Info</a>
                            <a class="dropdown-item" href="viewcartinfo.php">View Cart Info </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            Profile
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="changepassword.php">Change Password</a>
                            <a class="dropdown-item" href="lastlogin.php">Last Login</a>
                            <a class="dropdown-item" href="signout.php">Sign Out</a>
                            
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">