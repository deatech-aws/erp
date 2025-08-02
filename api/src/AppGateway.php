<?php

class AppGateway
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM cmds_users";
                
        $stmt = $this->conn->query($sql);
        
        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
          
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function create(array $data): string
    {
        $sql = "INSERT INTO cmds_users (staffid, title, Name,roleId,phoneno,emailId,status,passwords,locationId)
                VALUES (:staffid, :title, :Name,:roleId,:phoneno,:emailId,:status,:passwords,:locationId)";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":staffid", $data["staffid"], PDO::PARAM_STR);
        $stmt->bindValue(":title", $data["title"], PDO::PARAM_STR);
        $stmt->bindValue(":Name", $data["Name"], PDO::PARAM_STR);
        $stmt->bindValue(":roleId", $data["roleId"], PDO::PARAM_STR);
        $stmt->bindValue(":phoneno", $data["phoneno"], PDO::PARAM_STR);
        $stmt->bindValue(":emailId", $data["emailId"], PDO::PARAM_STR);
        $stmt->bindValue(":status", $data["status"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":passwords", $data["passwords"], PDO::PARAM_STR);
        $stmt->bindValue(":locationId", $data["locationId"], PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $this->conn->lastInsertId();
    }
    
    public function get(string $id): array | false
    {
        // $sql = "SELECT *
        //         FROM cmds_users
        //         WHERE id = :id";
        $sql ="SELECT vmatricno,concat(vlastname,' ',vothernames) AS vname,vfacultydesc,vprogaward,dateofbirth,cgender,p.ceductgid
                FROM students s INNER JOIN
                faculty f ON f.cfacultyid=s.cfacultyid inner join
                programme p ON p.cprogrammeid=s.cprogrammeid
                AND vmatricno =:id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
       
        var_dump($data);
        return $data;
    }
    
    public function update(array $current, array $new): int
    {
        $sql = "UPDATE cmds_users
                SET staffid = :staffid, title = :title, Name = :Name, roleId = :roleId,phoneno = :phoneno,emailId = :emailId, status= :status,passwords =:passwords,locationId = :locationId
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":staffid", $current["staffid"], PDO::PARAM_STR);
        $stmt->bindValue(":title", $current["title"], PDO::PARAM_STR);
        $stmt->bindValue(":Name", $current["Name"], PDO::PARAM_STR);
        $stmt->bindValue(":roleId", $current["roleId"], PDO::PARAM_STR);
        $stmt->bindValue(":phoneno", $current["phoneno"], PDO::PARAM_STR);
        $stmt->bindValue(":emailId", $current["emailId"], PDO::PARAM_STR);
        $stmt->bindValue(":status", $current["status"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":passwords", $current["passwords"], PDO::PARAM_STR);
        $stmt->bindValue(":locationId", $current["locationId"], PDO::PARAM_STR);
        
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    public function delete(string $id): int
    {
        $sql = "DELETE FROM cmds_users
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}











