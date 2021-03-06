// VARIABLES =============================================
var fileImage;
var usernameTxt;
var passwordTxt;
var loginForm;

$(document).ready(function() {
    pathLink = window.location.pathname.split('/');
    mainPath = pathLink[pathLink.length-1];

    if (mainPath === 'login') {
        login();
    } else {
        loadData();
    }

    //load form
    $("#content-data").on("click", "#add-button", function(e){
        clearAlert();
        loadForm(e);
    });

    $("#content-data").on("click", "#edit-button", function(e){
        clearAlert();
        loadForm(e);
    });

    //button cancel
    $("#content-data").on("click", "#cancel-button", loadData);

    //save data 
    $("#content-data").on("submit", "#form", function(e) {
        e.preventDefault();
        var action = e.target.dataset.formStatus;
        var imageUrl = '';

        // console.log($(this).serialize())

        if (fileImage !== undefined && fileImage !== null) {
            imageUrl = uploadFileImage();
        }

        // action (<modul>_tambah/<modul>_edit) -> actions.php?action=<modul>_tambah
        $.ajax({
            url: 'actions.php?action='+action,
            type: 'post',
            data: $(this).serialize() + '&image_url='+imageUrl,
            success: function(data) {
                var message = data.split('#')[0];
                var alertStyle = data.split('#')[1];

                loadData();
                showAlert(message,alertStyle);
            }
        });
    });

    //delete data based on id
    $("#content-data").on("click", "#delete-button", function(e) {
        var id      = e.target.dataset.id;
        var action  = e.target.dataset.action;
        var token   = e.target.dataset.token;
        var confirmDelete = confirm("Delete data ID: " + id + "?");
        var urlAction = 'actions.php?action=' + action;

        if (confirmDelete) {
            $.ajax({
                url: urlAction,
                type: 'post',
                data: {
                    id: id,
                    token: token
                },
                success: function(data) {
                    var message = data.split('#')[0];
                    var alertStyle = data.split('#')[1];

                    loadData();
                    showAlert(message,alertStyle);
                }
            });
        }
    });

    // update profile
    $("#update-profile-form").submit(function(e){
        e.preventDefault();

        var username    = $("#username").val();
        if (!username.length) {
            showAlert("Username harus diisi!","danger");
            return false;
        }

        $.ajax({
            url: "actions.php?action=profile_update",
            type: "POST",
            data: $(this).serialize(),
            success: function(res) {
                var message = res.split('#')[0];
                var alertStyle = res.split('#')[1];

                showAlert(message,alertStyle);
            }
        });
    });

    // change password
    $("#change-password-form").submit(function(e){
        e.preventDefault();

        var oldPassword = $("#password_old").val();
        var newPassword = $("#password_new").val();
        var conPassword = $("#password_conf").val();

        if (oldPassword.length && newPassword.length && conPassword.length) {
            $.ajax({
                url: "actions.php?action=change_password",
                type: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    var message = res.split('#')[0];
                    var alertStyle = res.split('#')[1];

                    $("#password_old").blur();
                    $("#password_new").blur();
                    $("#password_conf").blur();

                    $("#password_old").val('');
                    $("#password_new").val('');
                    $("#password_conf").val('');

                    showAlert(message,alertStyle);
                    disabledButton(true,'update-pass-btn');
                }
            });
        } else {
            showAlert("Semua field wajib diisi!", "danger");
        }
    });

    $("#password_old").keyup(checkPasswordInput);
    $("#password_new").keyup(checkPasswordInput);
    $("#password_conf").keyup(checkPasswordInput);
});


// FUNCTIONS =============================================

function loadData() {
    var pathname    = window.location.href;
    var module      = pathname.split('m=')[1]?.split('&')[0];
    var moduleLink  = `module/${module}/data.php`;

    if (module !== undefined) {
        $.ajax({
            url: moduleLink,
            type: 'get',
            success: function(data) {
                $('#content-data').html(data);
            }
        });    
    }
}

function loadForm(e) {
    var id          = e.target.dataset.id;
    var pathname    = window.location.href;
    var module      = pathname.split('m=')[1]?.split('&')[0];
    var moduleLink  = `module/${module}/form.php`;

    var formAction  = (!id) ? 'tambah' : 'edit';
    var formStatus  = module + '_' + formAction;

    $.ajax({
        url: moduleLink,
        type: 'get',
        data: {
            id: id,
            form_status: formStatus,
            form_module: module,
            form_action: formAction
        },
        success: function(data) {
            $('#content-data').html(data);
            fileImage = document.getElementById('fileimage');
        }
    });
}

function checkPasswordInput(e){
    var oldPassword = $("#password_old").val();
    var newPassword = $("#password_new").val();
    var conPassword = $("#password_conf").val();

    if (oldPassword.length && newPassword.length && conPassword.length) {
        disabledButton(false, "update-pass-btn");
    } else {
        disabledButton(true, "update-pass-btn");
    }
}

function login() {
    usernameTxt = document.getElementById('username');
    passwordTxt = document.getElementById('password');
    loginForm   = document.getElementById('login-form');

    loginForm.addEventListener('submit', (e)=>{
        e.preventDefault();
        checkLoginCredentials();
    })
}

function checkLoginCredentials() {
    username = usernameTxt.value;
    password = passwordTxt.value;

    if (!username || !password){
        showAlert("Username dan password harus diisi!", "danger");
        disabledButton(false);
      
        if (!username) {
            usernameTxt.focus();
        } else if (!password) {
            passwordTxt.focus();
        }
        return false;
    }

    $.ajax({
        type	: "POST",
        url		: "actions.php?action=check_login",
        data	: "username="+username+
                  "&password="+password,
        success	: function(res){
                if (res == 'true'){
                    showAlert("Login berhasil!", "success");
                    window.location.href = "index";
                } else if (res == 'false') {
                    showAlert("Username atau password salah!", "danger");
                    disabledButton(false);
                    passwordTxt.value = "";
                    passwordTxt.focus();
                } else {
                    showAlert(res, "danger");
                    disabledButton(false);
                }
        }
    });
}

function generateNewFilename(extension){
    var result           = Date.now().toString();
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    for ( var i = 0; i < 30; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result+'.'+extension;
}

function uploadFileImage(){
    const fileupload = $('#fileimage').prop('files')[0];

    if (fileupload) {
        var filename = fileupload['name'].split('.');
        var newfilename = generateNewFilename(filename[filename.length-1]);
    
        if (newfilename && fileupload) {
            let formData = new FormData();
            formData.append('fileupload', fileupload);
            formData.append('newfilename', newfilename);
    
            $.ajax({
                type: 'POST',
                url: "actions.php?action=upload_image",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    alert(data);
                },
                error: function() {
                    alert("Failed to upload file");
                }
            });
        }
        return newfilename;
    }
    return '';    
}

function disabledButton(state, element='btn-login'){ //status (true:show / false:hide)
    var element = document.getElementById(element);

    if (state) {
        element.classList.add('disabled');
        element.setAttribute('disabled','true');
    } else {
        element.classList.remove('disabled');
        element.removeAttribute('disabled');
    }
}

function showAlert(message, style='info'){
    var alert = `<div class="alert alert-${style} alert-dismissible fade show" role="alert">
    ${message}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>`;
    $('.alert-container').html(alert);
}

function clearAlert(){
    $('.alert-container').empty();
}