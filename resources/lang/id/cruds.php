<?php

return [
    'userManagement'    => [
        'title'          => 'Manajemen Pengguna',
        'title_singular' => 'Manajemen Pengguna',
    ],
    'permission'        => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'              => [
        'title'          => 'Peranan',
        'title_singular' => 'Peran',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'              => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'Pengguna',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'auditLog'          => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'laporanHarian'     => [
        'title'          => 'Laporan',
        'title_singular' => 'Laporan',
    ],
    'produk'            => [
        'title'          => 'Produk',
        'title_singular' => 'Produk',
    ],
    'productCategory'   => [
        'title'          => 'Kategori Produk',
        'title_singular' => 'Kategori Produk',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Nama Kategori',
            'name_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'description'        => 'Deskripsi',
            'description_helper' => ' ',
        ],
    ],
    'product'           => [
        'title'          => 'Produk',
        'title_singular' => 'Produk',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Nama Produk',
            'name_helper'             => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'rate_keping'             => 'Rate per-Keping',
            'rate_keping_helper'      => ' ',
            'product_category'        => 'Kategori Produk',
            'product_category_helper' => ' ',
        ],
    ],
    'pemasukan'         => [
        'title'          => 'Pemasukan',
        'title_singular' => 'Pemasukan',
    ],
    'pengeluaran'       => [
        'title'          => 'Pengeluaran',
        'title_singular' => 'Pengeluaran',
    ],
    'faktur'            => [
        'title'          => 'Faktur',
        'title_singular' => 'Faktur',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'no_faktur'            => 'No Faktur',
            'no_faktur_helper'     => ' ',
            'tgl_faktur'           => 'Tgl Faktur',
            'tgl_faktur_helper'    => ' ',
            'tagihan'              => 'Tagihan',
            'tagihan_helper'       => ' ',
            'diskon_markup'        => 'Diskon Markup',
            'diskon_markup_helper' => 'Diskon atau markup jika ada pembulatan',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'photo'                => 'Foto Faktur',
            'photo_helper'         => ' ',
            'pelanggan'            => 'Pelanggan',
            'pelanggan_helper'     => ' ',
        ],
    ],
    'pembayaran'        => [
        'title'          => 'Pembayaran',
        'title_singular' => 'Pembayaran',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'type'                 => 'Tipe',
            'type_helper'          => 'Tipe Transaksi',
            'holder'               => 'Keberadaan',
            'holder_helper'        => 'Siapa yang megang uangnya (harus diubah tiap pindah tangan)',
            'nth_payment'          => 'Pembayaran ke-',
            'nth_payment_helper'   => 'Jika lanjutan, angsuran ke berapa. Kosongkan jika kontan',
            'nominal'              => 'Nominal',
            'nominal_helper'       => 'Nominal pembayaran',
            'payment_date'         => 'Tgl Pembayaran',
            'payment_date_helper'  => ' ',
            'keterangan'           => 'Keterangan',
            'keterangan_helper'    => 'Keterangan, jika ada.',
            'payment_proof'        => 'Bukti',
            'payment_proof_helper' => 'Foto Bukti Transaksi',
            'faktur'               => 'Faktur',
            'faktur_helper'        => ' ',
        ],
    ],
    'pelanggan'         => [
        'title'          => 'Pelanggan',
        'title_singular' => 'Pelanggan',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Nama',
            'name_helper'       => ' ',
            'address'           => 'Alamat',
            'address_helper'    => ' ',
            'contact'           => 'Kontak',
            'contact_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'welding'           => [
        'title'          => 'Hasil Las',
        'title_singular' => 'Hasil La',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'user'               => 'Pengelas',
            'user_helper'        => ' ',
            'product'            => 'Produk',
            'product_helper'     => ' ',
            'weight_kg'          => 'Berat(kg)',
            'weight_kg_helper'   => ' ',
            'amount_unit'        => 'Satuan(keping)',
            'amount_unit_helper' => ' ',
            'date'               => 'Tanggal',
            'date_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'attendance'        => [
        'title'          => 'Absensi',
        'title_singular' => 'Absensi',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'date'              => 'Tanggal',
            'date_helper'       => ' ',
            'user'              => 'Karyawan',
            'user_helper'       => ' ',
            'status'            => 'Status',
            'status_helper'     => 'Hadir/Izin/Alfa',
            'keterangan'        => 'Keterangan',
            'keterangan_helper' => 'Keterangan, jika ada.',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'cart'              => [
        'title'          => 'Keranjang',
        'title_singular' => 'Keranjang',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'faktur'             => 'Faktur',
            'faktur_helper'      => ' ',
            'product'            => 'Produk',
            'product_helper'     => ' ',
            'weight_kg'          => 'Berat(kg)',
            'weight_kg_helper'   => ' ',
            'amount_unit'        => 'Satuan(keping)',
            'amount_unit_helper' => 'Satuan keping, jika ada.',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'overtime'          => [
        'title'          => 'Lembur',
        'title_singular' => 'Lembur',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'Karyawan',
            'user_helper'       => ' ',
            'dept'              => 'Bagian',
            'dept_helper'       => ' ',
            'date'              => 'Tanggal',
            'date_helper'       => ' ',
            'start_hour'        => 'Jam Mulai',
            'start_hour_helper' => ' ',
            'end_hour'          => 'Jam Selesai',
            'end_hour_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'delivery'          => [
        'title'          => 'Pengiriman',
        'title_singular' => 'Pengiriman',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'date'                 => 'Tanggal',
            'date_helper'          => ' ',
            'distance_type'        => 'Kategori Jarak',
            'distance_type_helper' => ' ',
            'weight_type'          => 'Kategori Berat',
            'weight_type_helper'   => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'faktur'               => 'Faktur terkait',
            'faktur_helper'        => ' ',
        ],
    ],
    'crew'              => [
        'title'          => 'Kru Pengiriman',
        'title_singular' => 'Kru Pengiriman',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'delivery'          => 'Pengiriman',
            'delivery_helper'   => ' ',
            'user'              => 'Karyawan',
            'user_helper'       => ' ',
            'role'              => 'Peran',
            'role_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'penggajian'        => [
        'title'          => 'Penggajian',
        'title_singular' => 'Penggajian',
    ],
    'kasbon'            => [
        'title'          => 'Kasbon',
        'title_singular' => 'Kasbon',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'Karyawan',
            'user_helper'       => ' ',
            'nominal'           => 'Nominal',
            'nominal_helper'    => ' ',
            'cut_start'         => 'Dipotong dari',
            'cut_start_helper'  => ' ',
            'cut_end'           => 'Dipotong sampai',
            'cut_end_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'salary'            => [
        'title'          => 'Gaji',
        'title_singular' => 'Gaji',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'Karyawan',
            'user_helper'       => ' ',
            'nominal'           => 'Nominal',
            'nominal_helper'    => ' ',
            'markup'            => 'Markup',
            'markup_helper'     => 'Pembulatan gaji, jika ada',
            'keterangan'        => 'Keterangan',
            'keterangan_helper' => 'Keterangan utk markup.',
            'from'              => 'From',
            'from_helper'       => ' ',
            'to'                => 'To',
            'to_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentManagement' => [
        'title'          => 'Content management',
        'title_singular' => 'Content management',
    ],
    'contentCategory'   => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentTag'        => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'contentPage'       => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'Title',
            'title_helper'          => ' ',
            'category'              => 'Categories',
            'category_helper'       => ' ',
            'tag'                   => 'Tags',
            'tag_helper'            => ' ',
            'page_text'             => 'Full Text',
            'page_text_helper'      => ' ',
            'excerpt'               => 'Excerpt',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'Featured Image',
            'featured_image_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'faqManagement'     => [
        'title'          => 'FAQ Management',
        'title_singular' => 'FAQ Management',
    ],
    'faqCategory'       => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion'       => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Category',
            'category_helper'   => ' ',
            'question'          => 'Question',
            'question_helper'   => ' ',
            'answer'            => 'Answer',
            'answer_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
];
