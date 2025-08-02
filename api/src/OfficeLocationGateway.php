<?php

class OfficeLocationGateway
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getAll($locationType): array
    {
        $sql = "SELECT *
                FROM cmds_officelocations";
                
        $stmt = $this->conn->query($sql);
        
        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
          
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function create(array $data): string
    {
        $sql = "INSERT INTO cmds_officelocations (locationCode, locationName, locationType)
                VALUES (:locationCode, :locationName, :locationType)";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":locationCode", $data["locationCode"], PDO::PARAM_STR);
        $stmt->bindValue(":locationName", $data["locationName"], PDO::PARAM_STR);
        $stmt->bindValue(":locationType", $data["locationType"], PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $this->conn->lastInsertId();
    }
    
    public function get(string $id): array | false
    {
        $sql = "SELECT *
                FROM cmds_officelocations
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
       
        
        return $data;
    }
    
    public function update(array $current, array $new): int
    {
        $sql = "UPDATE cmds_officelocations
                SET locationCode = :locationCode, locationName = :locationName, locationType = :locationType
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":locationCode", $current["locationCode"], PDO::PARAM_STR);
        $stmt->bindValue(":locationName", $current["locationName"], PDO::PARAM_STR);
        $stmt->bindValue(":locationType", $current["locationType"], PDO::PARAM_STR);
        
        $stmt->bindValue(":id", $current["id"], PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
    
    public function delete(string $id): int
    {
        $sql = "DELETE FROM cmds_officelocations
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }
}











