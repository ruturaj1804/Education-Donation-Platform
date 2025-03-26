<?php 
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "db_donate"; // Ensure this is the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form values
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $institution = $_POST['institution'];
    $course = $_POST['course'];
    $marks = $_POST['marks'];
    $income = $_POST['income'];

    // Define the target directory for uploaded files
    $targetDir = "images/";

    // Initialize variables for file names
    $identityProof = $incomeCertificate = $residenceProof = $educationCertificate = $bankPassbook = $photo = "";

    // Function to handle file uploads
    function uploadFile($fileKey, $targetDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
            $fileName = basename($_FILES[$fileKey]['name']);
            $targetFilePath = $targetDir . $fileName;
            move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetFilePath);
            return $fileName;
        }
        return ""; // Return empty string if file is not uploaded
    }

    // Upload files
    $identityProof = uploadFile('identity_proof', $targetDir);
    $incomeCertificate = uploadFile('income_certificate', $targetDir);
    $residenceProof = uploadFile('residence_proof', $targetDir);
    $educationCertificate = uploadFile('education_certificate', $targetDir);
    $bankPassbook = uploadFile('bank_passbook', $targetDir);
    $photo = uploadFile('photo', $targetDir);

    // Ensure the correct table name
    $tableName = "reg_app_database"; // Change to your actual table name

    // Prepare the SQL query to insert data into the database
    $sql = "INSERT INTO reg_app_database (name, dob, email, phone, institution, course, marks, income, identity_proof, income_certificate, residence_proof, education_certificate, bank_passbook, photo) 
VALUES ('$name', '$dob', '$email', '$phone', '$institution', '$course', '$marks', '$income', '$identityProof', '$incomeCertificate', '$residenceProof', '$educationCertificate', '$bankPassbook', '$photo')";
    // Execute the query
    
 // Execute the query
 if ($conn->query($sql) === TRUE) {
    // Redirect to the thank you page after successful submission
    header("Location: thank.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
}
?>