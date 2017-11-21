<?php /**
 *
 */
class Mindex extends CI_Model
{

  //fungsi untuk menampilkan data pada halaman index
  function mindexf($page, $limit)
  {
    //matematika untuk menentukan start
    $start           = ($page * $limit) - $limit;

    //query pertama untuk excetption terhadap menentukan limit jumlah data
    $query_row       = $this->db->select("*")->from("berita")->get()->num_rows();

    //variable nilai untuk cek kesalahan terhadap page atau limit
    $nilai           = $limit < 0 || $limit > 50 || $page < 1 || !is_numeric($limit) || !is_numeric($page) || $start > $query_row - 1 || $page > ceil($query_row / $limit);

    //cek jika terjadi kesalahan maka reset
    if ($nilai) {
      $page          = 1;
      $limit         = 10;
      $start         = 0;
    }

    //jalankan querynya untuk mengambil data dari database
    $query           = $this->db->select("*")->from("berita")->order_by("sorting", "desc")->limit($limit, $start)->get();

    //foreach untuk mendapatkan hasilnya
    foreach ($query->result() as $key) {
      $hasil["data"][]       = $key;
    }

    //gunakan fungsi paging untuk menentukan paging
    $jumlah_paging   = ceil($query_row / $limit);
    $hasil["paging"] = $this->paging($page, $limit, $jumlah_paging);

    //variable untuk mengetahui sedang berada di page mana
    $hasil["page"] = $page;

    //variabel untuk mengetahui jumlah data
    $hasil["jumlah_data"] = $query_row;

    //variabel untuk mengetahui jumlah limit
    $hasil["jumlah_limit"] = $limit;

    //variabel untuk mengetahui jumlah paging
    $hasil["jumlah_paging"] = $jumlah_paging;

    //return hasil yg sudah di dapat
    return $hasil;
  }

  //fungsi untuk mereturn link url paging dan jumlah paging beserta limit yang sudah di ambil di database
  function paging($page, $limit, $jumlah_paging){
    $link = array();
    //perulangan untuk menentukan link dan jumlah link
    for ($i=1; $i < $jumlah_paging; $i++) {
      $link[$i]        = "$i/$limit";
    }

    //return data link berupa array
    return $link;
  }

  //fungsi untuk menampilkan semua data
  function show($table, $column_order, $order_by, $start, $limit)
  {
    $sql = "select * from $table order by $column_order $order_by LIMIT $start,$limit";
    $query = $this->db->query($sql);

    return $query;
  }
}
 ?>
