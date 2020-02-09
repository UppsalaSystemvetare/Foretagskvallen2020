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

    // static public function change_rank($id, $rank){
    //     $connection = connect();
    //     $query = "UPDATE Users SET Rank = '$rank' WHERE ID = '$id'";
    //     $result = $connection->query($query);
    //     $connection = disconnect();
    // }

    //     static public function change_team($id, $team){
    //     $connection = connect();
    //     $query = "UPDATE Users SET Team = '$team' WHERE ID = '$id'";
    //     $result = $connection->query($query);
    //     $connection = disconnect();
    // }

    // static public function delete_user($id){
    //     $connection = connect();
    //     $query = "DELETE FROM Users WHERE ID = '$id'";
    //     $result = $connection->query($query);
    //     $connection = disconnect();

    //     return $result;
    // }

}
?>
