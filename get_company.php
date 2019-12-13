<?php
    require_once("sparql_queries.php");

    $company = trim( implode(' ', explode('_', $_GET['company_name'])));
    
    $query = "prefix dbpedia-owl: <http://dbpedia.org/ontology/>

    select distinct ?company ?thumbnail ?description {
      ?company a dbpedia-owl:Company ;
           dbpedia-owl:abstract ?description;
           rdfs:label '".$company."'@en;
           foaf:depiction|dbpedia-owl:thumbnail ?thumbnail.
      filter( langMatches(lang(?description),'en') )
    }";
    $data = sparqlQuery($query, "http://dbpedia.org/sparql");
    echo json_encode($data);
?>