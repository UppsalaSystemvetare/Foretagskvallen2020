<?php
    class Users{

    static public function get_users_on_foretag($foretag){
        $connection = connect();
        $query = "SELECT p.user_name, f.foretag_name 
                    FROM user_picks p
                    JOIN assigned_to_user a ON p.user_id = a.user_id
                    JOIN foretag f ON a.foretag_id = f.foretag_id
                    WHERE a.foretag_id = '$foretag'";
        $result = $connection->query($query);
        return $result;
    }

    static public function get_nr_of_users(){
        $connection = connect();
        $query = "SELECT * FROM user_picks";
        $result = $connection->query($query);
        return mysqli_num_rows($result);
    }
}
?>
