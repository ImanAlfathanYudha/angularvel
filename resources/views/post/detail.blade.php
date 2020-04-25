<!doctype html>
<html lang="en" ng-app="latihanRecords" ng-controller="postController">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">

        <title>Post Detail Laravel 6 Crud application Angular JS Tutorial</title>
    </head>
    <body>
        <div class="container">
            <header>
                <h2>Post</h2>
            </header>
            <a type="button" id="createPostButton" href="post/create"><i>Create Post</i></a>
            <div ng-init="getPostDetail({{$post_id}})">
                <table class="table">
                    <thead>
                        <tr>
                          <th>ID</th>
                            <th>Judul</th>
                            <th>Isi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>@{{post.id}}</td>
                            <td>@{{post.title}}</td>
                            <td>@{{post.body}}</td>
                        </tr>
                    </tbody>
                </table>
                <div ng-init="getCommentsByPostID({{$post_id}})">
                    <h2>Comments</h2>
                    <div ng-repeat="comment in comments">
                        <p><bold>@{{comment.body}}</bold></p>
                        <p>@{{comment.timestamp}} <button class="btn btn-danger btn-xs btn-delete"
                                    ng-click="deleteComment(comment.id, comment.id_post)">Delete</button></p>
                    </div>
                </div>   
                <div>
                 <h2>Write your comment here!</h2>   
                 <form name="frmcustomers" class="form-horizontal" novalidate="">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-12 control-label">Isi</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control has-error" id="body" name="body" placeholder="Write your comment.."required>
                                </div>
                        </div>
                 </form>
                    <button type="button" class="btn btn-primary" id="btn-save" ng-click="saveComment(post.id)">Save changes</button>
            </div> 
            </div>
            <!-- Modal -->
        </div>

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script
            src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
        <script
            src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-animate.min.js"></script>
        <script
            src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-route.min.js"></script>
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/post.js') ?>"></script>
    </body>
</html>