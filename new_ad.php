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
    <title>New Ad</title>
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
                        Add New Advertisement
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-edit"></i> New Advertisement
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row" ng-controller="categoryController">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-8">

                    <form role="form" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <label>Ad Name</label>
                                <input class="form-control" id ="ad_name" placeholder="Ad Name" name="ad_name" type="text" required/>
                            </div>
                            <div class="form-group">
                                <label>Ad Description</label>
                                <input class="form-control" id ="ad_description" placeholder="Short Description" name="ad_description" type="text" required/>
                            </div>
                            <div class="form-group">
                                <label>Time Period</label>
                                <input class="form-control" id ="time_period" placeholder="Running Time" name="time_period" type="text" required/>
                            </div>
                            <div class="form-group" >
                                <label>Category</label>
                                <select class="form-control" id = "category">
                                    <option ng-repeat="cat in categories.categories | orderBy: 'category_name'" value="cat.category_id">
                                        {{cat.category_name}}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group" >
                                <label>Route</label>
                                <select class="form-control" id = "category">
                                    <option ng-repeat="route in routes.routes | orderBy: 'route_name'" value="route.route_id">
                                        {{route.route_name}}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group" >
                                <label>Client</label>
                                <select class="form-control" id = "category">
                                    <option ng-repeat="client in clients.clients | orderBy: 'name'" value="client.client_id">
                                        {{client.name}}
                                    </option>
                                </select>
                            </div>

                            <div class="form-group" >
                                <label>File Upload</label>
                                <input class="form-control" id = "file1" type="file"  name="file1" required/>
                                <input type="button" value="Upload File" onclick="uploadFile()"/>
                                <progress id ="progressBar" value="0" max="100" style="width: 300px;"></progress>
                                <h3 id="status"></h3>
                                <p id="loaded_n_total"></p>
                            </div>

                            <div align="center">
                                <button type="submit" class="btn btn-success" onclick= "save()" >Save</button>
                                <!-- <button type="reset" class="btn btn-warning">Reset</button> -->
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- AngularJS Script -->
    <script src="assets/scripts/angular.min.js"></script>

    <script>
        function _(el){
            return document.getElementById(el);
        }
        function uploadFile(){
            var file = _("file1").files[0];
            alert(file.name+ " | "+file.size+" | "+file.type);
            var formdata = new FormData();
            formdata.append("file1", file);
            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.open("POST", "action/file_upload_parser.php");
            ajax.send(formdata);
        }

        function progressHandler(event){
            _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
            var percent = (event.loaded / event.total) * 100;
            _("progressBar").value = Math.round(percent);
            _("status").innerHTML = Math.round(percent) +"% uploaded... please wait";
        }

        function completeHandler(event){
            _("status").innerHTML = event.target.responseText;
            _("progressBar").value = 0;
        }

        function errorHandler(event){
            _("status").innerHTML = "Upload Failed";
        }
        function abortHandler(event){
            _("status").innerHTML = "Upload Aborted";
        }
    </script>
    <script type="text/javascript">
        function save(){
            var course_name = encodeURI(document.getElementById("course_name").value);
            var course_number = encodeURI(document.getElementById("course_number").value);
            var num_teams = encodeURI(document.getElementById("number_of_teams").value);
            var fi_email = encodeURI(document.getElementById("fi_email").value);
            var semester = encodeURI(document.getElementById("semester").value);
            var year = encodeURI(document.getElementById("year").value);
            var description = encodeURI(document.getElementById("description").value);
            var num_teams = encodeURI(document.getElementById("number_of_teams").value);

            var url = "action_page.php?course&course_name="+course_name+"&course_number="+course_number+"&fi_email="+fi_email+"&semester="+semester+"&year="+year+"&description="+description+"&num_teams="+num_teams;
            //alert(url);
            syncAjax(url);
            window.location = "home.php";
        }

        function syncAjax(u){
            $.ajax({
                url: u,
                async: false,
                success: function (response) {
                    //alert(response);
                    window.location = "home.php";
                }

            });
        }

    </script>

    <script>
        function categoryController($scope, $http){
            $http.get("action/action_page.php?getcategories")
                .success(function(response) {
                    $scope.categories = response;
                });

            $http.get("action/action_page.php?getroutes")
                .success(function(response) {
                    $scope.routes = response;
                });

            $http.get("action/action_page.php?getclients")
                .success(function(response) {
                    $scope.clients = response;
                });
        }
    </script>
</body>
</html>

