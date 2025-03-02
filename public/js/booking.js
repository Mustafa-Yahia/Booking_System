let selectedDate;

// declare a stars variabe for rating function
let stars = document.getElementsByClassName('bx-star');

// for calendar related logic
document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('stars').value = 0; // to reset the stars value on refresh

    // first we need to get the property id
    let propertyData = document.getElementById('property-id');
    let propertyId;
    if (propertyData) {
        propertyId = propertyData.getAttribute('data-id');
    }

    let disablesDates;

    async function fetchData(propertyId) {
        try {
            const response = await fetch(`/api/booked/${propertyId}`);
            const data = await response.json();
            disablesDates = data;

            let checkIn = document.getElementById('checkin');
            let checkOut = document.getElementById("checkout");

            flatpickr("#checkin", {
                dateFormat: "Y-m-d",
                disableMobile: true,
                disable: disablesDates, // Disabled dates
                minDate: "today",
            });

            flatpickr("#checkout", {
                dateFormat: "Y-m-d",
                disableMobile: true,
                disable: disablesDates, // Disabled dates
                minDate: "today",
            });
        } catch (error) {
            console.error('Error fetching data:', error);
        }

        return disablesDates;
    }

    fetchData(propertyId);

});

function rate(n) {
    document.getElementById('stars').value = n;
    remove()
    for (let i = 0; i < n ; i++) {
// stars[i].classList.remove('bx-star'); /* this will cause an error */
        stars[i].classList.add('bxs-star');
        stars[i].style.color = 'yellow';
    }
}

function  remove() // stars[i].classList.remove('bx-star'); /* this will cause an error */
{
    let i = 0;
    while (i < 5) {
        stars[i].classList.remove('bxs-star');
        stars[i].style.color = '#000000';
        i++;
    }
}

// validation for the rating
function validateForm() {
    let rating = document.getElementById("stars");
    let review = document.getElementById("review");
    let reviewErr = document.getElementById('review-err');
    let ratingErr = document.getElementById("rating-err");

    if (rating.value == 0) {
        ratingErr.innerHTML = "can't leave an empty stars";
        return false;
    }

    if (review.value == "") {
        reviewErr.innerHTML = "please fill the review";
        return false;
    }

    return true;
}

// validate if the checked-in and out date are not booked
async function checkAvailability(event) {
    event.preventDefault(); // Prevent the form from submitting

    let propertyData = document.getElementById('property-id');
    let data = await fetch(`/api/booked/${propertyData.getAttribute('data-id')}`);
    let dates = await data.json();

    console.log(dates)
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value
    console.log(checkin)

    let desiredDates = getDays(checkin , checkout);
    console.log(desiredDates)

    for(let i = 0; i < desiredDates.length; i++) {
        if(dates.includes(desiredDates[i])) {
            alert('Selected dates are not available.');
            return false;
        }
    }

    // If dates are available, submit the form
    event.target.submit();
    return true;
}

// helper function to calculate the days beetween two dates

function getDays(strDate, endDate) {
    let desiredDates = new Array();

    let currentDate = new Date(strDate);
    let finalDate = new Date(endDate)
    while(currentDate <= finalDate) {
        desiredDates.push(currentDate.toISOString().split('T')[0]) // this is a copy of the current date
        currentDate = currentDate.addDays(1);
    }

    return desiredDates;
}




Date.prototype.addDays = function(days) { /* prototype so we add a method to all Date object (used with built-in objects) */
    var date = new Date(this.valueOf()); /* this refers to the current object, valueOf() return the value in milliseconds */
    date.setDate(date.getDate() + days); /* getDate get the current day of the month */
    return date;
}

// another way without prototype
// function addDaysToDate(date, days) {
//     let newDate = new Date(date.valueOf());
//     newDate.setDate(newDate.getDate() + days);
//     return newDate;
// }


