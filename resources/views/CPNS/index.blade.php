<!DOCTYPE html>
<html lang="en-US" ng-app="CPNSRecords">
    <head>
        <title>CPNS</title>

        <!-- Load Bootstrap CSS -->
        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= asset('css/style.css') ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script>angular.module("CPNSRecords").constant("CSRF_TOKEN", '{{ csrf_token() }}');</script>
    </head>
    <body ng-controller="CPNSController">
        <div class="mycontainer">
            <div class="content" style="width:900px;height:100%">
                <h2>CPNS</h2>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No Telp.</th>
                                <th>Email</th>
                                <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Tambah CPNS Baru</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="cpns in cpnss">
                                <td><% cpns.nik %></td>
                                <td><% cpns.nama %></td>
                                <td><% cpns.alamat %></td>
                                <td><% cpns.no_telp %></td>
                                <td><% cpns.email%></td>
                                <td>
                                    <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', cpns.nik)">Edit</button>
                                    <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(cpns.nik)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End of Table-to-load-the-data Part -->
                    <!-- Modal (Pop up when detail button clicked) -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><% form_title %></h4>
                                </div>
                                <div class="modal-body">
                                    <% error %>
                                    <form name="frmCPNS" class="form-horizontal" novalidate="">
                                        <input id="_token" name="_token" type="hidden" value="<?php echo csrf_token(); ?>"
                                        ng-model="cpns._token">

                                        <div class="form-group error">
                                            <label for="nik" class="col-sm-3 control-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="nik" name="nik" placeholder="NIK" value="<% nik %>" 
                                                ng-model="cpns.nik" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.nik.$invalid && frmCPNS.nik.$touched">Field nik harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="nama" name="nama" placeholder="Nama" value="<% nama %>" 
                                                ng-model="cpns.nama" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.nama.$invalid && frmCPNS.nama.$touched">Field nama harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="alamat" name="alamat" placeholder="Alamat" value="<% alamat %>" 
                                                ng-model="cpns.alamat" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.alamat.$invalid && frmCPNS.alamat.$touched">Field alamat harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="no_telp" class="col-sm-3 control-label">No Telp.</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="no_telp" name="no_telp" placeholder="No Telp." value="<% no_telp %>" 
                                                ng-model="cpns.no_telp" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.no_telp.$invalid && frmCPNS.no_telp.$touched">Field no_telp harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="email" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="email" name="email" placeholder="Email" value="<% email %>" 
                                                ng-model="cpns.email" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.email.$invalid && frmCPNS.email.$touched">Field email harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="foto" class="col-sm-3 control-label">Foto</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="foto" name="foto" placeholder="Foto" value="<% foto %>" 
                                                ng-model="cpns.foto" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.foto.$invalid && frmCPNS.foto.$touched">Field foto harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="ipk" class="col-sm-3 control-label">IPK</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="ipk" name="ipk" placeholder="IPK" value="<% ipk %>" 
                                                ng-model="cpns.ipk" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.ipk.$invalid && frmCPNS.ipk.$touched">Field ipk harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="hasil_tes" class="col-sm-3 control-label">Hasil Tes</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="hasil_tes" name="hasil_tes" placeholder="Hasil Tes" value="<% hasil_tes %>" 
                                                ng-model="cpns.hasil_tes" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.hasil_tes.$invalid && frmCPNS.hasil_tes.$touched">Field hasil_tes harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="jurusan" class="col-sm-3 control-label">Jurusan</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="jurusan" name="jurusan" placeholder="Jurusan" value="<% jurusan %>" 
                                                ng-model="cpns.jurusan" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.jurusan.$invalid && frmCPNS.jurusan.$touched">Field jurusan harus diisi</span>
                                            </div>
                                        </div>

                                        <div class="form-group error">
                                            <label for="pendidikan" class="col-sm-3 control-label">Pendidikan</label>
                                            <div class="col-sm-9">
                                                <input required type="text" class="form-control has-error" id="pendidikan" name="pendidikan" placeholder="Pendidikan" value="<% pendidikan %>" 
                                                ng-model="cpns.pendidikan" ng-required="true">
                                                <span class="help-inline" 
                                                ng-show="frmCPNS.pendidikan.$invalid && frmCPNS.pendidikan.$touched">Field pendidikan harus diisi</span>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, nik, '{{ csrf_token() }}')" ng-disabled="frmCPNS.$invalid">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <% successMessage %>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="btn-ok" ng-click="ok()">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
        <script src="<?= asset('js/angular-route.min.js') ?>"></script>
        
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/cpns.js') ?>"></script>
    </body>
</html>