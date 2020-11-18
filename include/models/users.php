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

    static public function get_user_foretag_on_name($name){
        $connection = connect();
        $query = "SELECT user_id FROM user_picks WHERE user_name='$name'";
        $result = $connection->query($query);
        return $result;
    }
    
    static public function check_given_foretag($id){
        $connection = connect();
        $query = "SELECT f.foretag_name, f.foretag_location 
                    FROM user_picks p
                    JOIN assigned_to_user a ON p.user_id = a.user_id
                    JOIN foretag f ON a.foretag_id = f.foretag_id
                    WHERE a.user_id = '$id'";
        $result = $connection->query($query);
        return $result;
    }
}
?>
