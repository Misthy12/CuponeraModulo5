<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Plugin/lib/fontawesome-free/css/all.min.css" rel="stylesheet" />  
    <link href="Plugin/lib/select2/css/select2.min.css" rel="stylesheet" />
    
    <link href="Plugin/AdminLTE/dist/css/adminlte.css" rel="stylesheet" />

    <link href="Plugin/css/bootstrap4-toggle.css" rel="stylesheet" />
    <link rel="stylesheet" href="Plugin/lib/sweetAlert2/sweetalert2.min.css">
    <link rel="stylesheet" href="Plugin/lib/animate.css/animate.css">
    <link href="Plugin/lib/fontawesome-free/css/fontawesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="Plugin/datatables/datatables/datatables.min.css" />
    <link href="Plugin/datatables/main.css" rel="stylesheet" />
    <title>Login</title>
</head>
<body>
<div class="login-box center">
    <div class="login-logo">
        <a><b>Admin</b> Cuponera</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Iniciar Sesión</p>
            <form asp-action="Login" method="post">
                <div asp-validation-summary="ModelOnly"></div>

                <div class="input-group mb-3">
                    <input asp-for="Username" type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <span asp-validation-for="Username" class="text-warning"></span>
                </div>
                <div class="input-group mb-3">
                    <input asp-for="Password" type="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input asp-for="RememberMe" type="checkbox" id="remember">
                            <label for="remember">
                                Recordarme
                            </label>
                            <span asp-validation-for="RememberMe" class="text-warning"></span>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<script src="~/lib/jquery/dist/jquery.min.js"></script>
    <script src="Plugin/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Plugin/AdminLTE/dist/js/adminlte.js"></script>
    <script src="Plugin/js/site.js"></script>
    <script src="Plugin/lib/datatables-bs4/js/jquery.dataTables.js"></script>
    <script src="Plugin/lib/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="~/js/bootstrap4-toggle.js"></script>
    <!-- Select2 -->
    <script src="Plugin/lib/select2/js/select2.full.js"></script>

    <!--DataTable-->
    <script src="Plugin/datatables/main.js"></script>
    <!-- datatables JS -->
    <script src="Plugin/datatables/datatables/datatables.min.js"></script>
    <!-- para usar botones en datatables JS -->
    <script src="Plugin/datatables/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="Plugin/datatables/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="Plugin/datatables/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="Plugin/datatables/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="Plugin/datatables/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    
    <script src="Plugin/lib/sweetAlert2/sweetalert2.all.min.js"></script>
</body>
</html>