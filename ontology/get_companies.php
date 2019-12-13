<?php
    require_once("sparql_queries.php");
    
    $query = "prefix dbpedia-owl: <http://dbpedia.org/ontology/> select ?company ?thumbnail ?description
    where {
      values ?hasThumbnail { foaf:depiction dbpedia-owl:thumbnail }
      ?company a dbpedia-owl:Company; dbpedia-owl:abstract ?description ;
           ?hasThumbnail ?thumbnail .
      filter( langMatches(lang(?description),'en') )
      
    } LIMIT 10";
    $data = sparqlQuery($query, "http://dbpedia.org/sparql");
    echo json_encode($data);
?>