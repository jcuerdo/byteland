Byteland
========================

Byteland needs a revolutionary application for managing lunches in their offices

Byteland has a lot of restaurants and we want to offer our team the option to 
choose the restaurant to eat each day from a list of restaurants that we will define.


API Methods
========================

GET http://192.168.100.101/byteland/web/person
GET http://192.168.100.101/byteland/web/person/{id}
POST http://192.168.100.101/byteland/web/person
PUT http://192.168.100.101/byteland/web/person/{id}
DELETE http://192.168.100.101/byteland/web/person/{id}

GET http://192.168.100.101/byteland/web/restaurant
GET http://192.168.100.101/byteland/web/restaurant/{id}
POST http://192.168.100.101/byteland/web/restaurant
PUT http://192.168.100.101/byteland/web/restaurant/{id}
DELETE http://192.168.100.101/byteland/web/restaurant/{id}

POST http://192.168.100.101/byteland/web/booking
POST http://192.168.100.101/byteland/web/availability

TODOs
=====================
Some tests (models from domain and symfony controllers)
All tests (domain persistence)

