<?php 

    if(isset($_POST['simpan'])) {
        $kategori = $_POST['kategori'];

        $sql = "INSERT INTO tblKategori VALUES ('', '$kategori')";
        $tambah = mysqli_query($conn, $sql);

        if($tambah) {
            header("Location: index.php");
        }
    }

?>

<section>
    <form action="create.php" method="POST">
        <fieldset>
            <legend>Tambah Kategori</legend>

            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" id="kategori" required>
            <br>

            <input type="submit" value="Simpan" name="simpan">
        </fieldset>
    </form>
</section>

<?php 

?>