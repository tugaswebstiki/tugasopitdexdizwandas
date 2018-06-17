<?php 
 if($_POST['rowid']) {
        $id = $_POST['rowid'];
        // mengambil data berdasarkan id
        $sql = "SELECT * FROM barang WHERE id = $id";
        $result = $koneksi->query($sql);
        foreach ($result as $baris) { ?>
            <table class="table">
                <tr>
                    <td>Kode Barang</td>
                    <td>:</td>
                    <td><?php echo $baris['kode_barang']; ?></td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td><?php echo $baris['nama_barang']; ?></td>
                </tr>
                <tr>
                    <td>Deskripsi Barang</td>
                    <td>:</td>
                    <td><?php echo $baris['desc_barang']; ?></td>
                </tr>
            </table>
        <?php 
 
        }
    } 
    ?>