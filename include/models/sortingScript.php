<?php

//require "header.php";
/**
 * Implemented by: robinvanemden
 * 
 * A php implementation of the Hungarian algorithm for solving the assignment
 * problem. An instance of the assignment problem consists of a number of
 * workers along with a number of jobs and a cost matrix which gives the cost of
 * assigning the i'th worker to the j'th job at position (i, j). The goal is to
 * find an assignment of workers to jobs so that no job is assigned more than
 * one worker and so that no worker is assigned to more than one job in such a
 * manner so as to minimize the total cost of completing the jobs.
 * 
 * An assignment for a cost matrix that has more workers than jobs will
 * necessarily include unassigned workers, indicated by an assignment value of
 * -1; in no other circumstance will there be unassigned workers. Similarly, an
 * assignment for a cost matrix that has more jobs than workers will necessarily
 * include unassigned jobs; in no other circumstance will there be unassigned
 * jobs. For completeness, an assignment for a square cost matrix will give
 * exactly one unique worker to each job.
 *
 * Here 999999 takes the place of the PHP's predefined constant INF, as INF 
 * leads to faulty results
 * 
 * This version of the Hungarian algorithm runs in time O(n^3), where n is the
 * maximum among the number of workers and the number of jobs.
 * 
 */

/*
 * Construct an instance of the algorithm.
 * 
 * @param   $matrix
 * 
 *          the cost matrix, where matrix[i][j] holds the cost of assigning
 *          worker i to job j, for all i, j. The cost matrix must not be
 *          irregular in the sense that all rows must be the same length.
 * 
 */

$connection = connect();
$query = "SELECT user_ID, user_picks FROM user_picks";
$result = $connection->query($query);
$connection = disconnect();

// Ändra så att dessa kommer från admin sidan
$numberOfCompanies = 5; 
$numberOfPeople = 100;
$numberOfPeoplePerCompany = 2; 

$matrix = array();


while($row = mysqli_fetch_array($result)) {
    $picks = $row["user_picks"];
    $rad = array();

    for ($i = 0; $i < $numberOfCompanies; $i++) {    

        for ($i = 0; $i < $numberOfPeoplePerCompany; $i++) {
            $rad[] = substr($picks, $i, 1); 
        }
    }
    $matrix [] = $rad;
}

$indelning = custom_hungarian($matrix);
var_dump($indelning);

function custom_hungarian($matrix)
{
    $h = count($matrix);
    $w = count($matrix[0]);
    // If the input matrix isn't square, make it square
    // and fill the empty values with the INF, here 9999999
    if ($h < $w) {
        for ($i = $h; $i < $w; ++$i) {
            $matrix[$i] = array_fill(0, $w, 999999);
        }
    } elseif ($w < $h) {
        foreach ($matrix as &$row) {
            for ($i = $w; $i < $h; ++$i) {
                $row[$i] = 999999;
            }
        }
    }
    $h = $w = max($h, $w);
    $u   = array_fill(0, $h, 0);
    $v   = array_fill(0, $w, 0);
    $ind = array_fill(0, $w, -1);
    foreach (range(0, $h - 1) as $i) {
        $links   = array_fill(0, $w, -1);
        $mins    = array_fill(0, $w, 999999);
        $visited = array_fill(0, $w, false);
        $markedI = $i;
        $markedJ = -1;
        $j       = 0;
        while (true) {
            $j = -1;
            foreach (range(0, $h - 1) as $j1) {
                if (!$visited[$j1]) {
                    $cur = $matrix[$markedI][$j1] - $u[$markedI] - $v[$j1];
                    if ($cur < $mins[$j1]) {
                        $mins[$j1]  = $cur;
                        $links[$j1] = $markedJ;
                    }
                    if ($j == -1 || $mins[$j1] < $mins[$j]) {
                        $j = $j1;
                    }
                }
            }
            $delta = $mins[$j];
            foreach (range(0, $w - 1) as $j1) {
                if ($visited[$j1]) {
                    $u[$ind[$j1]] += $delta;
                    $v[$j1] -= $delta;
                } else {
                    $mins[$j1] -= $delta;
                }
            }
            $u[$i] += $delta;
            $visited[$j] = true;
            $markedJ = $j;
            $markedI = $ind[$j];
            if ($markedI == -1) {
                break;
            }
        }
        
        while (true) {
            if ($links[$j] != -1) {
                $ind[$j] = $ind[$links[$j]];
                $j       = $links[$j];
            } else {
                break;
            }
        }
        $ind[$j] = $i;
    }
    $result = array();
    foreach (range(0, $w - 1) as $j) {
        $result[$j] = $ind[$j];
    }
    return $result;
}

?>