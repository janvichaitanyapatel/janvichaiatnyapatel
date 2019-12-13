<?php
    function sparqlQuery($query, $baseURL, $format="application/json") {
        
        try {
            $params=array(
                "default-graph" =>  "",
                "should-sponge" =>  "soft",
                "query" =>  $query,
                "debug" =>  "on",
                "timeout" =>  "",
                "format" =>  $format,
                "save" =>  "display",
                "fname" =>  ""
            );
    
            $querypart="?";	
            foreach($params as $name => $value) 
            {
                $querypart=$querypart . $name . '=' . urlencode($value) . "&";
            }
            
            $sparqlURL=$baseURL . $querypart;
            
            return json_decode(file_get_contents($sparqlURL), true);
        } catch (\Throwable $th) {
            echo $th;
        }
    };
    
?>