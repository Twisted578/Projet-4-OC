$(function() {
    var date = new Date();

    /* Getting the current time */
    function currentTime() {
        var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();

        return hours + ":" + minutes + ":" + seconds;
    }

    $('.js-datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 2, // Creates a dropdown of 15 years to control year,
        today: 'Aujourd\'hui',
        clear: '',
        /* close: 'Ok',*/
        closeOnSelect: true, // Close upon selecting a date,
        // Pass the months and weekdays as an array for each invocation.
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthsShort: [ 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc' ],
        weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
        weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
        weekdaysLetter: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        showMonthsShort: true,
        format: 'dd/mm/yyyy',//dd mm yyyy
        formatSubmit: 'dd/mm/yyyy',
        hiddenName: true,
        labelMonthNext:"Mois suivant",
        labelMonthPrev:"Mois précédent",
        labelMonthSelect:"Sélectionner un mois",
        labelYearSelect:"Sélectionner une année",
        firstDay: 1,
        min: true,
        max: +380,
        disable: [
            2, 7,
            new Date(2017,10,1),
            new Date(2017,10,11),
            new Date(2017,11,25),

            new Date(2018,0,1),
            new Date(2018,3,1),
            new Date(2018,3,2),
            new Date(2018,4,1),
            new Date(2018,4,8),
            new Date(2018,4,10),
            new Date(2018,4,20),
            new Date(2018,4,21),
            new Date(2018,6,14),
            new Date(2018,7,15),
            new Date(2018,10,1),
            new Date(2018,10,11),
            new Date(2018,11,25),

            new Date(2019,0,1),
            new Date(2018,3,21),
            new Date(2018,3,22),
            new Date(2019,4,1),
            new Date(2019,4,8),
            new Date(2019,4,30),
            new Date(2019,5,9),
            new Date(2019,5,10),
            new Date(2019,6,14),
            new Date(2019,7,15),
            new Date(2019,10,1),
            new Date(2019,10,11),
            new Date(2019,11,25)
        ]

    });

    /* Go back button: second & third page */
    var goBackButton = $('.go-back');
    goBackButton.on('click', function(e) {
        e.preventDefault();
        window.history.back();
    });

    $('.info-booking').on('click', function() {
        $(this).next().fadeToggle();
    });
});