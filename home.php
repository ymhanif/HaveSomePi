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
    <title>Home-Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                    <a href="clients.php"><i class="fa fa-fw fa-table"></i> Clients</a>
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
                        Home
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="col-lg-12" ng-controller="coursesController">
                <h2>Ads</h2>
                <button type="button" class="btn btn-link"> <a href="new_ad.php">Add New Ad</a></button>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Ad Name</th>
                            <th>Number of Teams</th>
                            <th>Semester/Year</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody ng-repeat="x in courses.courses">
                        <tr>
                            <td>{{x.name}}</td>
                            <td>{{x.num_of_teams}} <a href="teams.php?courseid={{x.id}}&num_teams={{x.num_of_teams}}"> : Edit Teams</a></td>
                            <td>{{x.semester}} / {{x.year}}</td>
                            <td>
                                <a data-toggle="modal" data-id="{{x.id}}" data-course="{{x.name}}" class="open-NumQuestionsDialog" data-target="#numQuestionsDialog">Create Evaluation Form</a>
                            </td>
                            <td ng-if = "x.questionsset == '0'">
                                <a href="evaluationform.php?cid={{x.id}}"> Preview Questions</a>
                            </td>

                            <td>
                                <a href="action_page.php?delete_id={{x.id}}">Delete</a>
                            </td>
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
    <div class="modal fade" id="numQuestionsDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">How many questions do you plan on setting?</h4>
                </div>
                <div class="modal-body">
                    <p>Number of Questions:</p>
                    <input class="form-control" type="text" name="numQuestions" id="numQuestions" value=""/>
                    <input  name="courseId" id="courseId" value=""/>
                    <input  name="courseName" id="courseName" value=""/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="goToSetQuestions()">Go!</button>
                </div>
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
        $(document).on("click", ".open-NumQuestionsDialog", function(){
            var courseId = $(this).data('id');
            var courseName = $(this).data('course');
            $(".modal-body #courseId").val( courseId );
            $(".modal-body #courseName").val( courseName );
        });

        function goToSetQuestions(){
            var course_id = encodeURI(document.getElementById("courseId").value);
            var course_name = encodeURI(document.getElementById("courseName").value);
            var num_questions = encodeURI(document.getElementById("numQuestions").value);

            var url = "setquestions.php?num_questions="+num_questions+"&course_id="+course_id+"&course_name="+course_name;
            alert(url);

            window.location = url;

        }

    </script>

    <script>
        function coursesController($scope, $http){
            $http.get("action_page.php?getcour").success(function(response) {$scope.courses = response;});
        }
    </script>
</body>
</html>