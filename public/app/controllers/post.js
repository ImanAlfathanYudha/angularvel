app.controller('postController', function ($scope, $http, API_URL) {
    $scope.postInput = {
        name : "",
        email :"",
        contact_number :"",
    }

    //fetch post listing from 
    $scope.getAllPosts = function () {
        $http({ method: 'GET', url: API_URL + "post"}).then(function (response) {
                console.log("tes post ", response)
                $scope.posts = response.data.posts;
                console.log("tes $scope.posts ",$scope.posts);
        }, function (response) {
                console.log(response);
                alert('Ada error pada db. Tidak bisa load post.');
        });
    };

    //save new record and update existing record
    // $scope.save = function (modalstate, id) {

    // };

    // //delete record
    // $scope.confirmDelete = function (id) {
    
    // };
});