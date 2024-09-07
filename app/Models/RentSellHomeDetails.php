<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentSellHomeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_admin',
        'property_type',
        'building_name',
        'rent_sell',
        'rental_price',
        'sell_price',
        'url_gps',
        'time_arrive',
        'train_name',
        'bedroom',
        'bathroom',
        'room_width',
        'studio',
        'number_floors',
        'decoration',
        'address',
        'provinces',
        'districts',
        'amphures',
        'zip_code',
        'details',
        'minimum_rent',
        'deposit',
        'cash_pledge',
        'advance_rent',
        'reservation_money',
        'down_payment',
        'down_payment_installments',
        'installments',
        'each_installment',
        'kitchen',
        'bed',
        'fitness',
        'wardrobe',
        'parking',
        'air_conditioner',
        'image',
        'make_appointment_location',
        'send_customers',
        'ask_more',
        'contact_number',
        'status_home',
        'thereVarious',
        // เพิ่มใหม่
        'user_id',
        'cross',
        'sell',
        'rent',
        'name_have',
        'start_date',
        'road',
        'alley',
        'number_parking',
        'rent_baht_month',
        'month_advance_rent',
        'electricalAppliance',
        'facilities',
        'furniture',
        'shopping_center',
        'school',
        'meters_store',
        'url_video',
        'announcement_name',
        'files',
        'user_name',
        'user_surname',
        'user_phone',
        'reservation_amount_baht',
        'product_new',
        'notifications'
    ];
}