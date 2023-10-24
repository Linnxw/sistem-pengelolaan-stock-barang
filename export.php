<?php
require "cek.php";
require "function.php";
 $tambah = tambahstok();
 if($tambah === 200){
   header("Location:index.php");
 }
?>
<html>
<head>
  <title>Stock Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Stock Barang</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
                                <table id="mauexport">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama barang</th>
                                            <th>deskripsi</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                     <tbody>
               <?php 
                 $stock = mysqli_query($conn,"SELECT * FROM stock");
                 
                 $no= 1;
                 while($data = mysqli_fetch_assoc($stock)):
                       ?>
                       <?php
                       $idb = $data["idbarang"];
                       ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?php echo $data["namabarang"]?></td>
                       <td><?php echo $data["deskripsi"]?></td>
                      <td><?php echo $data["stock"]?></td>
                      </tr>

                      <?php $no++?>
                 <?php endwhile ?>
                     </tbody>

                                </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>