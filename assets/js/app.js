$(document).ready(function(){
    // Page my_account.php -> affiche la zone input file
    $("#my_account_file_btn").click(function(){
        $("#my_account_file").show();
        $(this).hide();
    });

    $("#my_account_pwd_btn").click(function(){
        $("#my_account_pwd").show();
        $(this).hide();
    });
});