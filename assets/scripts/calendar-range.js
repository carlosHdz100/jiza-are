// Agregar el mes siguiente
function addMonths() {
  var currentDate = $(".datepicker").datepicker("getDate");
  var numberOfMonthsToAdd = 1; // Puedes ajustar el número de meses que deseas agregar

  if (currentDate != null) {
    currentDate.setMonth(currentDate.getMonth() + numberOfMonthsToAdd);
  } else {
    currentDate = new Date(); // Si no hay fecha seleccionada, comienza desde el mes actual
    currentDate.setMonth(currentDate.getMonth() + numberOfMonthsToAdd);
  }

  $(".datepicker").datepicker("setDate", currentDate);
}

// Regresar al mes anterior
function subtractMonths() {
  var currentDate = $(".datepicker").datepicker("getDate");
  var numberOfMonthsToSubtract = 1; // Puedes ajustar el número de meses que deseas restar

  if (currentDate != null) {
    currentDate.setMonth(currentDate.getMonth() - numberOfMonthsToSubtract);
  } else {
    currentDate = new Date(); // Si no hay fecha seleccionada, comienza desde el mes actual
    currentDate.setMonth(currentDate.getMonth() - numberOfMonthsToSubtract);
  }

  $(".datepicker").datepicker("setDate", currentDate);
}
var dateFrom = null;
var dateTo = null;
var reservedDates = ['12/15/2023', '12/16/2023', '12/17/2023', '12/18/2023', '12/08/2023', '12/11/2023'];

// $("#from").val('06/10/2015');
// $("#to").val('10/10/2015');
var selectedDate = null;
var tempDateFrom = null;
var tempDateTo = null;
$(".datepicker").datepicker({
    minDate: 0,
    numberOfMonths: [3,1],
    // defaultDate: '06/10/2015',
    beforeShowDay: function(date) {           
        dateFrom = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#from").val());
        dateTo = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#to").val());

        // Formatear la fecha actual
        var formattedDate = $.datepicker.formatDate('mm/dd/yy', date);

        // Verificar si la fecha está reservada
        if ($.inArray(formattedDate, reservedDates) !== -1) {
            return [false, "reserved-date", "Fecha reservada"]; 
        } 
        
        if(dateFrom != null){
            if(date.getTime() == dateFrom.getTime()){
                return [true,"dateFrom"];                     
            }
        }
        if(dateTo != null){
            if(date.getTime() == dateTo.getTime()){
                return [true,"dateTo"];
            } 
        }
        // Deshabilitar fechas después de las fechas reservadas
        if (reservedDates.length > 0) {
            var lastReservedDate = $.datepicker.parseDate('mm/dd/yy', reservedDates[reservedDates.length - 1]);
          if (date > lastReservedDate) {
            return [false, "disabled-date", "Fecha no disponible"];
          }
        }   
        return [true, dateFrom && ((date.getTime() == dateFrom.getTime()) || (dateTo && date >= dateFrom && date <= dateTo)) ? "dp-highlight" : ""];   
    },
    onSelect: function(dateText, inst) {
        console.log('onSelect');
        dateFrom = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#from").val());
        dateTo = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $("#to").val());
        selectedDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, dateText);               
        if (!dateFrom || dateTo) {
            $("#from").val(dateText);
            $("#to").val("");
            $(this).datepicker();
        } else if( selectedDate < dateFrom ) {
            $("#to").val( $("#from").val() );
            $("#from").val( dateText );
            $(this).datepicker();
        } else {
            $("#to").val(dateText);
            $(this).datepicker();
        }           
        setTimeout(function() {                
            highlightBetweenDates(); 
        }, 0); 
    },
    refresh: function() {
      alert('sdfdsf');
    }
});

var currentDate = null;
var allTds = null;

function highlightBetweenDates() {
    if(dateFrom == null || dateTo == null ){ 
        $(".ui-datepicker-calendar td").mouseover(function() {
            if(dateFrom != null && !$(this).hasClass('ui-datepicker-unselectable')){
                currentDate = $.datepicker.parseDate($.datepicker._defaults.dateFormat, $(this).children().text() + '/' + (parseInt($(this).attr('data-month'))+1) + '/' + parseInt($(this).attr('data-year')));
                if(currentDate != selectedDate){
                    if (selectedDate === null) {
                        selectedDate = new Date();
                    }
                    allTds = $('.ui-datepicker').find('td');            
                    allTds.removeClass('dp-highlight')
                    found = false;
                    if (currentDate < selectedDate) {
                        for (i = 0; i < allTds.length; i++) {
                            if (allTds[i] == this) {
                                found = true;
                            }
                            if ($(allTds[i]).hasClass('ui-datepicker-current-day')) {
                                break;
                            }
                            if (found) {
                                $(allTds[i]).addClass('dp-highlight');
                            }
                        }
                    } else if (currentDate > selectedDate) {
                        for (i = 0; i < allTds.length; i++) {
                            if (found) {
                                $(allTds[i]).addClass('dp-highlight');
                            }
                            if ($(allTds[i]).hasClass('ui-datepicker-current-day') ) {
                                found = true;
                            }
                            if (allTds[i] == this) {
                                break;
                            }
                        }
                    }                
                } else {
                    console.log('same');  
                }    
            } else {
                console.log('NOT');   
            }    
        });
    }  else {
        $(".ui-datepicker-calendar td").unbind('mouseover');
        $(".ui-datepicker-calendar td").off('mouseover');
    } 
}

highlightBetweenDates();
