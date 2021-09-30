<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">    
    <title>Library Management System</title>
    <link href="<?=base_url('Assets/img/favicon.ico')?>" type="image/x-icon" rel="icon"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Required meta tags -->    
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Website Designing and Web Application Development">
    <meta name="author" content="Rashid Rafiq">
    <meta name="robots" content="index, follow">
    <!-- Bootstrap CSS -->
    <?= link_tag("Assets/bootstrap/css/bootstrap.min.css")?>
    <?= link_tag("Assets/bootstrap/css/sticky-footer.css")?>
    <script src="https://kit.fontawesome.com/0281032158.js" crossorigin="anonymous"></script>
    <style>
        input:disabled, select:disabled, {
            background: #ffffff !important;
        }
        .border-light-Blue {
            border: 1px solid #17a2b8 !important;
        }
        .text-brown{
            color: #f18024 !important;
        }
        .rounded-xl{
            border-radius: 1.1em;
        }
        .font-28{
            font-size: 1.75rem; /*approx 28px*/
        }
        .font-24{
            font-size: 1.5rem; /*approx 24px*/
        }
        .opacity-80{
            opacity: 0.85 !important;
        }
        .min-h-170{
            min-height: 170px !important;
        }
        .txtedit{
            display: none;
            width: 98%;
        }
        .bg-light-brown{
            background-color: #EBC85E !important;
        }
        .bg-light-blue{
            background-color: #5AB6DF !important;
        }
        .bg-light-green{
            background-color: #65CEA7 !important;
        }
        .alpha-Circle {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            padding: 7px;
            background: #EBC85E;
            color: #ffffff;
            text-align: center;
            font: 0.8em Arial, sans-serif;
        }
        .my-custom-scrollbar {
        position: relative;
        height: 20rem;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
    </style>
</head>
<body class="bg-light">
<?php $_SESSION['userLevel']= $userDetail->userLevel;?>
<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarsExample08"
            aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-brand text-light"><i class="fas fa-book-open"></i> Library Management System</span>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
        <ul class="navbar-nav">
            <li class="nav-item mr-1 mb-1">
                <a class="btn btn-light w-100" href="<?=base_url('Library/Dashboard')?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mr-1 mb-1">
                <a class="btn btn-light w-100" href="<?=base_url('Library/Members')?>">
                    <i class="fas fa-users"></i> Members
                </a>
            </li>
            <li class="nav-item mr-1 mb-1">
                <a class="btn btn-light w-100" href="<?=base_url('Library/Books')?>">
                    <i class="fas fa-book"></i>
                    <span class="text-right">Books</span>
                </a>
            </li>
            <li class="nav-item mr-1 mb-1">
                <a class="btn btn-light w-100" href="<?=base_url('Library/Reports')?>">
                    <i class="fas fa-poll"></i>
                    Reports
                </a>
            </li>
            <li class="nav-item dropdown pr-1">
                <a class="btn btn-light dropdown-toggle w-100" href="#" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-tools"></i> Settings
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item mt-1" href="<?=base_url('Library/Settings/category')?>">
                        <i class="fas fa-sitemap"></i> Categories
                    </a>
                    <a class="dropdown-item" href="<?=base_url('Library/Settings/language')?>">
                        <i class="fas fa-language"></i> Languages
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=base_url('Library/Settings/institute')?>">
                        <i class="fas fa-university"></i> Institute Details
                    </a>
                    <?php if (($userDetail->userLevel)>2) {?>
                        <a class="dropdown-item" href="<?=base_url('Library/Settings/users')?>">
                            <i class="fas fa-users"></i> Users List
                        </a>
                    <?php } ?>
                    <a class="dropdown-item" href="<?=base_url('Library/Settings/profile')?>">
                        <i class="fas fa-user-circle"></i> User Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?=base_url('Admin/logout')?>">
                        <i class="fas fa-user-lock"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <span class="navbar-brand text-light">Welcome,
        <?= $userDetail->userName;?>
        <span class="alpha-Circle"><?=strtoupper($userDetail->firstName[0].$userDetail->lastName[0]);?></span>
    </span>

</nav>
<div class="container-fluid">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-12">
            <?php if ($error=$this->session->flashdata('msg')) :?>
                <div class="w-75 ml-auto mr-auto mt-1">
                    <div class="alert alert-<?=$this->session->flashdata('alert')?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?= $error; ?>
                    </div>
                </div>
            <?php endif?>
        </div>
    </div>
    <div class="clearfix"></div>
