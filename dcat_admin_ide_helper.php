<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection sortable
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection accessory_id
     * @property Grid\Column|Collection accessory_name
     * @property Grid\Column|Collection accessory_specification
     * @property Grid\Column|Collection accessory_buy_date
     * @property Grid\Column|Collection accessory_quantity
     * @property Grid\Column|Collection accessory_unit_price
     * @property Grid\Column|Collection accessory_gross_price
     * @property Grid\Column|Collection accessory_rent_price
     * @property Grid\Column|Collection page_url
     * @property Grid\Column|Collection page_title
     * @property Grid\Column|Collection page_banner_img
     * @property Grid\Column|Collection page_banner_img_mob
     * @property Grid\Column|Collection page_meta_description
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection customer_id
     * @property Grid\Column|Collection customer_name
     * @property Grid\Column|Collection customer_nick_name
     * @property Grid\Column|Collection customer_phone
     * @property Grid\Column|Collection customer_gender
     * @property Grid\Column|Collection customer_driving_licence_number
     * @property Grid\Column|Collection customer_driving_licence_type
     * @property Grid\Column|Collection customer_birthday
     * @property Grid\Column|Collection customer_mail
     * @property Grid\Column|Collection customer_line_id
     * @property Grid\Column|Collection customer_country
     * @property Grid\Column|Collection customer_verify
     * @property Grid\Column|Collection customer_token
     * @property Grid\Column|Collection rv_series_name
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection nick_name
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection country
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection line_id
     * @property Grid\Column|Collection gender
     * @property Grid\Column|Collection birthday
     * @property Grid\Column|Collection driving_licence_number
     * @property Grid\Column|Collection driving_licence_type
     * @property Grid\Column|Collection witness_front_cover
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection content_en
     * @property Grid\Column|Collection path
     * @property Grid\Column|Collection firm_id
     * @property Grid\Column|Collection firm_name
     * @property Grid\Column|Collection firm_vat_number
     * @property Grid\Column|Collection firm_phone
     * @property Grid\Column|Collection firm_fax
     * @property Grid\Column|Collection firm_email
     * @property Grid\Column|Collection firm_line_id
     * @property Grid\Column|Collection firm_verify
     * @property Grid\Column|Collection attachment_name
     * @property Grid\Column|Collection attachment_icon
     * @property Grid\Column|Collection itinerary_name
     * @property Grid\Column|Collection itinerary_content
     * @property Grid\Column|Collection itinerary_content_en
     * @property Grid\Column|Collection itinerary_star
     * @property Grid\Column|Collection news_front_cover
     * @property Grid\Column|Collection category
     * @property Grid\Column|Collection show_status
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection method
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection input
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection rv_name
     * @property Grid\Column|Collection rv_front_cover
     * @property Grid\Column|Collection rv_series_id
     * @property Grid\Column|Collection rv_rent_setting
     * @property Grid\Column|Collection attachment_id
     * @property Grid\Column|Collection rv_discription
     *
     * @method Grid\Column|Collection sortable(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection accessory_id(string $label = null)
     * @method Grid\Column|Collection accessory_name(string $label = null)
     * @method Grid\Column|Collection accessory_specification(string $label = null)
     * @method Grid\Column|Collection accessory_buy_date(string $label = null)
     * @method Grid\Column|Collection accessory_quantity(string $label = null)
     * @method Grid\Column|Collection accessory_unit_price(string $label = null)
     * @method Grid\Column|Collection accessory_gross_price(string $label = null)
     * @method Grid\Column|Collection accessory_rent_price(string $label = null)
     * @method Grid\Column|Collection page_url(string $label = null)
     * @method Grid\Column|Collection page_title(string $label = null)
     * @method Grid\Column|Collection page_banner_img(string $label = null)
     * @method Grid\Column|Collection page_banner_img_mob(string $label = null)
     * @method Grid\Column|Collection page_meta_description(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection customer_id(string $label = null)
     * @method Grid\Column|Collection customer_name(string $label = null)
     * @method Grid\Column|Collection customer_nick_name(string $label = null)
     * @method Grid\Column|Collection customer_phone(string $label = null)
     * @method Grid\Column|Collection customer_gender(string $label = null)
     * @method Grid\Column|Collection customer_driving_licence_number(string $label = null)
     * @method Grid\Column|Collection customer_driving_licence_type(string $label = null)
     * @method Grid\Column|Collection customer_birthday(string $label = null)
     * @method Grid\Column|Collection customer_mail(string $label = null)
     * @method Grid\Column|Collection customer_line_id(string $label = null)
     * @method Grid\Column|Collection customer_country(string $label = null)
     * @method Grid\Column|Collection customer_verify(string $label = null)
     * @method Grid\Column|Collection customer_token(string $label = null)
     * @method Grid\Column|Collection rv_series_name(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection nick_name(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection country(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection line_id(string $label = null)
     * @method Grid\Column|Collection gender(string $label = null)
     * @method Grid\Column|Collection birthday(string $label = null)
     * @method Grid\Column|Collection driving_licence_number(string $label = null)
     * @method Grid\Column|Collection driving_licence_type(string $label = null)
     * @method Grid\Column|Collection witness_front_cover(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection content_en(string $label = null)
     * @method Grid\Column|Collection path(string $label = null)
     * @method Grid\Column|Collection firm_id(string $label = null)
     * @method Grid\Column|Collection firm_name(string $label = null)
     * @method Grid\Column|Collection firm_vat_number(string $label = null)
     * @method Grid\Column|Collection firm_phone(string $label = null)
     * @method Grid\Column|Collection firm_fax(string $label = null)
     * @method Grid\Column|Collection firm_email(string $label = null)
     * @method Grid\Column|Collection firm_line_id(string $label = null)
     * @method Grid\Column|Collection firm_verify(string $label = null)
     * @method Grid\Column|Collection attachment_name(string $label = null)
     * @method Grid\Column|Collection attachment_icon(string $label = null)
     * @method Grid\Column|Collection itinerary_name(string $label = null)
     * @method Grid\Column|Collection itinerary_content(string $label = null)
     * @method Grid\Column|Collection itinerary_content_en(string $label = null)
     * @method Grid\Column|Collection itinerary_star(string $label = null)
     * @method Grid\Column|Collection news_front_cover(string $label = null)
     * @method Grid\Column|Collection category(string $label = null)
     * @method Grid\Column|Collection show_status(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection method(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection input(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection rv_name(string $label = null)
     * @method Grid\Column|Collection rv_front_cover(string $label = null)
     * @method Grid\Column|Collection rv_series_id(string $label = null)
     * @method Grid\Column|Collection rv_rent_setting(string $label = null)
     * @method Grid\Column|Collection attachment_id(string $label = null)
     * @method Grid\Column|Collection rv_discription(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection sortable
     * @property Show\Field|Collection id
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection name
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection accessory_id
     * @property Show\Field|Collection accessory_name
     * @property Show\Field|Collection accessory_specification
     * @property Show\Field|Collection accessory_buy_date
     * @property Show\Field|Collection accessory_quantity
     * @property Show\Field|Collection accessory_unit_price
     * @property Show\Field|Collection accessory_gross_price
     * @property Show\Field|Collection accessory_rent_price
     * @property Show\Field|Collection page_url
     * @property Show\Field|Collection page_title
     * @property Show\Field|Collection page_banner_img
     * @property Show\Field|Collection page_banner_img_mob
     * @property Show\Field|Collection page_meta_description
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection token
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection customer_id
     * @property Show\Field|Collection customer_name
     * @property Show\Field|Collection customer_nick_name
     * @property Show\Field|Collection customer_phone
     * @property Show\Field|Collection customer_gender
     * @property Show\Field|Collection customer_driving_licence_number
     * @property Show\Field|Collection customer_driving_licence_type
     * @property Show\Field|Collection customer_birthday
     * @property Show\Field|Collection customer_mail
     * @property Show\Field|Collection customer_line_id
     * @property Show\Field|Collection customer_country
     * @property Show\Field|Collection customer_verify
     * @property Show\Field|Collection customer_token
     * @property Show\Field|Collection rv_series_name
     * @property Show\Field|Collection email
     * @property Show\Field|Collection value
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection nick_name
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection country
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection line_id
     * @property Show\Field|Collection gender
     * @property Show\Field|Collection birthday
     * @property Show\Field|Collection driving_licence_number
     * @property Show\Field|Collection driving_licence_type
     * @property Show\Field|Collection witness_front_cover
     * @property Show\Field|Collection content
     * @property Show\Field|Collection content_en
     * @property Show\Field|Collection path
     * @property Show\Field|Collection firm_id
     * @property Show\Field|Collection firm_name
     * @property Show\Field|Collection firm_vat_number
     * @property Show\Field|Collection firm_phone
     * @property Show\Field|Collection firm_fax
     * @property Show\Field|Collection firm_email
     * @property Show\Field|Collection firm_line_id
     * @property Show\Field|Collection firm_verify
     * @property Show\Field|Collection attachment_name
     * @property Show\Field|Collection attachment_icon
     * @property Show\Field|Collection itinerary_name
     * @property Show\Field|Collection itinerary_content
     * @property Show\Field|Collection itinerary_content_en
     * @property Show\Field|Collection itinerary_star
     * @property Show\Field|Collection news_front_cover
     * @property Show\Field|Collection category
     * @property Show\Field|Collection show_status
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection method
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection input
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection rv_name
     * @property Show\Field|Collection rv_front_cover
     * @property Show\Field|Collection rv_series_id
     * @property Show\Field|Collection rv_rent_setting
     * @property Show\Field|Collection attachment_id
     * @property Show\Field|Collection rv_discription
     *
     * @method Show\Field|Collection sortable(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection accessory_id(string $label = null)
     * @method Show\Field|Collection accessory_name(string $label = null)
     * @method Show\Field|Collection accessory_specification(string $label = null)
     * @method Show\Field|Collection accessory_buy_date(string $label = null)
     * @method Show\Field|Collection accessory_quantity(string $label = null)
     * @method Show\Field|Collection accessory_unit_price(string $label = null)
     * @method Show\Field|Collection accessory_gross_price(string $label = null)
     * @method Show\Field|Collection accessory_rent_price(string $label = null)
     * @method Show\Field|Collection page_url(string $label = null)
     * @method Show\Field|Collection page_title(string $label = null)
     * @method Show\Field|Collection page_banner_img(string $label = null)
     * @method Show\Field|Collection page_banner_img_mob(string $label = null)
     * @method Show\Field|Collection page_meta_description(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection customer_id(string $label = null)
     * @method Show\Field|Collection customer_name(string $label = null)
     * @method Show\Field|Collection customer_nick_name(string $label = null)
     * @method Show\Field|Collection customer_phone(string $label = null)
     * @method Show\Field|Collection customer_gender(string $label = null)
     * @method Show\Field|Collection customer_driving_licence_number(string $label = null)
     * @method Show\Field|Collection customer_driving_licence_type(string $label = null)
     * @method Show\Field|Collection customer_birthday(string $label = null)
     * @method Show\Field|Collection customer_mail(string $label = null)
     * @method Show\Field|Collection customer_line_id(string $label = null)
     * @method Show\Field|Collection customer_country(string $label = null)
     * @method Show\Field|Collection customer_verify(string $label = null)
     * @method Show\Field|Collection customer_token(string $label = null)
     * @method Show\Field|Collection rv_series_name(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection nick_name(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection country(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection line_id(string $label = null)
     * @method Show\Field|Collection gender(string $label = null)
     * @method Show\Field|Collection birthday(string $label = null)
     * @method Show\Field|Collection driving_licence_number(string $label = null)
     * @method Show\Field|Collection driving_licence_type(string $label = null)
     * @method Show\Field|Collection witness_front_cover(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection content_en(string $label = null)
     * @method Show\Field|Collection path(string $label = null)
     * @method Show\Field|Collection firm_id(string $label = null)
     * @method Show\Field|Collection firm_name(string $label = null)
     * @method Show\Field|Collection firm_vat_number(string $label = null)
     * @method Show\Field|Collection firm_phone(string $label = null)
     * @method Show\Field|Collection firm_fax(string $label = null)
     * @method Show\Field|Collection firm_email(string $label = null)
     * @method Show\Field|Collection firm_line_id(string $label = null)
     * @method Show\Field|Collection firm_verify(string $label = null)
     * @method Show\Field|Collection attachment_name(string $label = null)
     * @method Show\Field|Collection attachment_icon(string $label = null)
     * @method Show\Field|Collection itinerary_name(string $label = null)
     * @method Show\Field|Collection itinerary_content(string $label = null)
     * @method Show\Field|Collection itinerary_content_en(string $label = null)
     * @method Show\Field|Collection itinerary_star(string $label = null)
     * @method Show\Field|Collection news_front_cover(string $label = null)
     * @method Show\Field|Collection category(string $label = null)
     * @method Show\Field|Collection show_status(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection method(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection input(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection rv_name(string $label = null)
     * @method Show\Field|Collection rv_front_cover(string $label = null)
     * @method Show\Field|Collection rv_series_id(string $label = null)
     * @method Show\Field|Collection rv_rent_setting(string $label = null)
     * @method Show\Field|Collection attachment_id(string $label = null)
     * @method Show\Field|Collection rv_discription(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
