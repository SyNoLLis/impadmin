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
     * Returns a JSON string object to the browser when hitting the root of the domain
     *
     *
     * @url GET standings/$year
     * @url GET standings/$month/$year
     * @url GET standings/$year/$region
     * @url GET standings/$month/$year/$region
     */
    public function region($region = null, $month = null, $year)
    {
        $myArray = array();
        $stmt = "";
        if (self::$conn) {
            if (($month) && ($year) && ($region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$month.$year."_standings s WHERE s.region = ? ORDER BY s.points DESC");
                $stmt->bind_param("s", $region);
            }
            if ((!$month) && ($year) && ($region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$year."_standings s WHERE s.region = ? ORDER BY s.points DESC");
                $stmt->bind_param("s", $region);
            }
            if (($month) && ($year) && (!$region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$month.$year."_standings s ORDER BY s.points DESC");
            }
            if ((!$month) && ($year) && (!$region)) {
                $stmt = self::$conn->prepare("SELECT * FROM ".$year."_standings s ORDER BY s.points DESC");
            }
        }
        $stmt->execute();
        $results = $stmt->get_result();
        if ($results) {
            while($row = $results->fetch_array(MYSQLI_ASSOC)) {
                $myArray[] = $row;
            }
        }
        $results->close();
        $stmt->close();
        self::$conn->close();
        return $myArray;
    }

    /**
     * Logs in a user with the given username and password POSTed. Though true
     * REST doesn't believe in sessions, it is often desirable for an AJAX server.
     *
     * @url POST /login
     */
    public function login($data)
    {
        $row = "";
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
     * Add in a new standing
     *
     * @url POST /standings/add
     */
    public function addStanding($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("INSERT INTO ".$data->month."2016_standings (id, name, class, points, profile, region) VALUES ('',?,?,?,?,?)");
            $stmt->bind_param("ssdss", $data->name, $data->class, $data->points, $data->profile, $data->region);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        $stmt->close();
        self::$conn->close();
        return $result;
    }

    /**
     * Add in a new standing
     *
     * @url POST /standings/edit
     */
    public function editStanding($data)
    {
        $stmt = "";
        $result = "";
        if (self::$conn) {
            $stmt = self::$conn->prepare("UPDATE ".$data->month."2016_standings SET name=?,class=?,points=?,profile=?,region=? WHERE id =?");
            $stmt->bind_param("ssdssd", $data->name, $data->class, $data->points, $data->profile, $data->region, $data->id);
            $stmt->execute();
            $result = $stmt->get_result();
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