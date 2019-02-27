# vienna1946

## Aim
This project is developed as a submission for the "ACDH virtual Open Data hackathon series 2019: Open Data Day Vienna hack". The given map data provided by the City of Vienna shows the damaged buildings in Vienna right after the end of WW2. However the map data source doesn't offer any other structured information (such as legends, layers, vectorized objects etc.) for interpreting and exploring the data. Thus in this project the aim is to develop and offer a web application where the 1946-map and today's map of Vienna can be easily comparared and the details about damaged buildings can be explored. In order to allow the annotation of the damaged buildings the app offers a REST API which collects the annotations in JSON format.

## Installation
This web application can be easily run on a web server with PHP7. The map sources are defined at the start of the js/main.js file, which can be changed with other maps as well.
