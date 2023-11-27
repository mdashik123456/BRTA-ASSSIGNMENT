function validateFormPHP() {
    // Get form inputs
    var name = document.getElementById('name').value;
    var nid = document.getElementById('nid').value;
    var email = document.getElementById('email').value;
    var vehicleNo = document.getElementById('vehicleNo').value;
    var chassisNo = document.getElementById('chassisNo').value;
    var presentAddress = document.getElementById('presentAddress').value;
    var permanentAddress = document.getElementById('permanentAddress').value;
    var photo = document.getElementById('profile_pic').value;
    var nidSoftCopy = document.getElementById('nidSoftCopy').value;

    // Simple validation example (you can add more complex validation)
    if (name === '' || nid === '' || email === '' || vehicleNo === '' || chassisNo === '' || presentAddress === '' || permanentAddress === '' || photo === '' || nidSoftCopy === '') {
        document.getElementById("form_submit").innerHTML = "<p style='color:red'>Please fill up the full form</p>";
    }
}