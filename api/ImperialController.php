<?php

use \Jacwright\RestServer\RestException;

class ImperialController
{
    const HOST = "localhost";
    const USER = "impbnsco_admin";
    const PWD = "3egR0HTB0QCvaqE";
    const DB = "impbnsco_admin";
    private static $conn;

    public function __construct()
    {
        self::$conn = new mysqli(self::HOST, self::USER, self::PWD, self::DB);
    }

    public function __destruct() {
        self::$conn = null;
    }

    /**
     * Logs in a user with the given username and password POSTed. Though true
     * REST doesn't believe in sessions, it is often desirable for an AJAX server.
     *
     * @url POST /login
     */
    public function login($data)
    {
        $result = "";
        $stmt = "";
        $password = md5($data->password);
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT * FROM users u WHERE u.email = ? and u.password = ?");
            $stmt->bind_param("ss", $data->email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        if ($result->num_rows != 0) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
        }
        else {
            return http_response_code(401);
        }
        $result->close();
        $stmt->close();
        self::$conn->close();
        return $row;
    }


    /**
     * Get all standings with month or/and region
     *
     * @url GET standings/$month
     * @url GET standings/$month/$region
     */
    public function region($month, $region = null)
    {
        $myArray = array();
        $stmt = "";
        if (self::$conn) {
            if (($month) && (!$region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$month."2016_standings s ORDER BY s.points DESC");
            }
            if (($month) && ($region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$month."2016_standings s WHERE s.region = ? ORDER BY s.points DESC");
                $stmt->bind_param("s", $region);
            }
        }
        $stmt->execute();
        $stmt->bind_result($id, $name, $class, $points, $profile, $region);
        while($stmt->fetch()) {
            $myArray[] = array('id'=> $id, 'name' => $name, 'class' => $class, 'points' => $points, 'profile' => $profile, 'region' => $region);
        }
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }


    /**
     * Get a single standing with the month and its id
     *
     * @url GET /standing/$month/$id
     */
    public function getStanding($month, $id)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("SELECT * FROM ".$month."2016_standings s WHERE s.id = ?");
            $stmt->bind_param("d", $id);
            $stmt->execute();
            $stmt->bind_result($id, $name, $class, $points, $profile, $region);
            while($stmt->fetch()) {
                $result = array('id'=> $id, 'name' => $name, 'class' => $class, 'points' => $points, 'profile' => $profile, 'region' => $region);
            }
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }


    /**
     * Add a new standing
     *
     * @url POST /standing/add
     */
    public function addStanding($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("INSERT INTO ".$data->month."2016_standings (id, name, class, points, profile, region) VALUES ('',?,?,?,?,?)");
            $stmt->bind_param("ssdss", $data->name, $data->class, $data->points, $data->profile, $data->region);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing
     *
     * @url POST /standing/edit
     */
    public function editStanding($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET name=?,class=?,points=?,profile=?,region=? WHERE id =?");
            $stmt->bind_param("ssdssd", $data->name, $data->class, $data->points, $data->profile, $data->region, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing name
     *
     * @url POST /standing/editName
     */
    public function editStandingName($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET name=? WHERE id =?");
            $stmt->bind_param("sd", $data->name, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing class
     *
     * @url POST /standing/editClass
     */
    public function editStandingClass($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET class=? WHERE id =?");
            $stmt->bind_param("sd", $data->class, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing points
     *
     * @url POST /standing/editPoints
     */
    public function editStandingPoints($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET points=? WHERE id =?");
            $stmt->bind_param("dd", $data->points, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing profile
     *
     * @url POST /standing/editProfile
     */
    public function editStandingProfile($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET profile=? WHERE id =?");
            $stmt->bind_param("sd", $data->profile, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Edit a standing region
     *
     * @url POST /standing/editRegion
     */
    public function editStandingRegion($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET region=? WHERE id =?");
            $stmt->bind_param("sd", $data->region, $data->id);
            $stmt->execute();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Throws an error
     *
     * @url GET /error
     */
    public function throwError() {
        throw new RestException(401, "Empty password not allowed");
    }
}