let selectedDate;

document.addEventListener('DOMContentLoaded', function() {

    // fisrt we need to get the property id
    let propertyData= document.getElementById('property-id');
    let propertyId;
    if(propertyData){
        propertyId = propertyData.getAttribute('data-id');
        console.log(propertyId);
    }
    let disablesDates;

    async function fetchData(propertyId) {
        try {
            const response = await fetch(`/api/booked/${propertyId}`);
            const data = await response.json();
            disablesDates = data;

            console.log(disablesDates)

            let checkIn = document.getElementById('checkin');
            let checkOut = document.getElementById("checkout");

            flatpickr("#checkin", {
                dateFormat: "Y-m-d",
                disableMobile: true,
                disable: disablesDates, // Disabled dates
                minDate: "today",
                onChange(selectedDates, dateStr, instance) {
                    console.log(dateStr)
                    instance.calendarContainer.querySelector('.selected').style.backgroundColor = 'black';
                }

            });

            flatpickr("#checkout", {
                dateFormat: "Y-m-d",
                disableMobile: true,
                disable: disablesDates, // Disabled dates
                minDate: "today",
                // inline: false, // Set to 'true' if you want an always visible calendar
                onChange(selecstedDates,dateStr, instance) {
                    console.log(dateStr)
                    instance.calendarContainer.querySelector('.selected').style.backgroundColor = 'black';
                }

            });
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    fetchData(propertyId);


});
