<?php session_start();
include('condb.php');

$ID = $_SESSION['ID'];

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web</title>
    <link rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!--link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</head>

<body style="background-color:black;">

    <!--#####################################################################################################################-->

    <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
        <div class="container">
            <div style="margin-right: 30px;">


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto" style="width: 100%;">
                        <li class="nav-item">
                            <a class="nav-link active" href="http://localhost/d/index.html"><img src="https://img.icons8.com/color/2x/small-business.png" style="height: 48px; width: 48px;">
                                &nbsp;หน้าแรก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " href="https://drive.google.com/file/d/190hD5j8QvTNYCqXd6WEcnznph6nxQ95T/view?usp=sharing"><img src="https://img.icons8.com/color/2x/low-priority.png" style="height: 48px; width: 48px;">
                                &nbsp;ดาวน์โหลด</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " href="https://www.facebook.com/groups/WarZ11"><img src="https://img.icons8.com/color/2x/circus-tent.png" style="height: 48px; width: 48px;">
                                &nbsp; กลุ่ม</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " href="http://localhost/d/Register.html"><img src="https://img.icons8.com/color/2x/add-rule.png" style="height: 48px; width: 48px;">
                                &nbsp; สมัครสมาชิก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active " href="http://localhost/d/topup.html"><img src="https://img.icons8.com/color/2x/initiate-money-transfer.png" style="height: 48px; width: 48px;">
                                &nbsp; เติมเงิน</a>
                        </li>
                    </ul>

                </div>
            </div>
    </nav>

    <div class="card text-white bg-dark col-md-center" align="center" style="margin-bottom: 10px;">
        <div class="card-header" style="padding: 5px;">
            <b><i class="fa fa-signal"></i> STATUS WEBSITE</b>
        </div>
        <div class="card-body" align="center">
            <div style="font-size: 18px;"><i class="fa fa-gamepad"></i> Status website : <span class="text-success"><b>
                        <i class="fa fa-circle-o-notch fa-spin text-success"> </i> ออนไลน์ <i class="fa fa-check"></i>

            </div>
        </div>
    </div>
    <br>

    <form action="logout.php">
        <div class="col-md-center" style="margin-top: 10px;">
            <div class="col-md-center">
                <div class="card text-white bg-dark" style="margin-bottom: 10px;">
                    <div class="card-header" style="padding: 5px;" align="center">
                        <i class="fa fa-money"></i> TOPUP | เติมเงิน
                        <div class="card-body" style="padding: 5px;">
                            <b><i class="fa fa-users"></i> MEMBER INFO</b> <small>ข้อมูลสมาชิก</small>
                            <div class="card-body text-success" style="padding: 10px;">
                                <p><i class="fa fa-user text-danger"></i> Username : <?php echo $username; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="topup-form">
                            <input type="hidden" name="action" value="topup">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-group" align="center">
                                        <label for="tmnpassword"><i class="fa fa-barcode"></i> TrueMoney :</label>
                                        <input class="form-control " type="text" name="tmnpassword" id="tmnpassword" " placeholder=" รหัสบัตรเติมเงินทรูมันนี่ 14 หลัก" maxlength="14">
                                        <br>
                                        <a class="btn btn-success btn-block" style="margin-bottom: 0px;" onclick="alert('ระบบเติมเงินสำเร็จ')"><i class="fa fa-check hvr-icon"></i> เติมเงิน</a>

                                        <input type="submit" value="ออกจากระบบ" class="btn btn-danger text-white  " style="margin-bottom: 0px;">
                                    </div>

                                    <div class="card text-white bg-dark" align="center" style="margin-bottom: 10px;">
                                        <div class="card-body">
                                            หมายเหตุ : เมื่อทำการเติมเงินแล้ว Item,Exp,Dollar,Ticket จะเข้าในไอดีอัติโนมัติ

                                        </div>
                                    </div>




                        </form>


</body>

</html>