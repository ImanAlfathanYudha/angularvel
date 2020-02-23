app.controller('customersController', function ($scope, $http, API_URL) {
    
    //fetch customers listing from 

    // $http({
    //     method: 'GET',
    //     url: API_URL + "customers"
    // }).then(function (response) {
    //     $scope.customers = response.data.customers;
    //     console.log(response);
    // }, function (error) {
    //     console.log(error);
    //     alert('This is embarassing. An error has occurred. Please check the log for details');
    // });

    //show modal form
    $scope.getAllCustomer  = function () {
        $http.get(API_URL +'customer').then(function (data) {
            console.log('tes data ',data)
             $scope.customer = data.customers
        })
    }

    // $scope.toggle = function (modalstate, id) {
    //     $scope.modalstate = modalstate;
    //     $scope.customer = null;

    //     switch (modalstate) {
    //         case 'add':
    //             $scope.form_title = "Add New Customer";
    //             break;
    //         case 'edit':
    //             $scope.form_title = "Customer Detail";
    //             $scope.id = id;
    //             $http.get(API_URL + 'customers/' + id)
    //                 .then(function (response) {
    //                     console.log(response);
    //                     $scope.customer = response.data.customer;
    //                 });
    //             break;
    //         default:
    //             break;
    //     }
        
    //     console.log(id);
    //     $('#myModal').modal('show');
    // }

    //save new record and update existing record
    $scope.save = function (modalstate, id) {
        var url = API_URL + "customers";
        var method = "POST";

        //append customer id to the URL if the form is in edit mode
        if (modalstate === 'edit') {
            url += "/" + id;

            method = "PUT";
        }

        $http({
            method: method,
            url: url,
            data: $.param($scope.customer),
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            console.log(response);
            location.reload();
        }), (function (error) {
            console.log(error);
            alert('This is embarassing. An error has occurred. Please check the log for details');
        });
    }

    //delete record
    $scope.confirmDelete = function (id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {

            $http({
                method: 'DELETE',
                url: API_URL + 'customers/' + id
            }).then(function (response) {
                console.log(response);
                location.reload();
            }, function (error) {
                console.log(error);
                alert('Unable to delete');
            });
        } else {
            return false;
        }
    }
});