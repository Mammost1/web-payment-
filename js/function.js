function checkregis() {
    var user = document.form1.username.value;
    var pass = document.form1.password.value;
    var repass = document.form1.re_password.value;
    var email = document.form1.email.value;
    var phone = document.form1.phone_number.value;
    function ErrorRegis1() {
        Swal.fire({
            icon: 'error',
            title: 'รหัสผิดพลาด',
            text: 'กรุณากรอกชื่อผู้ใช้ด้วย!!',
        })
    }
    function ErrorRegis2() {
        Swal.fire({
            icon: 'error',
            title: 'รหัสผิดพลาด',
            text: 'กรุณากรอกรหัสด้วย!!',
        })
    }
    function ErrorRegis3() {
        Swal.fire({
            icon: 'error',
            title: 'รหัสผิดพลาด',
            text: 'กรุณากรอกยืนยันรหัสผ่านด้วย!!',
        })
    }
    function ErrorRegis4() {
        Swal.fire({
            icon: 'error',
            title: 'รหัสผิดพลาด',
            text: 'กรุณากรอกเบอร์ด้วย!!',
        })
    }
    function ErrorRegis5() {
        Swal.fire({
            icon: 'error',
            title: 'รหัสผิดพลาด',
            text: 'กรุณากรอกอีเมล์ด้วย!!',
        })
    }
    function ErrorRegis6() {
        Swal.fire({
            icon: 'error',
            title: 'รหัสผิดพลาด',
            text: 'กรอกรหัสผ่านไม่ตรงกัน!!',
        })
    }
    function Regissuccess() {
        Swal.fire({
            icon: 'success',
            title: 'สมัครสำเร็จ!',
            showConfirmButton: false,
       

            timer: 1500
        })
    }
    
    if (user=="") {
        ErrorRegis1();
        document.form1.user.focus();
        return false;
       
    }
    if (pass == "") {

        ErrorRegis2();
        document.form1.pass.focus();
        return false;
    }
    if (repass == "") {
        ErrorRegis3();
        document.form1.repass.focus();
        return false;
    }
    if (phone == "") {
        ErrorRegis4();
        document.form1.phone.focus();
        return false;
    }
    if (email = "") {
        ErrorRegis5();
        document.form1.email.focus();
        return false;

    }
    if (pass != repass) {
        ErrorRegis6();
    }
    else {
        Regissuccess();
        

    }

}
function ErrorLogin() {
        alert("asdasdasd");
        Swal.fire({
            icon: 'error',
            title: 'รหัสผิดพลาด',
            text: 'กรุณากรอกไอดี/รหัสให้ถูกต้อง!!',
        })
    }

    function Loginsuccess() {
        Swal.fire({
            icon: 'success',
            title: 'ล็อกอินสำเร็จ!',
            showConfirmButton: false,
       

            timer: 1500
        })
    }
