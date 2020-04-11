app.controller('customersController', function ($scope, $http, API_URL) {
    $scope.customer = {
        name : "",
        email :"",
        contact_number :"",
    }
    //fetch customers listing from 
    $scope.getAllCustomers = function () {
        $http({
        method: 'GET',
        url: API_URL + "customer"
             }).then(function (response) {
                $scope.customers = response.data.customers;
                console.log(response);

             }, function (response) {
                console.log(response);
                alert('Ada error pada db. Tidak bisa load customer.');
            });
    };

    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;
        $scope.customer = null;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Customer";
                break;
            case 'edit':
                $scope.form_title = "Customer Detail";
                $scope.id = id;
                $http.get(API_URL + 'customer/' + id)
                    .then(function (response) {
                        console.log(response);
                        $scope.customer = response.data.customer;
                    });
                break;
            default:
                break;
        }
        
        console.log(id);
        $('#myModal').modal('show');
    }

    //save new record and update existing record
    $scope.save = function (modalstate, id) {
        console.log("tes save")
        var url = API_URL + "customer/";
        var method = "POST";

        //append customer id to the URL if the form is in edit mode
        if (modalstate === 'edit') {
            url += "edit/" + id;
            method = "POST";
        } else {
             url += "create";
        }
        console.log("tes url ", url)
        $http({
            method: method,
            url: url,
            params: $scope.customer,
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
    }

    //delete record
    $scope.confirmDelete = function (id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'GET',
                url: API_URL + 'post/delete/' + id
            }).then(function (response) {
                console.log("tes response ",response);
                location.reload();
            }, function (error) {
                console.log("tes error ",error);
                alert('Tidak bisa menghapus customers');
            });
        } else {
             alert('Tidak bisa menghapus customers');
        }
    }
});