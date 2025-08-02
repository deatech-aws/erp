<?php
$cref = "";

function returns_reference($mref)
{
    include "../inc/pdo_rec_connectdb.php";
    $squery = "SET SESSION group_concat_max_len = 1000000";
    $stmt = $rec_conn->prepare($squery, $pdo_attr);
    //$stmt->bindParam(':matric', $mref, PDO::PARAM_STR, 4);
    $stmt->execute();

   $squery = "SELECT vMatricNo, GROUP_CONCAT(CONCAT(Coursecode,'[',Grade,']') SEPARATOR ',') AS Courses
			FROM releasedresults
			WHERE vMatricNo =:matric and grade in('A','B','C','D','E','F')";
    $stmt = $rec_conn->prepare($squery, $pdo_attr);
    $stmt->bindParam(':matric', $mref, PDO::PARAM_STR, 4);
    $stmt->execute();
    while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        $cref = "";
        $cref = $rw[1];
    }
    $stmt->closeCursor();
    $rec_conn = null;
    return $cref;
}

session_start();
date_default_timezone_set('Africa/Lagos');
$ddate = date('Y-m-d');
include "../inc/pdo_connectdb.php";
$pid = $_POST['pidRef'];
$mcr = $_POST['mcrRef'];

$squery = "SELECT r.vMatricNo,
				FROM students s INNER JOIN
				released_summary r ON r.vMatricNo = s.vMatricNo INNER JOIN
				StudyCenter c ON c.cStudyCenterId = s.cStudyCenterId
				AND s.cProgrammeId =:programmeid  AND TCE>=:tce";

$squery = "SELECT r.vMatricNo,CONCAT(vLastName,' ',vothernames) AS fullname,c.vCityName,TCC,TCE,CGPE,CGPA,s.cProgrammeId, PCourses, FCourses
      FROM students s INNER JOIN
      released_summary r ON r.vMatricNo = s.vMatricNo INNER JOIN
      StudyCenter c ON c.cStudyCenterId = s.cStudyCenterId
      AND s.cProgrammeId =:programmeid AND TCE>=:tce AND s.Gradstatus <>'Graduated'";

$squery = "SELECT r.vMatricNo, CONCAT(vLastName,' ',vothernames) AS fullname, c.vCityName, TCC, TCE, CGPE, CGPE/TCC AS CGPA, s.cProgrammeId, p.idecredit, s.entrymode
              FROM students s 
              INNER JOIN cum_result_summary r ON r.vMatricNo = s.vMatricNo 
              INNER JOIN studycenter c ON c.cStudyCenterId = s.cStudyCenterId
              INNER JOIN programme p ON p.cprogrammeid = s.cprogrammeid
              WHERE s.cProgrammeId = :programmeid AND TCE >= :tce AND s.Gradstatus <> 'Graduated'";

$stmt = $conn->prepare($squery, $pdo_attr);
$stmt->bindParam(':programmeid', $pid, PDO::PARAM_STR, 4);
$stmt->bindParam(':tce', $mcr, PDO::PARAM_INT, 4);
$stmt->execute();

$arrMatricNo = array();
$arrName = array();
$arrCentre = array();
$arrTCC = array();
$arrTCE = array();
$arrCGPE = array();
$arrCGPA = array();
$arrProg = array();

while ($rw = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
    $arrMatricNo[] = $rw[0];
    $arrName[] = $rw[1];
    $arrCentre[] = $rw[2];
    $arrTCC[] = $rw[3];
    $arrTCE[] = $rw[4];
    $arrCGPE[] = $rw[5];
    $arrCGPA[] = $rw[6];
    $arrProg[] = $rw[7];
    $cprogrammeid = $rw[7];
}

$stmt->closeCursor();
$conn = null;
$configfile = "../inc/pdo_trans_connectdb.php";
require $configfile;
$tcon->beginTransaction();
$query = "";

try {
    $query = "DELETE FROM tbl_details WHERE cProgrammeId = '" . $pid . "'";
    $stmt = $tcon->exec($query);

    for ($i = 0; $i < count($arrMatricNo); $i++) {
        $course = returns_reference($arrMatricNo[$i]);
        $name = addslashes($arrName[$i]);

        // Check entrymode and use 90 for Direct entry students
        $minimumCredit = ($arrProg[$i] == 'Direct') ? 90 : $arrTCE[$i];

        $query = "INSERT INTO tbl_details(vMatricNo, Name, Center, TCC, TCE, CGPE, CGPA, cProgrammeId, courses)
              VALUES('" . $arrMatricNo[$i] . "', '" . $name . "', '" . $arrCentre[$i] . "', " . $arrTCC[$i] . ", " . $minimumCredit . ", " . $arrCGPE[$i] . ", " . $arrCGPA[$i] . ", '" . $arrProg[$i] . "', '" . $course . "')";
        $stmt = $tcon->exec($query);
    }

    // Delete records from tbl_details where tce < 120 and entrymode = 'open'
    $deleteNonDirectEntry = "DELETE FROM tbl_details 
                        WHERE vMatricNo IN (
                            SELECT vMatricNo 
                            FROM students 
                            WHERE entrymode = 'open' 
                                AND TCE < (SELECT imincredits FROM programme WHERE cProgrammeId = '" . $pid . "')
                                AND cProgrammeId = '" . $pid . "')";
$stmt = $tcon->exec($deleteNonDirectEntry);

    $tcon->commit();
    echo 1;
    exit;
} catch (PDOException $e) {
    $tcon->rollBack();
    echo $e->getMessage();
}
?>
