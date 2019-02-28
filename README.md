# vienna1946

## Aim
This project is developed as a submission for the "ACDH virtual Open Data hackathon series 2019: Open Data Day Vienna hack". The given map data provided by the City of Vienna shows the damaged buildings in Vienna right after the end of WW2. However the map data source doesn't offer any other structured information (such as legends, layers, vectorized objects etc.) for interpreting and exploring the data. Thus in this project the aim is to develop and offer a web application where the 1946-map and today's map of Vienna can be easily comparared and the details about damaged buildings can be explored. In order to allow the annotation of the damaged buildings the app offers a REST API which collects the annotations in JSON format.

## Demonstration
### Exploration
![Exploration Showcase](https://raw.githubusercontent.com/asilcetin/vienna1946/master/images/demo1.gif)

### Annotation
![Annotation Showcase](https://raw.githubusercontent.com/asilcetin/vienna1946/master/images/demo2.gif)

## Installation
This web application can be easily run on a web server with PHP7. Please follow these basics steps:

- Make sure you have a web server running (e.g. MAMP) and it supports PHP7
- Clone the repository:
```
git clone https://github.com/asilcetin/vienna1946.git
```
- Make sure the web server has write permissions to the file vienna1946/annotations.json
- Run the application on your browser (path can be different depending on your settings):
```
http://localhost/dev/acdh/vienna1946/
```

## API
The application offers basic API service to read the data of the app. This can easily be extended to cover more complex queries.
Call to list all annotations:
```
https://asilcetin/projects/vienna1946/api.php/list/all
```
Call to list by ID:
```
https://asilcetin/projects/vienna1946/api.php/list/1
```

## Modifications
You can modify this app however you want to show different maps or different data sources:
* The map sources are defined at the start of the vienna1946/js/main.js file, which can be changed with other maps as well.
* Annotation data is defined in vienna1946/annotations.json file.
* CRUD functions are defined in vienna1946/functions.php
* CSS styles can be changed in vienna1946/css/style.css