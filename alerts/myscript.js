const flashData = $('.flash-data').data('flashdata');
if(flashData)
{
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Data berhasil '+ flashData,
        showConfirmButton: false,
        timer: 1500
    })

    // Swal.fire(
    //     'Berhasil!',
    //     'Data berhasil '+ flashData,
    //     'success'
    // )
}