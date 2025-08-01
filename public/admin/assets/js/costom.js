document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', () => {
      const itemId = button.getAttribute('data-id');
      const type = button.getAttribute('data-type'); // e.g. 'default', 'category', 'subcategory'
      let url = '';
      switch (type) {
        case 'category':
          url = `delete-category/${itemId}`;
          break;
        case 'subcategory':
          url = `subcategory-delete/${itemId}`;
          break;
        default:
          url = `delete/${itemId}`;
      }

      Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(url, {
            method: 'GET',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire({
                title: 'Deleted!',
                text: 'The item has been deleted.',
                icon: 'success',
                timer: 1000,
                showConfirmButton: false
              });

              setTimeout(() => {
                location.reload();
              }, 1000);
            } else {
              throw new Error('Delete failed on server.');
            }
          })
          .catch(() => {
            Swal.fire({
              title: 'Error!',
              text: 'There was a problem deleting the item.',
              icon: 'error'
            });
          });
        }
      });
    });
  });
});



// status ke liye

