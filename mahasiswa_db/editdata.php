<?php
include('koneksi.php');

// Cek apakah parameter "edit" telah dikirimkan melalui URL
if (isset($_GET['edit'])) {
    $nimToEdit = $_GET['edit'];

    // Query untuk mengambil data mahasiswa berdasarkan NIM
    $query = "SELECT * FROM mahasiswa WHERE nim = '$nimToEdit'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Ambil data mahasiswa dari hasil query
        $mahasiswa = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    // Redirect ke halaman utama jika parameter "edit" tidak ada
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <style>
        /* Reset beberapa style default browser */
        body, h2, form {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
            padding: 20px 0;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Popup untuk menampilkan pesan sukses */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4caf50;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        /* Style untuk pesan sukses */
        .success-message {
            color: #fff;
            font-weight: bold;
        }

        /* Style untuk tombol close pada popup */
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            cursor: pointer;
        }

    </style>
</head>
<body>

<h2>Edit Data Mahasiswa</h2>

<form action="proses_edit.php" method="post" onsubmit="showSuccessPopup()">
    <input type="hidden" name="nim" value="<?php echo $mahasiswa['nim']; ?>">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" value="<?php echo $mahasiswa['nama']; ?>" required>

    <label for="nim">NIM:</label>
    <input type="text" name="nim" value="<?php echo $mahasiswa['nim']; ?>" required readonly>

    <label for="program_studi">Program Studi:</label>
    <input type="text" name="program_studi" value="<?php echo $mahasiswa['program_studi']; ?>" required>

    <button type="submit">Simpan Perubahan</button>
</form>

</body>
</html>
