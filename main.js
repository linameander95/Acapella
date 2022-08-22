"use strict";
let url = "http://localhost/Universitetet/Webb%20III/Projekt/projekt_webservice_vt22-linameander95/rest.php"; //Skapar variabel för url för fetch-anrop
function writeFood(alldata) { //Funktion för att skriva ut data till startsidan
    const menu = document.getElementById("menudiv");
    const about = document.getElementById("aboutdiv");
    fetch(url) //Hämtar data via webbtjänsten
        .then((response) => response.json() //Behandlar datan så att JavaScript kan förstå den
            .then((jsonData) => {
                //Skriver ut hämtad data samt rubriker med for-loopar//
                for (let i = 0, len = jsonData.pagetext.length; i < len; i++) {
                    about.innerHTML += "<p>" + jsonData.pagetext[i].pagetext_aboutus + "</p>";
                };


                menu.innerHTML += "<h2>Starters</h2>";
                for (let i = 0, len = jsonData.starters.length; i < len; i++) {
                    menu.innerHTML += "<h2 class='names'>" + jsonData.starters[i].starter_name + "</h2>" + "<p class='descriptions'>" + jsonData.starters[i].starter_description + "</p>" + "<p class='price'>" + jsonData.starters[i].starter_price + "</p>" + "</br></br>";
                };

                menu.innerHTML += "<h2>Main dishes</h2>";
                for (let i = 0, len = jsonData.mains.length; i < len; i++) {
                    menu.innerHTML += "<h2 class='names'>" + jsonData.mains[i].main_name + "</h2>" + "<p class='descriptions'>" + jsonData.mains[i].main_description + "</p>" + "<p class='price'>" + jsonData.mains[i].main_price + "</p>" + "</br></br>";
                }

                menu.innerHTML += "<h2>Desserts</h2>";
                for (let i = 0, len = jsonData.desserts.length; i < len; i++) {
                    menu.innerHTML += "<h2 class='names'>" + jsonData.desserts[i].dessert_name + "</h2>" + "<p class='descriptions'>" + jsonData.desserts[i].dessert_description + "</p>" + "<p class='price'>" + jsonData.desserts[i].dessert_price + "</p>" + "</br></br>";
                };
                menu.innerHTML += "<h2>Drinks</h2>";
                for (let i = 0, len = jsonData.drinks.length; i < len; i++) {
                    menu.innerHTML += "<h2 class='names'>" + jsonData.drinks[i].drink_name + "</h2>" + "<p class='descriptions'>" + jsonData.drinks[i].drink_description + "</p>" + "<p class='price'>" + jsonData.drinks[i].drink_price + "</p>" + "</br>";
                };

                //Skapar variabler för fälten för bordsbokning//
                const bookingnameinput = document.getElementById("name");
                const bookingemailinput = document.getElementById("email");
                const bookingphoneinput = document.getElementById("phonenr");
                const bookingplaceinput = document.getElementById("seating");
                const bookindatetimeinput = document.getElementById("time");
                const additembtn = document.getElementById("submitbtn");
                additembtn.addEventListener("click", addBooking); //Event-listener för bokaknappen
            
                function addBooking(event) { //Funktion för att lägga till en bokning
                    event.preventDefault(); //Förhindrar page refresh
                    
                    //Skapar variabel för all input i fälten//
                    let bookingname = bookingnameinput.value;
                    let bookingemail = bookingemailinput.value;
                    let bookingphone = bookingphoneinput.value;
                    let bookingplace = bookingplaceinput.value;
                    let bookingdatetime = bookindatetimeinput.value;
                    //Skapar json-string av de ifyllda värdena//
                    let jsonStr = JSON.stringify({
                        bookingname: bookingname,
                        bookingemail: bookingemail,
                        bookingphone: bookingphone,
                        bookingplace: bookingplace,
                        bookingdatetime: bookingdatetime
                    });
                    //Skickar min json-string med ett fetchanrop med metoden post till min webbtjänst//
                    fetch(url, {
                        method: "POST",
                        headers: {
                            "content-type": "application/json"
                        },
                        body: jsonStr
                    })
                        .catch(err => console.log(err))
                };

            }));
};

