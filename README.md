# REST-webbtjänster med PHP
### DT173G Moment 5
---
Detta är femte uppgiften i kursen [Webbutveckling III](https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=18690) på mittuniversitet HT -20.

Uppgiften går ut på att skapa en REST-webbtjänst med php och sedan skapa en klient som konsumerar webbtjänsten med full CRUD-möjlighet.
REST-webbtjänsten innehåller de kurser jag läst hittills på Mittuniversitetet och lagras i MariaDB-databas. Php-koden är objektsorienterad med klasser för att ansluta till databasen samt för att hantera kurserna.

För att använda REST-webbtjänsten går det att göra följande anrop
* GET    - https://webicon.se/tweug/dt173g/moment5/rest/index.php
* GET    - https://webicon.se/tweug/dt173g/moment5/rest/index.php?id=1
* POST   - https://webicon.se/tweug/dt173g/moment5/rest/index.php {"code":"DT057G", "name":"Webbutveckling I", "progression":"A", "link":"https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782"}
* PUT    - https://webicon.se/tweug/dt173g/moment5/rest/index.php?id=1 {"code":"DT057G", "name":"Webbutveckling I", "progression":"A", "link":"https://www.miun.se/utbildning/kursplaner-och-utbildningsplaner/Sok-kursplan/kursplan/?kursplanid=22782"}
* DELETE - https://webicon.se/tweug/dt173g/moment5/rest/index.php?id=1

Webbapplikationen går att testa på [https://webicon.se/tweug/dt173g/moment5/client](https://webicon.se/tweug/dt173g/moment5/client).