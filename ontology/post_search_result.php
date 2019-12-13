<?php
    require_once("sparql_queries.php");

    $company = $_GET['company_name'];
    $country = $_GET['country'];
    
    $query = "prefix dbpedia-owl: <http://dbpedia.org/ontology/> 
    
    select ?company ?thumbnail ?description {
     ?company a dbpedia-owl:Company;
     dbpedia-owl:abstract ?description;
     foaf:depiction|dbpedia-owl:thumbnail ?thumbnail
     filter( langMatches(lang(?description),'en') && regex(?company, \"".$company."\", 'i')) 
    }";

    echo($query);
    $data = sparqlQuery($query, "http://dbpedia.org/sparql");
    echo json_encode($data);
?>