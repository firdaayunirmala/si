<?php
// error_reporting(0);
session_start();
require '../config.php';

header('Content-Type: application/json');
$json = json_decode(file_get_contents('php://input'), true);

$query = "SELECT a.id, a.nim, a.nama, a.judul, e.nama_jurusan as kode_jurusan, b.name as pembimbing1, c.name as pembimbing2 FROM datata as a left join dosen as b on a.pembimbing1 = b.nik 
left join dosen as c on a.pembimbing2 = c.nik inner join jurusan as e on a.kode_jurusan = e.id";
$getData = mysqli_query($db, $query);

$rowCountTA = $getData->num_rows;
if ($rowCountTA != 0) {
    $arr_data = array();
    while ($data = $getData->fetch_assoc()) {
        $data['act'] = '';
        $data['act'] .= '<div class="button">';
        $data['act'] .= '<a class="btn btn-warning btn-sm editta" href=' . '../administrator/editdatata/' . $data['id'] . '>edit</a>';
        $data['act'] .= '<a class="btn btn-danger btn-sm hapusta" href=' . '../administrator/hapusdatata/' . $data['id'] . '>hapus</a>';
        $data['act'] .= '</div>';
        array_push($arr_data, $data);
    }
    echo json_encode(array('response_code' => '1', 'response_status' => 'data found', 'data' => $arr_data));

    mysqli_close($db);
} else {
    echo json_encode("data_not_found");
}
