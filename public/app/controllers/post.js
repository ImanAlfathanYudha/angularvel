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
    
    $scope.update = function (id) {
        console.log("tes update")
        var url = API_URL + "post/edit/";
        //append customer id to the URL if the form is in edit mode
        var params = {
            title : $('#title').val(),
            body :$('#body').val(),
        };
        console.log("tes params ",params);
        $http({
            method: "POST",
            url: url+id,
            params: params,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            console.log("tes update berhasil")
            console.log(response);
            window.location = '/post'
            alert('Berhasil merubah post.');
        }, function (error) {
            console.log("tes post gagal")
            console.log("tes error",error);
            alert('Tidak bisa merubah/menyimpan data.');
        });
    }


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
            alert('Tidak bisa menyimpan data.');
        });
    };

    //fetch post detail
    $scope.getPostDetail = function (id) {
        console.log("tes id ",id);
        $http.get(API_URL + 'post/'+id)
            .then(function (response) {
                console.log("tes response ",response);
                $scope.post = response.data.post;
        });
    };

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

   //save new Comment
    $scope.saveComment = function (id) {
        console.log("tes saveComment")
        var url = API_URL + "comment/create";
        var method = "POST";
        var params = {
            id_post : id,
            body :$('#body').val(),
        };
        console.log("tes params ",params);
         $http({
            method: method,
            url: url,
            params: params,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            console.log("tes save comment berhasil")
            console.log(response);
            window.location = '/post/view/'+id
        }, function (error) {
            console.log("tes save gagal")
            console.log("tes error",error);
            alert('Tidak bisa menyimpan data.');
        });
    }

    //fetch post detail
    $scope.getCommentsByPostID = function (id) {
        console.log("tes id ",id);
        $http.get(API_URL + 'comment/'+id)
            .then(function (response) {
                $scope.comments = response.data.comments;
                console.log("tes $scope.comments ",$scope.comments);
        });
    };

    $scope.deleteComment = function (id,id_post) {
        $http(
        {               
         method: 'GET',
         url: API_URL + 'comment/delete/' + id
        }
        ).then(function (response) {
            console.log("tes response ",response);
            alert('Komentar berhasil dihapus.');
            window.location = '/post/view/'+id_post
        }, function (error) {
            console.log("tes error ",error);
            alert('Tidak bisa menghapus komentar');
        });
    }

});