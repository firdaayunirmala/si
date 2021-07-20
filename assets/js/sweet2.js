const flashDataUser = $('.flashuser').data('flashuser');
const user = 'user';

if (flashDatauser) {
	Swal.fire({
		title: 'Data ' + kand,
		text: 'Berhasil ' + flashDatauser,
		type: 'success'

	});
}


$('.hapususer').on('click', function (e) {

	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Data " + user+ " akan dihapus!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus data!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})

});
