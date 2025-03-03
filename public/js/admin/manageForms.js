
async function validateDelete(event) {
    event.preventDefault();

    const shouldDelete = await Swal.fire({
        title: "Destructive action",
        text: "You are about to delete a user with all their related data.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "I am aware, delete it!"
    }).then((result) => result.isConfirmed);

    if (shouldDelete) {
        Swal.fire({
            icon: "success",
            title: "The user has ben Deleted",
            showConfirmButton: false,
            timer: 1500
          });
        setTimeout(() => {
            event.target.submit();
        }, 2000);
    }
}
async function validateDeleteProperty(event) {
    event.preventDefault();

    const shouldDelete = await Swal.fire({
        title: "Destructive action",
        text: "You are about to delete This property.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "I am aware, delete it!"
    }).then((result) => result.isConfirmed);

    if (shouldDelete) {
        Swal.fire({
            icon: "success",
            title: "The property has ben Deleted",
            showConfirmButton: false,
            timer: 1500
          });
        setTimeout(() => {
            event.target.submit();
        }, 2000);
    }
}

async function validateDeleteBooking(event) {
    event.preventDefault();

    const shouldDelete = await Swal.fire({
        title: "Destructive action",
        text: "You are about to delete This Booking.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "I am aware, delete it!"
    }).then((result) => result.isConfirmed);

    if (shouldDelete) {
        Swal.fire({
            icon: "success",
            title: "The Booking has ben Deleted",
            showConfirmButton: false,
            timer: 1500
          });
        setTimeout(() => {
            event.target.submit();
        }, 2000);
    }
}

