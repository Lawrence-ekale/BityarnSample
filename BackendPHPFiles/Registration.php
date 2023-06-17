<?php
class Registration {
    private $conn;
    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($level) {
        
        if($level == '1') {
            $query = "SELECT country_id as id, country_name as name FROM countries";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else if ($level == '2') {
            $query = "SELECT county_id as id, county_name as name FROM counties";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else if($level == '3')
        {
            $query = "SELECT sub_county_id as id, sub_county_name as name FROM sub_counties";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else if($level == '4') {
            $query = "SELECT ward_id as id, ward_name as name FROM wards";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            $query = "SELECT location_id as id, location_name as name FROM locations";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getSubLevelAll($level,$id,$sub_level) {
        
        if($level == '1') {

            if($sub_level == '2') {//get all counties
                $query = "SELECT county_id as id, county_name as name FROM counties WHERE country_id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '3') {//get all subcounties
                $query = "SELECT sub_county_id as id, sub_county_name as name FROM sub_counties WHERE county_id IN ( SELECT county_id FROM counties WHERE country_id = ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else if($sub_level == '4') {//get all wards
                $query = "SELECT ward_id as id, ward_name as name FROM wards WHERE sub_county_id IN ( SELECT sub_county_id FROM sub_counties WHERE county_id IN ( SELECT county_id FROM counties WHERE country_id = ?))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '5') {//get all locations
                $query = "SELECT location_id as id, location_name as name FROM locations WHERE ward_id IN (SELECT ward_id FROM wards WHERE sub_county_id IN ( SELECT sub_county_id FROM sub_counties WHERE county_id IN ( SELECT county_id FROM counties WHERE country_id = ?)))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        } else if ($level == '2') {//from county level
            if($sub_level == '1') {//get the country
                $query = "SELECT country_id as id, country_name as name FROM countries WHERE country_id IN (SELECT country_id FROM counties WHERE county_id = ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '3') {//get all subcounties
                $query = "SELECT sub_county_id as id, sub_county_name as name FROM sub_counties WHERE county_id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else if($sub_level == '4') {//get all wards
                $query = "SELECT ward_id as id, ward_name as name FROM wards WHERE sub_county_id IN ( SELECT sub_county_id FROM sub_counties WHERE county_id = ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '5') {//get all locations
                $query = "SELECT location_id as id, location_name as name FROM locations WHERE ward_id IN (SELECT ward_id FROM wards WHERE sub_county_id IN ( SELECT sub_county_id FROM sub_counties WHERE county_id = ?))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        } else if ($level == '3') {//from sub_county level
            if($sub_level == '1') {//get the country
                $query = "SELECT country_id as id, country_name as name FROM countries WHERE country_id IN (SELECT country_id FROM counties WHERE county_id IN (SELECT county_id FROM sub_counties WHERE sub_county_id = ?))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '2') {//get all counties
                $query = "SELECT county_id as id, county_name as name FROM counties WHERE county_id IN (SELECT county_id FROM sub_counties WHERE sub_county_id = ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else if($sub_level == '4') {//get all wards
                $query = "SELECT ward_id as id, ward_name as name FROM wards WHERE sub_county_id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '5') {//get all locations
                $query = "SELECT location_id as id, location_name as name FROM locations WHERE ward_id IN (SELECT ward_id FROM wards WHERE sub_county_id = ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        } else if($level == '4')//from ward
        {
            if($sub_level == '1') {//get the country
                $query = "SELECT country_id as id, country_name as name FROM countries WHERE country_id IN (SELECT country_id FROM counties WHERE county_id IN ( SELECT county_id FROM sub_counties WHERE sub_county_id IN (SELECT sub_county_id FROM wards WHERE ward_id = ?)))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '2') {//get all counties
                $query = "SELECT county_id as id, county_name as name FROM counties WHERE county_id IN (SELECT county_id FROM sub_counties WHERE sub_county_id IN ( SELECT sub_county_id FROM wards WHERE ward_id = ? ))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else if($sub_level == '3') {//get all sub_counties
                $query = "SELECT sub_county_id as id, sub_county_name as name FROM sub_counties WHERE sub_county_id IN ( SELECT sub_county_id FROM wards WHERE ward_id = ? )";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '5') {//get all locations
                $query = "SELECT location_id as id, location_name as name FROM locations WHERE ward_id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }else
        {
            if($sub_level == '1') {//get the country
                $query = "SELECT country_id as id, country_name as name FROM countries WHERE country_id IN (SELECT country_id FROM counties WHERE county_id IN ( SELECT county_id FROM sub_counties WHERE sub_county_id IN (SELECT sub_county_id FROM wards WHERE ward_id IN (SELECT ward_id FROM locations WHERE location_id = ?))))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else if($sub_level == '2') {//get all counties
                $query = "SELECT county_id as id, county_name as name FROM counties WHERE county_id IN (SELECT county_id FROM sub_counties WHERE sub_county_id IN ( SELECT sub_county_id FROM wards WHERE ward_id IN (SELECT ward_id FROM locations WHERE location_id = ? )))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else if($sub_level == '4') {//get all sub_counties
                $query = "SELECT sub_county_id as id, sub_county_name as name FROM sub_counties WHERE sub_county_id IN ( SELECT sub_county_id FROM wards WHERE ward_id IN (SELECT ward_id FROM locations WHERE location_id = ? ))";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1,$id,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
    }

}


?>