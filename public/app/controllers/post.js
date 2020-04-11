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
        console.log("tes params ",$scope.postInput);
         $http({
            method: method,
            url: url,
            params: $scope.postInput,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            console.log("tes save berhasil")
            console.log(response);
            window.location = '/post'
        }, function (error) {
            console.log("tes save gagal")
            console.log("tes error",error);
            alert('Tidak bisa merubah/menyimpan data.');
        });
    };

    //fetch post detail
    $scope.getPostDetail = function (id) {
        // var id = $routeParams.id;
        console.log("tes id ",id);
        $http.get(API_URL + 'post/'+id)
            .then(function (response) {
                console.log("tes response ",response);
                $scope.post = response.data.post;
        });
    };

    // //delete record
    // $scope.confirmDelete = function (id) {
    
    // };
    $scope.confirmDelete = function (id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'GET',
                url: API_URL + 'post/delete/' + id
            }).then(function (response) {
                console.log("tes response ",response);
                window.location = '/post'
            }, function (error) {
                console.log("tes error ",error);
                alert('Tidak bisa menghapus customers');
            });
        } else {
             alert('Tidak jadi menghapus customers');
        }
    }

});