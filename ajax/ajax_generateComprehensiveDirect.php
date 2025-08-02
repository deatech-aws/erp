<?php
session_start();
include "../inc/pdo_trans_connectdb.php";

if (isset($_POST['pidRef']) && isset($_POST['mcrRef'])) {
    $pid = $_POST['pidRef'];
    $mcr = $_POST['mcrRef'];

    $query = "SELECT r.vMatricNo, CONCAT(vLastName, ' ', vothernames) AS fullname, c.vCityName, TCC, TCE, CGPE, CGPE/TCC AS CGPA, s.cProgrammeId, p.idecredit, s.entrymode
              FROM students s 
              INNER JOIN cum_result_summary r ON r.vMatricNo = s.vMatricNo 
              INNER JOIN studycenter c ON c.cStudyCenterId = s.cStudyCenterId
              INNER JOIN programme p ON p.cprogrammeid = s.cprogrammeid
              WHERE s.cProgrammeId = :programmeid AND TCE = :tce AND s.entrymode = 'Direct' AND s.Gradstatus <> 'Graduated'";

    $stmt = $tcon->prepare($query);
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
    }

    $stmt->closeCursor();

    $tcon->beginTransaction();

    try {
        $query = "DELETE FROM tbl_details WHERE cProgrammeId = :programmeid";
        $stmt = $tcon->prepare($query);
        $stmt->bindParam(':programmeid', $pid, PDO::PARAM_STR, 4);
        $stmt->execute();

        for ($i = 0; $i < count($arrMatricNo); $i++) {
            $course = returns_reference($arrMatricNo[$i]);
            $name = addslashes($arrName[$i]);

            $minimumCredit = ($arrProg[$i] == 'Direct') ? 90 : $arrTCE[$i];

            $query = "INSERT INTO tbl_details(vMatricNo, Name, Center, TCC, TCE, CGPE, CGPA, cProgrammeId, courses)
                      VALUES(:matric, :name, :center, :tcc, :minimumCredit, :cgpe, :cgpa, :cprogrammeid, :course)";
            
            $stmt = $tcon->prepare($query);

            $stmt->bindValue(':matric', $arrMatricNo[$i], PDO::PARAM_STR);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':center', $arrCentre[$i], PDO::PARAM_STR);
            $stmt->bindValue(':tcc', $arrTCC[$i], PDO::PARAM_INT);
            $stmt->bindValue(':minimumCredit', $minimumCredit, PDO::PARAM_INT);
            $stmt->bindValue(':cgpe', $arrCGPE[$i], PDO::PARAM_INT);
            $stmt->bindValue(':cgpa', $arrCGPA[$i], PDO::PARAM_STR);
            $stmt->bindValue(':cprogrammeid', $arrProg[$i], PDO::PARAM_STR);
            $stmt->bindValue(':course', $course, PDO::PARAM_STR);

            $stmt->execute();
        }

        $tcon->commit();
        echo 1;
        exit;
    } catch (PDOException $e) {
        $tcon->rollBack();
        echo $e->getMessage();
    }
}
?>
