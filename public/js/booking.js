let selectedDate;

// declare a stars variabe for rating function
let stars = document.getElementsByClassName('bx-star');

// for calendar related logic
document.addEventListener('DOMContentLoaded', function() {

    // reset local storege
    localStorage.clear();
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

    let user_id = document.getElementById('user_id_review')
    let rating = document.getElementById("stars");
    let review = document.getElementById("review");
    let reviewErr = document.getElementById('review-err');
    let ratingErr = document.getElementById("rating-err");

    ratingErr.innerHTML = "";
    reviewErr.innerHTML = "";

    if(!user_id) {
        Swal.fire({
            icon: "error",
            title: "Login required",
            text: "please log in",
            showConfirmButton: false,
            footer: '<a href="/login">Login</a>'
          });
        return false;
    }


    if (rating.value == 0) {
        ratingErr.innerHTML = "can't leave an empty stars";
        return false;
    }

    if (review.value.trim() == "") {
        reviewErr.innerHTML = "please fill the review";
        return false;
    }


    return true;
}

// validate if the checked-in and out date are not booked
async function checkAvailability(event) {
    event.preventDefault(); // Prevent the form from submitting


    let user_id = document.getElementById('user_id');


    if(!user_id) {
        Swal.fire({
            icon: "error",
            title: "Login required",
            text: "please log in",
            showConfirmButton: false,
            footer: '<a href="/login">Login</a>'
          });
        return false;
    }



    let propertyData = document.getElementById('property-id');
    let price = document.getElementById('price');

    let data = await fetch(`/api/booked/${propertyData.getAttribute('data-id')}`);
    let dates = await data.json();

    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value


    let desiredDates = getDays(checkin , checkout);

    for(let i = 0; i < desiredDates.length; i++) {
        if(dates.includes(desiredDates[i])) {
            Swal.fire({
                icon: "error",
                title: "Unavailable",
                text: "The selected date are alrady booked, please choose another date",
              });
            return false;
        }


    }

    Swal.fire({
        title: "Are you sure you want to book this property?",
        showCancelButton: true,
        text: `${desiredDates.length} Nights * ${parseInt(price.getAttribute('data-id'))} = ${desiredDates.length * parseInt(price.getAttribute('data-id'))} JOD`,
        confirmButtonText: "Procced to payment",
      }).then((result) => {
        if (result.isConfirmed) {

            let dataToStore = {
                property_id: propertyData.getAttribute('data-id'),
                user_id: user_id.value,
                start_date: checkin,
                end_date: checkout,
                total: desiredDates.length * price.getAttribute('data-id')
            };

            localStorage.setItem("bookingData",  JSON.stringify(dataToStore));
            window.location.href = "/payment";
            // return true;
            return false;
        }
      });

      return false

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


