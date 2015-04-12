<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hanif
 * Date: 4/8/2015
 * Time: 11:35 PM
 */
session_start();
if(!(isset($_SESSION['login'])&& $_SESSION['login'] != '')){
    header ("Location: index.php");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clients</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script>
        $(document).ready(function()){
            $("success").hide();
            $("failure").hide();
        }
    </script>
</head>
<body ng-app="">
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">BusFi Admin </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    <?php
                    echo $_SESSION['fullname'];
                    ?>
                    <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="routes.php"><i class="fa fa-fw fa-table"></i> Routes</a>
                </li>
                <li>
                    <a href="home.php"><i class="fa fa-fw fa-table"></i> Advertisements</a>
                </li>
                <li>
                    <a href="categories.php"><i class="fa fa-fw fa-table"></i> Categories</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Clients
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> Clients
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12" ng-controller="clientsController">
                <h2>Clients</h2>
                <button type="button" class="btn btn-primary open-newClient" data-toggle="modal" data-target="#newClient">Add New Client</button>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Contact Number</th>
                            <th>E-mail Address</th>
                            <th>Number of Ads</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody ng-repeat="x in clients.clients">
                        <tr>
                            <td>{{x.name}}</td>
                            <td>{{x.contact_number}}</td>
                            <td>{{x.email}} </td>
                            <td>{{x.num_of_ads}} </td>
                            <td><a href="#">View Ads</a> </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <<!-- Modal -->
    <div class="modal fade" id="newClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create New Client</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Client Details</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="Client's Name" class="form-control" id="clientName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="Phone Number" class="form-control" id="clientNumber">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="textinput">E-mail</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="E-mail Address" class="form-control" id="clientEmail">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" onclick="createNewClient()">Save</button>
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>

                    <div class="alert alert-success hide" role="alert" id="success">Client added successfully!</div>
                    <div class="alert alert-danger hide" role="alert" id="failure">Unable to add client. Please try again.</div>

                </div>
                <!--                <div class="modal-footer">-->
                <!--                    <button type="button" class="btn btn-success" onclick="addNewRoute()">Save</button>-->
                <!--                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- AngularJS Script -->
    <script src="assets/scripts/angular.min.js"></script>

    <script>
        function createNewClient(){

            var clientName = encodeURI($("#clientName").val());
            var clientNumber = encodeURI($("#clientNumber").val());
            var clientEmail = encodeURI($("#clientEmail").val());
            var dataString = "clientName=" + clientName + "&clientNumber=" + clientNumber + "&clientEmail=" + clientEmail;

            $.ajax({
                type: "POST",
                url: "action/action_page.php?newclient",
                data: dataString,
                success: function(response){
                    $("#success").toggle(1000);
                    $("#myModalLabel").html(response);
                    setTimeout(function(){
                        $('newClient').modal('hide');
                    }, 3000);
                    location.reload();
                }
            });

        }

    </script>

    <script>
        function clientsController($scope, $http){
            $http.get("action/action_page.php?getclients").success(function(response) {$scope.clients = response;});
        }
    </script>
</body>
</html>