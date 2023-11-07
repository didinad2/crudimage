<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>

<head>
  <title>CRUD Produk dengan gambar - Gilacoding</title>
  <style type="text/css">
  * {
    font-family: "Trebuchet MS";
  }

  h1 {
    text-transform: uppercase;
    color: salmon;
    text-align: center;
    /* Pusatkan judul h1 */
    font-size: 60px;
    /* Tambahkan ukuran font yang lebih besar */
    text-shadow: 6px 6px 6px rgba(0, 0, 0, 0.2);
    /* Tambahkan bayangan teks */
    margin-top: 50px;
    /* Tambahkan jarak atas */
  }

  table {
    border: solid 2px #DDEEEE;
    /* Perbesar batasan tabel */
    border-collapse: collapse;
    border-spacing: 0;
    width: 80%;
    /* Perbesar lebar tabel */
    margin: 40px auto;
    /* Perbesar jarak dari atas dan tengah */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* Tambahkan bayangan pada tabel */
  }

  table thead th {
    background-color: #336B6B;
    /* Ubah warna latar belakang kepala tabel */
    border: solid 1px #DDEEEE;
    color: #fff;
    /* Ubah warna teks menjadi putih */
    padding: 12px;
    /* Perbesar jarak isi sel kepala tabel */
    text-align: center;
    text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
  }

  table tbody td {
    border: solid 4px #DDEEEE;
    color: #333;
    padding: 10px;
    text-align: center;
    /* Pusatkan isi sel dalam tabel */
  }

  a {
    background-color: blue;
    color: #fff;
    padding: 20px;
    text-decoration: wavy;
    font-size: 20px;
    /* Perbesar ukuran font pada tautan */
    border-radius: 4px;
    /* Tambahkan sudut bulat pada tautan */
    transition: background-color 0.3s;
    /* Tambahkan efek transisi ketika tautan diklik */
  }

  a:hover {
    background-color: #ff6347;
    /* Ubah warna latar belakang saat tautan diarahkan */
  }
  </style>

</head>

<body>
  <center>
    <h1>Data Produk</h1>
    <center>
      <center>
        <br />
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Produk</th>
              <th>Dekripsi</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th>Gambar</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM produk ORDER BY id ASC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?> <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $row['nama_produk']; ?></td>
              <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
              <td>Rp <?php echo number_format($row['harga_beli'],0,',','.'); ?></td>
              <td>Rp <?php echo $row['harga_jual']; ?></td>
              <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>"
                  style="width: 120px;"></td>
              <td>
                <a href="edit_produk.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="proses_hapus_produk.php?id=<?php echo $row['id']; ?>"
                  onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
              </td>
            </tr>

            <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
          </tbody>
        </table>
        <center><a href="tambah_produk.php">+ &nbsp; Tambah Produk</a>
</body>

</html>