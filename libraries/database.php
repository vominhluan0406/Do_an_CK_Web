<?php

/**
 * 
 */
class Database
{
    /**
     * Khai báo biến kết nối
     * @var [type]
     */
    public $link;

    public function __construct()
    {
        $this->link = mysqli_connect("localhost", "root", "", "web_xe_may") or die();
        mysqli_set_charset($this->link, "utf8");
    }

    // Insert
    public function insert($table, array $data)
    {
        $sql = "INSERT INTO {$table} ";
        $values  = "";
        foreach ($data as $field => $value) {
            if (is_string($value)) {
                $values .= "'" . mysqli_real_escape_string($this->link, $value) . "',";
            } else {
                $values .= mysqli_real_escape_string($this->link, $value) . ',';
            }
        }
        $values = substr($values, 0, -1);
        $sql .= " VALUES (" . $values . ')';

        return mysqli_query($this->link, $sql) ? 'Thanh cong' : 'Lỗi  query  insert ----' . mysqli_error($this->link);
    }

    // Update
    public function update($table, array $data, array $key, $id, $giatri)
    {
        $sql = "UPDATE {$table} SET ";
        $value  = "";
        for ($x = 0; $x < count($data); $x++) {
            $value .= "$key[$x]='$data[$x]'";
            if ($x < count($data) - 1)
                $value .= ',';
        }
        $sql .= $value . " WHERE $id='$giatri'";

        return mysqli_query($this->link, $sql) ? 'Thành công' : 'Lỗi  query  insert ----' . mysqli_error($this->link);
    }


    public function updateview($sql)
    {
        $result = mysqli_query($this->link, $sql)  or die("Lỗi update view " . mysqli_error($this->link));
        return mysqli_affected_rows($this->link);
    }

    //Đếm số hàng trong $table
    public function countTable($table, $id)
    {
        $sql = "SELECT $id FROM  {$table}";
        $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" . mysqli_error($this->link));
        $num = mysqli_num_rows($result);
        return $num;
    }

    //Tìm => return số hàng
    public function find($table, array $data, array $key)
    {
        $sql = "SELECT * FROM {$table} WHERE ";
        $value  = "";
        for ($x = 0; $x < count($data); $x++) {
            $value .= "$key[$x]='$data[$x]'";
            if ($x < count($data) - 1)
                $value .= ' AND ';
        }
        $sql .= $value;
        $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" . mysqli_error($this->link));
        $num = mysqli_num_rows($result);
        return $num;
    }

    // Delete
    public function delete($table, $id, $giatri)
    {
        $sql = "DELETE FROM {$table} WHERE $id = '$giatri'";
        mysqli_query($this->link, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($this->link));
        return mysqli_affected_rows($this->link);
    }

    /**
     * delete array 
     */

    public function deletewhere($table, $data = array())
    {
        foreach ($data as $id) {
            $sql = "DELETE FROM {$table} WHERE id = '$id' ";
            mysqli_query($this->link, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($this->link));
        }
        return true;
    }

    public function fetchsql($sql)
    {
        $result = mysqli_query($this->link, $sql) or die("Lỗi  truy vấn sql " . mysqli_error($this->link));
        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

    //select cot A tu table B where = C
    public function fetchIDOne($table, $cot, $id, $giatri)
    {
        $sql = "SELECT $cot FROM {$table} WHERE $id='$giatri'";
        $result = mysqli_query($this->link, $sql) or die("Lỗi  truy vấn fetchOne " . mysqli_error($this->link));
        return mysqli_fetch_assoc($result);
    }

    //Lấy phần tử cuối/đầu
    public function fetchOrder($table, $tanggiam, $id)
    {
        $sql = "SELECT * FROM $table ORDER BY $id $tanggiam LIMIT 0,1";
        $result = mysqli_query($this->link, $sql) or die("Lỗi  truy vấn fetchOne " . mysqli_error($this->link));
        return mysqli_fetch_assoc($result);
    }

    //Lấy danh sách mới nhất
    public function fetchNew($table, $tanggiam, $id,$soluong)
    {
        $sql = "SELECT * FROM $table ORDER BY $id $tanggiam LIMIT 0,$soluong";
        $result = mysqli_query($this->link, $sql) or die("Lỗi  truy vấn fetchOne " . mysqli_error($this->link));
        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

    public function fetchOne($table, $query)
    {
        $sql  = "SELECT * FROM {$table} WHERE ";
        $sql .= $query;
        $result = mysqli_query($this->link, $sql) or die("Lỗi  truy vấn fetchOne " . mysqli_error($this->link));
        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

    public function deletesql($table,  $sql)
    {
        $sql = "DELETE FROM {$table} WHERE " . $sql;
        // _debug($sql);die;
        mysqli_query($this->link, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($this->link));
        return mysqli_affected_rows($this->link);
    }

    public function fetchAll($table)
    {
        $sql = "SELECT * FROM {$table} WHERE 1";
        $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn fetchAll " . mysqli_error($this->link));
        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

    public  function fetchJones($table, $sql, $total = 1, $page, $row, $pagi = true)
    {

        $data = [];

        if ($pagi == true) {
            $sotrang = ceil($total / $row);
            $start = ($page - 1) * $row;
            $sql .= " LIMIT $start,$row ";
            $data = ["page" => $sotrang];

            $result = mysqli_query($this->link, $sql) or die("Lỗi truy vấn fetchJone ---- " . mysqli_error($this->link));
        } else {
            $result = mysqli_query($this->link, $sql) or die("Lỗi truy vấn fetchJone ---- " . mysqli_error($this->link));
        }

        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }

        return $data;
    }

    public  function fetchJoneDetail($table, $sql, $page = 0, $total, $pagi)
    {
        $result = mysqli_query($this->link, $sql) or die("Lỗi truy vấn fetchJone ---- " . mysqli_error($this->link));

        $sotrang = ceil($total / $pagi);
        $start = ($page - 1) * $pagi;
        $sql .= " LIMIT $start,$pagi";

        $result = mysqli_query($this->link, $sql);
        $data = [];
        $data = ["page" => $sotrang];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

    public function total($sql)
    {
        $result = mysqli_query($this->link, $sql);
        $tien = mysqli_fetch_assoc($result);
        return $tien;
    }

    //Lay gia tri 1 cot
    public function fetchCot($table,$cot){
    $sql = "SELECT $cot FROM {$table} WHERE 1";
        $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn fetchAll " . mysqli_error($this->link));
        $data = [];
        if ($result) {
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }
}
?>