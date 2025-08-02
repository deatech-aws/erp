<?php
class Students{   
    
    private $studentsTable = "students";
    public $id;
    public $vname;
    public $student_id;
	public $faculty;
	public $program;
	public $dob;
	public $sex;
	public $eduCtg;
    public $created; 
	public $modified; 

	// Result holders

	public $code;
	public $title;
	public $unit;
	public $status;
	public $grade;
	public $remark;
	public $level;
    private $conn;

	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		// if($this->id!=="") {
		if($this->id) {	
		$sql ="SELECT vmatricno AS id,concat(vlastname,' ',vothernames) AS vname,vfacultydesc AS faculty,p.vprogaward AS program,dateofbirth AS dob,cgender AS sex,p.ceductgid AS eduCtg,f.cfacultyid,0 AS tcc,0 AS tce,0 AS wgp,0 AS cgpa,YEAR(CURDATE()) AS vyear,'Non-Graduate' AS specialization
				FROM students s INNER JOIN
				faculty f ON f.cfacultyid=s.cfacultyid inner join
				programme p ON p.cprogrammeid=s.cprogrammeid
				AND vmatricno ='".$this->id."'";	

        // 	AND vmatricno ='".$this->id."'";		
			$stmt = $this->conn->prepare($sql);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->studentsTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
    

    function read_archive(){	
		if(!empty($this->id)) {	
		$sql ="SELECT vmatricno AS id,vname,vfacultydesc AS faculty,vprogaward AS program,qualification as specialization,dateofbirth AS dob,cgender AS sex,ceductgid AS eduCtg,cfacultyid,tcc,tce,wgp,cgpa,vyear,cstudycentreid,studycentre,cprogrammeid
			FROM graduates_all
			WHERE vmatricno ='".$this->id."'";		
			$stmt = $this->conn->prepare($sql);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}

    

	function result(){	
		if($this->id) {
		$sql="SELECT r.coursecode AS code,coursetitle AS title,grade,r.creditunit AS unit,points,gpoints,
			CASE  
			WHEN grade='A' THEN 'Excellent'
			WHEN grade='B' THEN 'Very Good'
			WHEN grade='C' THEN 'Good' 
			WHEN grade='D' THEN 'Fair' 
			WHEN grade='E' THEN 'Pass' 
			ELSE 'Fail' END AS remark, batchno,substr(r.coursecode,4,1)*100 AS level
			FROM releasedresults r inner join
			availablecourse a ON a.coursecode = r.coursecode  AND vmatricno = ?
			ORDER BY substr(r.coursecode,4,1)";

	$sql="SELECT r.coursecode AS code,r.coursetitle AS title,grade,r.creditunits AS unit,points,gpoints,
			CASE  
			WHEN grade='A' THEN 'Excellent'
			WHEN grade='B' THEN 'Very Good'
			WHEN grade='C' THEN 'Good' 
			WHEN grade='D' THEN 'Fair' 
			WHEN grade='E' THEN 'Pass' 
			ELSE 'Fail' END AS remark, batchno,substr(r.coursecode,4,1)*100 AS level
			FROM releasedresults r 
            WHERE vmatricno ='$this->id'
			ORDER BY substr(r.coursecode,4,1)";
			$stmt = $this->conn->prepare($sql);
		$stmt->execute();			
		$result = $stmt->get_result();	
		//return $this->id;	
		 return $result;		
		}		
		
	}

	function credit(){	
		if($this->id) {
			$sql="SELECT r.coursecode AS code,r.coursetitle AS title,grade,r.creditunits AS unit,points,gpoints,
					CASE  
					WHEN grade='A' THEN 'Excellent'
					WHEN grade='B' THEN 'Very Good'
					WHEN grade='C' THEN 'Good' 
					WHEN grade='D' THEN 'Fair' 
					WHEN grade='E' THEN 'Pass' 
					ELSE 'Fail' END AS remark, batchno,substr(r.coursecode,4,1)*100 AS level
					FROM releasedresults r 
					WHERE vmatricno ='$this->id'
					ORDER BY substr(r.coursecode,4,1)";

			$sql="SELECT r.coursecode AS code,coursetitle AS title,grade,r.creditunit AS unit,points,gpoints,
					CASE  
					WHEN grade='A' THEN 'Excellent'
					WHEN grade='B' THEN 'Very Good'
					WHEN grade='C' THEN 'Good' 
					WHEN grade='D' THEN 'Fair' 
					WHEN grade='E' THEN 'Pass' 
					ELSE 'Fail' END AS remark, batchno,substr(r.coursecode,4,1)*100 AS level
					FROM releasedresults r inner join
					availablecourse a ON a.coursecode = r.coursecode  AND vmatricno ='$this->id'
					ORDER BY substr(r.coursecode,4,1)";
			
		$stmt = $this->conn->prepare($sql);		
		$stmt->execute();			
		$result = $stmt->get_result();			
		 return $result;		
		}		
		
	}
	
	
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->studentsTable."(`name`, `student_id`, `created`)
			VALUES(?,?,?)");
		
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->student_id = htmlspecialchars(strip_tags($this->student_id));
		$this->created = htmlspecialchars(strip_tags($this->created));
		
		
		$stmt->bind_param("sis", $this->name,  $this->student_id, $this->created);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->studentsTable." 
			SET name= ?, student_id = ?,  created = ?
			WHERE id = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->student_id = htmlspecialchars(strip_tags($this->student_id));
		$this->created = htmlspecialchars(strip_tags($this->created));
	 
		$stmt->bind_param("sisi", $this->name, $this->student_id,  $this->created, $this->id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->studentsTable." 
			WHERE id = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$stmt->bind_param("i", $this->id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>