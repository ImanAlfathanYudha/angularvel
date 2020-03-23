app.controller('postController', function ($scope, $http, API_URL) {
    $scope.postInput = {
        title : "",
        body :"",
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
    $scope.save = function () {
        console.log("tes save")
        var url = API_URL + "post/create";
        var method = "POST";
         $http({
            method: method,
            url: url,
            params: $scope.postInput,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            console.log("tes save berhasil")
            console.log(response);
            location.reload();
        }, function (error) {
            console.log("tes save gagal")
            console.log("tes error",error);
            alert('Tidak bisa menghapus/menyimpan data.');
        });
    };

    // //delete record
    // $scope.confirmDelete = function (id) {
    
    // };
});