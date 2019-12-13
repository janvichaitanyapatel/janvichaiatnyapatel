<?php
    function sparqlQuery($query, $baseURL, $format="application/json") {
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
    };

    $company = $_GET['company_name'];
    
    $query = "prefix dbpedia-owl: <http://dbpedia.org/ontology/>

    select distinct ?company ?thumbnail ?description {
      ?company a dbpedia-owl:Company ;
           dbpedia-owl:abstract ?description ;
           rdfs:label '".$company."'@en ;
           foaf:depiction|dbpedia-owl:thumbnail ?thumbnail .
      filter( langMatches(lang(?description),'en') )
    }";
    $data = sparqlQuery($query, "http://dbpedia.org/sparql");
    echo json_encode($data);
?>