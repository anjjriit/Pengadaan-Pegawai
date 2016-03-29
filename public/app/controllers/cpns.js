

appCPNS.controller('CPNSController', function($scope, $location, $http, API_URL) {


    $http.get(API_URL + "getAll/")
    .success(function(response) {
        $scope.cpnss = response;
    });

    //show modal form
    $scope.toggle = function(modalstate, nik) {
        $scope.modalstate = modalstate;
        $scope.frmCPNS.$setUntouched();
        $scope.error = "";
        switch (modalstate) {
            case 'add':
                $scope.form_title = "Tambah CPNS baru";
                $scope.cpns = "";
                break;
            case 'edit':
                $scope.form_title = "Edit CPNS";
                $scope.nik = nik;
                $http.get(API_URL + 'get/' + nik)
                        .success(function(response) {
                            $scope.cpns = response;                            
                            $scope.cpns.jurusan = response.jurusan.nama;
                            $scope.cpns.pendidikan = response.pendidikan.tingkat;
                        });
                break;
            default:
                break;
        }
        $('#myModal').modal('show');
    }

    //save new record / update existing record
    $scope.save = function(modalstate, nik, csrf_token) {
        $.ajaxSetup({
            headers: {
                'X-XSRF-Token': csrf_token
            }
        });
        var url = API_URL;
        var data = $.param({
            '_token'            : csrf_token,
            'nik'               : $scope.cpns.nik,      
            'nama'              : $scope.cpns.nama,
            'alamat'            : $scope.cpns.alamat,
            'no_telp'           : $scope.cpns.no_telp,
            'email'             : $scope.cpns.no_telp,
            'foto'              : $scope.cpns.no_telp,
            'ipk'               : $scope.cpns.no_telp,
            'hasil_tes'         : $scope.cpns.no_telp,
            'jurusan'           : $scope.cpns.no_telp,
            'pendidikan_akhir'  : $scope.cpns.no_telp
        });

        if (modalstate === 'add'){
            url += "add/";
        } if (modalstate === 'edit'){
            url += "edit/" + nik;
        }
        alert(url);

        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.cpns),
            headers: {'Content-Type': 'application/x-www-form-urlencoded',}
        }).success(function(response) {
            alert(response);
            if(response == 1){
                $('#myModal').modal('hide');
                if (modalstate === 'edit'){
                    $scope.successMessage = "Data berhasil diupdate";
                } else {
                    $scope.successMessage = "Data berhasil disimpan";
                }
                $('#successModal').modal({
                    backdrop: 'static',
                    keyboard: false  // to prevent closing with Esc button (if you want this too)
                })
                $('#successModal').on('hidden.bs.modal', function () {
                    location.reload();
                })
                $('#successModal').modal('show');                
                //location.reload();
            } else {
                $scope.error = response;
            }
        }).error(function(response) {
            alert(response);
            console.log(response);
            alert('Error');
        });
    }

    $scope.ok = function() {
        location.reload();
    }

    //delete record
    $scope.confirmDelete = function(nik) {
        var isConfirmDelete = confirm('Apakah Anda yakin ingin menghapus record ini?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'delete/' + nik
            }).success(function(response) {
                if(response == 1){
                    location.reload();
                } else {
                    alert("Tidak dapat menghapus CPNS");
                }
            }).error(function(response) {
                console.log(response);
                alert('Error');
            });
        } else {
            return false;
        }
    }
});
