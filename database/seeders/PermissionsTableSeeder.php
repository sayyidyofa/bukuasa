<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'laporan_harian_access',
            ],
            [
                'id'    => 20,
                'title' => 'produk_access',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 23,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 24,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 25,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 26,
                'title' => 'product_create',
            ],
            [
                'id'    => 27,
                'title' => 'product_edit',
            ],
            [
                'id'    => 28,
                'title' => 'product_show',
            ],
            [
                'id'    => 29,
                'title' => 'product_delete',
            ],
            [
                'id'    => 30,
                'title' => 'product_access',
            ],
            [
                'id'    => 31,
                'title' => 'pemasukan_access',
            ],
            [
                'id'    => 32,
                'title' => 'pengeluaran_access',
            ],
            [
                'id'    => 33,
                'title' => 'faktur_create',
            ],
            [
                'id'    => 34,
                'title' => 'faktur_edit',
            ],
            [
                'id'    => 35,
                'title' => 'faktur_show',
            ],
            [
                'id'    => 36,
                'title' => 'faktur_delete',
            ],
            [
                'id'    => 37,
                'title' => 'faktur_access',
            ],
            [
                'id'    => 38,
                'title' => 'pembayaran_create',
            ],
            [
                'id'    => 39,
                'title' => 'pembayaran_edit',
            ],
            [
                'id'    => 40,
                'title' => 'pembayaran_show',
            ],
            [
                'id'    => 41,
                'title' => 'pembayaran_delete',
            ],
            [
                'id'    => 42,
                'title' => 'pembayaran_access',
            ],
            [
                'id'    => 43,
                'title' => 'pelanggan_create',
            ],
            [
                'id'    => 44,
                'title' => 'pelanggan_edit',
            ],
            [
                'id'    => 45,
                'title' => 'pelanggan_show',
            ],
            [
                'id'    => 46,
                'title' => 'pelanggan_delete',
            ],
            [
                'id'    => 47,
                'title' => 'pelanggan_access',
            ],
            [
                'id'    => 48,
                'title' => 'welding_create',
            ],
            [
                'id'    => 49,
                'title' => 'welding_edit',
            ],
            [
                'id'    => 50,
                'title' => 'welding_show',
            ],
            [
                'id'    => 51,
                'title' => 'welding_delete',
            ],
            [
                'id'    => 52,
                'title' => 'welding_access',
            ],
            [
                'id'    => 53,
                'title' => 'attendance_create',
            ],
            [
                'id'    => 54,
                'title' => 'attendance_edit',
            ],
            [
                'id'    => 55,
                'title' => 'attendance_show',
            ],
            [
                'id'    => 56,
                'title' => 'attendance_delete',
            ],
            [
                'id'    => 57,
                'title' => 'attendance_access',
            ],
            [
                'id'    => 58,
                'title' => 'cart_create',
            ],
            [
                'id'    => 59,
                'title' => 'cart_edit',
            ],
            [
                'id'    => 60,
                'title' => 'cart_show',
            ],
            [
                'id'    => 61,
                'title' => 'cart_delete',
            ],
            [
                'id'    => 62,
                'title' => 'cart_access',
            ],
            [
                'id'    => 63,
                'title' => 'overtime_create',
            ],
            [
                'id'    => 64,
                'title' => 'overtime_edit',
            ],
            [
                'id'    => 65,
                'title' => 'overtime_show',
            ],
            [
                'id'    => 66,
                'title' => 'overtime_delete',
            ],
            [
                'id'    => 67,
                'title' => 'overtime_access',
            ],
            [
                'id'    => 68,
                'title' => 'delivery_create',
            ],
            [
                'id'    => 69,
                'title' => 'delivery_edit',
            ],
            [
                'id'    => 70,
                'title' => 'delivery_show',
            ],
            [
                'id'    => 71,
                'title' => 'delivery_delete',
            ],
            [
                'id'    => 72,
                'title' => 'delivery_access',
            ],
            [
                'id'    => 73,
                'title' => 'crew_create',
            ],
            [
                'id'    => 74,
                'title' => 'crew_edit',
            ],
            [
                'id'    => 75,
                'title' => 'crew_show',
            ],
            [
                'id'    => 76,
                'title' => 'crew_delete',
            ],
            [
                'id'    => 77,
                'title' => 'crew_access',
            ],
            [
                'id'    => 78,
                'title' => 'penggajian_access',
            ],
            [
                'id'    => 79,
                'title' => 'kasbon_create',
            ],
            [
                'id'    => 80,
                'title' => 'kasbon_edit',
            ],
            [
                'id'    => 81,
                'title' => 'kasbon_show',
            ],
            [
                'id'    => 82,
                'title' => 'kasbon_delete',
            ],
            [
                'id'    => 83,
                'title' => 'kasbon_access',
            ],
            [
                'id'    => 84,
                'title' => 'salary_create',
            ],
            [
                'id'    => 85,
                'title' => 'salary_edit',
            ],
            [
                'id'    => 86,
                'title' => 'salary_show',
            ],
            [
                'id'    => 87,
                'title' => 'salary_delete',
            ],
            [
                'id'    => 88,
                'title' => 'salary_access',
            ],
            [
                'id'    => 89,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 90,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 91,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 92,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 93,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 94,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 95,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 96,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 97,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 98,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 99,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 100,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 101,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 102,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 103,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 104,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 105,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 106,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 107,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 108,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 109,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 110,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 111,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 112,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 113,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 114,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 115,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 116,
                'title' => 'salary_constant_create',
            ],
            [
                'id'    => 117,
                'title' => 'salary_constant_edit',
            ],
            [
                'id'    => 118,
                'title' => 'salary_constant_show',
            ],
            [
                'id'    => 119,
                'title' => 'salary_constant_delete',
            ],
            [
                'id'    => 120,
                'title' => 'salary_constant_access',
            ],
            [
                'id'    => 121,
                'title' => 'setting_create',
            ],
            [
                'id'    => 122,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 123,
                'title' => 'setting_show',
            ],
            [
                'id'    => 124,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 125,
                'title' => 'setting_access',
            ],
            [
                'id'    => 126,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
