<?php

class UtilsGateway
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }
    
    public function getRoles(): array
    {
        $sql = "SELECT *
                FROM cmds_roles";
                
        $stmt = $this->conn->query($sql);
        
        $data = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
          
            $data[] = $row;
        }
        
        return $data;
    }
    
    public function getRoleById(string $id): array | false
    {
        $sql = "SELECT *
                FROM cmds_roles
                WHERE id = :id";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
       
        
        return $data;
    }
    
    public function getUserRolesByRoleId(string $roleId): array | false
    {
        $sql = "SELECT *
                FROM cmds_userRoles
                WHERE roleId = :roleId";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":roleId", $roleId, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
       
        
        return $data;
    }
    
    public function getUserRolesByRoleIdAndLocationId(string $roleId, string $locationId ): array | false
    {
        $sql = "SELECT *
                FROM cmds_userRoles
                WHERE roleId = :roleId 
                AND locationId = :locationId";
                
        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(":roleId", $roleId, PDO::PARAM_STR);
        $stmt->bindValue(":locationId", $locationId, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
       
        
        return $data;
    }
}











