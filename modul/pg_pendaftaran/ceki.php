INSERT INTO rs.RS_PASIEN (
	11,
	NO_RM,
	TIPE_PASIEN,
	NAME,
	ADDRESS,
	PROP_ID,
	KAB_ID,
	KEC_ID,
	KEL_ID,
	POSTCODE,
	TGL_LAHIR,
	UMUR,
	GENDER,
	MOBILE,
	TGL_DAFTAR,
	ASURANSI_POLIS,
	ASURANSI_ID,
	MODIBY,
	MODIDATE
)
VALUES
	(
		'SP_SAVE_PASIEN',
		'$add_no_rm',
		'$tipe',
		'$nama_pasien',
		'$alamat',
		' $propinsi',
		'$kabupaten',
		'$kecamatan',
		'$kelurahan',
		'$kode_pos',
		'$tgl_lahir',
		'$umur',
		'$jk',
		'$hp',
		'',
		'$no_asuransi',
		'$asuransi',
		'$_SESSION[nama]',
		'$tgl_sekarang2 $jam_sekarang'
	)