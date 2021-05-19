<h2>Data Pelanggan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>no</td>
            <td>nama</td>
            <td>email</td>
            <td>telepon</td>
            <td>aksi</td>
        </tr>
    </thead>
    <tbody>
    <?php 
        $i = 1;
        $ambil = $connect->query("SELECT * FROM pelanggan");
        $ambil2 = $connect->query("SELECT * FROM chat");
        $id = [];
        $ids;
        while($tiap = $ambil2->fetch_assoc()){
            $id[] = $tiap['id_chat_user'];
            $ids = array_keys(array_count_values($id));
        } 
        ?>
        <?php while($pecah = $ambil->fetch_assoc()):
            
            ?>
        
        <tr>
            <td><?= $i++;?></td>
            <td><?= $pecah['nama_pelanggan'];?></td>
            <td><?= $pecah['email_pelanggan'];?></td>
            <td><?= $pecah['telepon_pelanggan'];?></td>
            <td>
                <a href="" class="btn-danger btn">hapus</a>
                <a href="" class="btn-warning btn">ubah</a>
                <?php foreach($ids as $key => $value):?>
                <?php if($value == $pecah['id_pelanggan']):?>
                <a href="chat.php?id=<?= $pecah['id_pelanggan'];?>" class="btn btn-primary">Chat Pelanggan </a>
                <?php endif;?>
                <?php endforeach;?>
                
            </td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>
<div class="ping">
    <a href="index.php?halaman=ping" class="btn btn-info">Ada pesan untuk admin!</a>
</div>