<?php
class findClass extends DBController {
    public function showAll() {
        $stmt = $this->db->prepare("SELECT * FROM location WHERE useYN = 'Y'");
        if ($stmt->execute()) {
            $response = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
               $tmp = array();
               $tmp["mobID"] = $row["mobID"];
               $tmp["Latitude"] = $row["Latitude"];
               $tmp["Longitude"] = $row["Longitude"];
               array_push($response, $tmp);
           }
           $stmt->close();
           return $response;

        } else {
            return NULL;
        }
    }

    public function showClosest($number, $latitude, $longitude){
      $query = "SELECT *,(((acos(sin((".$latitude."*pi()/180)) * ".
      "sin((Latitude * pi()/180))+cos((".$latitude."*pi()/180)) * ".
      "cos((Latitude *pi()/180)) * cos(((".$longitude."- Longitude)* ".
      "pi()/180))))*180/pi())*60*1.1515 ".
      ") as distance ".
     "FROM location WHERE useYN = 'Y' ".
     "ORDER BY distance ASC LIMIT 0,$number ";
      $stmt = $this->db->prepare($query);
      if ($stmt->execute()) {
          $response = array();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) {
             $tmp = array();
             $tmp["mobID"] = $row["mobID"];
             $tmp["Latitude"] = $row["Latitude"];
             $tmp["Longitude"] = $row["Longitude"];
             array_push($response, $tmp);
         }
         $stmt->close();
         return $response;

      } else {
          return NULL;
      }
    }

}
?>
