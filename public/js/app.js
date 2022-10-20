let input = document.getElementById('title');
let btn = document.getElementById('search');
search.disabled = true;
input.addEventListener('focus',function(){
    search.disabled = false;
});
if(input.value.length > 0){
    search.disabled = false;
}

$(document).ready(function(){
    $(document).on('click', '.del-user-btn', function (e) {
      e.preventDefault();
      let id = $(this).data('id');

      Swal.fire({
          title: 'Are You Sure?',
          text: "Do You Want to Delete?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'OK',
          cancelButtonText: 'CANCEL',
          reverseButtons: true,
      }).then((result) => {
          if (result.isConfirmed) {
              $('.userDeleteForm' + id).submit();
          }
      })
  });

  $(document).on('click', '.del-product-btn', function (e) {
    e.preventDefault();
    let id = $(this).data('id');

    Swal.fire({
        title: 'Are You Sure?',
        text: "Do You Want to Delete?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        cancelButtonText: 'CANCEL',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $('.productDeleteForm' + id).submit();
        }
      })
    });

    $(document).on('click', '.del-btn', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
  
        Swal.fire({
            title: 'Are You Sure?',
            text: "Do You Want to Delete?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK',
            cancelButtonText: 'CANCEL',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $('.deleteForm' + id).submit();
            }
        })
    });
});
