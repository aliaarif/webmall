<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::truncate();
        $activities = [
            //--------Activity for Direct Debit Start------//
            ['code' => 'DD_LOGIN_SUCCESS','description' => 'Direct Debit - Login Success','module_name' => 'Direct Debit'],
            ['code' => 'DD_LOGIN_FAILURE','description' => 'Direct Debit - Login Failure','module_name' => 'Direct Debit'],
            ['code' => 'DD_BANK_DETAILS_FAILURE','description' => 'Direct Debit - Short Code, Account Holder name and Account number is not validated','module_name' => 'Direct Debit'],
            ['code' => 'DD_BANK_DETAILS_SUCCESS','description' => 'Direct Debit - Short Code, Account Holder name and Account number is validated','module_name' => 'Direct Debit'],
            ['code' => 'DD_CONFIRM_DD_DETAILS','description' => 'Direct Debit - Confirm Direct Debit Details','module_name' => 'Direct Debit'],
            ['code' => 'DD_SELECT_ADDRESS','description' => 'Direct Debit - Select Address','module_name' => 'Direct Debit'],
            ['code' => 'DD_CREATE_DD_MANDATE_FAILURE','description' => 'Direct Debit - Confirm details and Create Direct Debit Mandate - Failure','module_name' => 'Direct Debit'],
            ['code' => 'DD_CREATE_DD_MANDATE_SUCCESS','description' => 'Direct Debit - Confirm details and Create Direct Debit Mandate - Success','module_name' => 'Direct Debit'],
            ['code' => 'DD_EMAIL_FAILURE','description' => 'Direct Debit - Email Update Failure','module_name' => 'Direct Debit'],
            ['code' => 'DD_EMAIL_SUCCESS','description' => 'Direct Debit - Email Update Success','module_name' => 'Direct Debit'],
            ['code' => 'DD_PRINT_DD_MANDATE','description' => 'Direct Debit - Print Direct Debit Mandate','module_name' => 'Direct Debit'],
            ['code' => 'DD_LOGOUT','description' => 'Direct Debit - Log Out','module_name' => 'Direct Debit'],
            //-------------------End of Direct Debit-----------//


            //------Activity for Student Deposits Start--------//
            ['code' => 'SD_LOGIN_FAILURE','description' => 'Student Deposit - Login Failure','module_name' => 'Student Deposits'],
            ['code' => 'SD_LOGIN_SUCCESS','description' => 'Student Deposit - Login Success','module_name' => 'Student Deposits'],
            ['code' => 'SD_CONFIRM_DETAILS','description' => 'Student Deposit - Confirm Details','module_name' => 'Student Deposits'],
            ['code' => 'SD_SELECT_DEPOSIT','description' => 'Student Deposit - Select Deposits','module_name' => 'Student Deposits'],
            ['code' => 'SD_PAYMENT_INIT','description' => 'Student Deposit - Continue to payment','module_name' => 'Student Deposits'],
            ['code' => 'SD_PAYMENT_SUCCESS','description' => 'Student Deposit - Payment Confirmation - Success','module_name' => 'Student Deposits'],
            ['code' => 'SD_PAYMENT_FAILURE','description' => 'Student Deposit - Payment Confirmation - Failure','module_name' => 'Student Deposits'],
            ['code' => 'SD_LOGOUT','description' => 'Student Deposit - Logout','module_name' => 'Student Deposits'],
            //-----End of Student Deposit--------------------//

            //-------Activity for Application fees Start-------//
            ['code' => 'BSAF_LOGIN_FAILURE','description' => 'Business School Application - Login Failure','module_name' => 'Business School Application Fees'],
            ['code' => 'BSAF_LOGIN_SUCCESS','description' => 'Business School Application - Login Success','module_name' => 'Business School Application Fees'],
            ['code' => 'BSAF_CONFIRM_DETAILS','description' => 'Business School Application - Confirm Details','module_name' => 'Business School Application Fees'],
            ['code' => 'BSAF_SELECT_PROGRAM','description' => 'Business School Application - Program/Course selection','module_name' => 'Business School Application Fees'],
            ['code' => 'BSAF_PAYMENT_INIT','description' => 'Business School Application - Continue to payment','module_name' => 'Business School Application Fees'],
            ['code' => 'BSAF_PAYMENT_SUCCESS','description' => 'Business School Application - Payment Confirmation - Success','module_name' => 'Business School Application Fees'],
            ['code' => 'BSAF_PAYMENT_FAILURE','description' => 'Business School Application - Payment Confirmation - Failure','module_name' => 'Business School Application Fees'],
            ['code' => 'BSAF_LOGOUT','description' => 'Business School Application - Log out','module_name' => 'Business School Application Fees'],

            //------Activity for Campus Card Replacement Start----//
            ['code' => 'CCR_LOGIN_FAILURE','description' => 'Campus Card Replacement - Login Failure','module_name' => 'Campus Card Replacement'],
            ['code' => 'CCR_LOGIN_SUCCESS','description' => 'Campus Card Replacement - Login Success','module_name' => 'Campus Card Replacement'],
            ['code' => 'CCR_PAYMENT_INIT','description' => 'Campus Card Replacement - Continue to payment','module_name' => 'Campus Card Replacement'],
            ['code' => 'CCR_STOLEN_CARD_REPLACEMENT','description' => 'Campus Card Replacement -  Stolen Campus Card - Order Replacement','module_name' => 'Campus Card Replacement'],
            ['code' => 'CCR_LOST_CARD_REPLACEMENT','description' => 'Campus Card Replacement -  Lost Campus Card - Order Replacement','module_name' => 'Campus Card Replacement'],
            ['code' => 'CCR_PAYMENT_SUCCESS','description' => 'Campus Card Replacement - Payment Confirmation - Success','module_name' => 'Campus Card Replacement'],
            ['code' => 'CCR_PAYMENT_FAILURE','description' => 'Campus Card Replacement - Payment Confirmation - Failure','module_name' => 'Campus Card Replacement'],
            ['code' => 'CCR_LOGOUT','description' => 'Campus Card Replacement - Log out','module_name' => 'Campus Card Replacement'],
            //---------End of Campus Card Replacemen--------------//

            //-------Activity for Print Credit Purchase-----------//
            ['code' => 'PCP_LOGIN_FAILURE','description' => 'Print Credit Purchase - Login Failure','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_LOGIN_SUCCESS','description' => 'Print Credit Purchase - Login Success','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_ADD_CREDIT','description' => 'Print Credit Purchase - Add Credit','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_QUICK_ADD_CREDIT','description' => 'Print Credit Purchase - Quick Credit - Add Credit','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_CONTINUE_PAYMENT','description' => 'Print Credit Purchase - Continue to payment','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_PAYMENT_SUCCESS','description' => 'Print Credit Purchase -  Payment Confirmation - Success','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_PAYMENT_FAILURE','description' => 'Print Credit Purchase -  Payment Confirmation - Failure','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_VIEW_USER_STATEMENT','description' => 'Print Credit Purchase - View Statement','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_PRINT_STATEMENT','description' => 'Print Credit Purchase - Print PDF Statements','module_name' => 'Print Credit Purchase'],
            ['code' => 'PCP_LOGOUT','description' => 'Print Credit Purchase - Log out','module_name' => 'Print Credit Purchase'],
            //-------------End of Print Credit------------------//

            //-------Activity for CMS Dashboard-----------//
            ['code' => 'ADMIN_LOGIN_FAILURE','description' => 'Admin - Login Failure','module_name' => 'CMS Admin'],
            ['code' => 'ADMIN_LOGIN_SUCCESS','description' => 'Admin - Login Success','module_name' => 'CMS Admin'],
            ['code' => 'ADMIN_LOGOUT','description' => 'Admin - Logout','module_name' => 'CMS Admin'],
            //-------------End of CMS Dashboard------------------//

            //-------Activity for Event Durham - Admin -----------//
            ['code' => 'ED_EVENTLISTING','description' => 'Event Durham - Event List Viewed','module_name' => 'Event Durham - Admin'],
            ['code' => 'ED_CREATE_EVENT_FAILURE','description' => 'Event Durham - Create New Event - Failure','module_name' => 'Event Durham - Admin'],
            ['code' => 'ED_CREATE_EVENT_SUCCESS','description' => 'Event Durham - Create New Event - Success','module_name' => 'Event Durham - Admin'],
            //-------------End of Event Durham - Admin ------------------//


            //-------Activity for ED Event  -----------//
            ['code' => 'ED_EVENTS_EDIT_FAILURE','description' => 'Events - Edit Event - Failure','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_EDIT_SUCCESS','description' => 'Events - Edit Event - Success','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_COPY_FAILURE','description' => 'Events - Copy Event - Failure','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_COPY_SUCCESS','description' => 'Events - Copy Event - Success','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_PUBLISH_FAILURE','description' => 'Events - Publish Event - Failure','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_PUBLISH_SUCCESS','description' => 'Events - Publish Event - Success','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_SUSPEND_FAILURE','description' => 'Events - Suspend Event - Failure','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_SUSPEND_SUCCESS','description' => 'Events - Suspend Event - Success','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_ARCHIVE_FAILURE','description' => 'Events -  Archive Event - Failure','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_ARCHIVE_SUCCESS','description' => 'Events - Archive Event - Success','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_DELETE_FAILURE','description' => 'Events - Delete Event - Failure','module_name' => 'ED Events'],
            ['code' => 'ED_EVENTS_DELETE_SUCCESS','description' => 'Events - Delete Event - Success','module_name' => 'ED Events'],
            //-------------End of ED Event  ------------------//

            //-------Activity for ED Packages  -----------//
            ['code' => 'ED_PACKAGE_LISTING','description' => 'Package -  Listing of Packages','module_name' => 'ED - Package'],
            ['code' => 'ED_SKIP_PACKAGE_SUCCESS','description' => 'Package - Skip Package','module_name' => 'ED - Package'],
            ['code' => 'ED_CREATE_PACKAGE_FAILURE','description' => 'Package - Create New Package - Failure','module_name' => 'ED - Package'],
            ['code' => 'ED_CREATE_PACKAGE_SUCCUSS','description' => 'Package - Create New Package - Success','module_name' => 'ED - Package'],
            ['code' => 'ED_UPDATE_PACKAGE_FAILURE','description' => 'Package - Update Existing Package - Failure','module_name' => 'ED - Package'],
            ['code' => 'ED_UPDATE_PACKAGE_SUCCUSS','description' => 'Package - Update Existing Package - Success','module_name' => 'ED - Package'],
            ['code' => 'ED_DELETE_PACKAGE_SUCCUSS','description' => 'Package - Delete Existing Package - Success','module_name' => 'ED - Package'],
            //-------------End of ED Packages  ------------------//

            //-------Activity for ED Catering ------------//
            ['code' => 'ED_CATERING_LISTING','description' => 'Catering - Listing All Caterings','module_name' => 'ED - Catering'],
            ['code' => 'ED_SKIP_CATERING_SUCCESS','description' => 'Catering - Skip Catering','module_name' => 'ED - Catering'],
            ['code' => 'ED_CREATE_CATERING_FAILURE','description' => 'Catering - Create New Catering - Failure','module_name' => 'ED - Catering'],
            ['code' => 'ED_CREATE_CATERING_SUCCESS','description' => 'Catering - Create New Catering - Success','module_name' => 'ED - Catering'],
            ['code' => 'ED_UPDATE_CATERING_FAILURE','description' => 'Catering - Update Existing Catering - Failure','module_name' => 'ED - Catering'],
            ['code' => 'ED_UPDATE_CATERING_SUCCUSS','description' => 'Catering - Update Existing Catering - Success','module_name' => 'ED - Catering'],
            ['code' => 'ED_DELETE_CATERING_SUCCUSS','description' => 'Catering - Delete Existing Catering - Success','module_name' => 'ED - Catering'],
            //-------------End of ED Catering -------------------//

            //-------Activity for ED Accommodation ------------//
            ['code' => 'ED_ACCOMMODATION_LISTING','description' => 'Accommodation - Listing All Accommodation','module_name' => 'ED - Accommodation'],
            ['code' => 'ED_SKIP_ACCOMMODATION_SUCCESS','description' => 'Accommodation - Skip Accommodation ','module_name' => 'ED - Accommodation'],
            ['code' => 'ED_CREATE_ACCOMMODATION_FAILURE','description' => 'Accommodation - Create New Accommodation - Failure','module_name' => 'ED - Accommodation'],
            ['code' => 'ED_CREATE_ACCOMMODATION_SUCCESS','description' => 'Accommodation - Create New Accommodation - Success','module_name' => 'ED - Accommodation'],
            ['code' => 'ED_DELETE_ACCOMMODATION_SUCCESS','description' => 'Accommodation - Delete Existing Accommodation - Delete','module_name' => 'ED - Accommodation'],
            ['code' => 'ED_UPDATE_ACCOMMODATION_FAILURE','description' => 'Accommodation - Update Existing Accommodation - Failure','module_name' => 'ED - Accommodation'],
            ['code' => 'ED_UPDATE_ACCOMMODATION_SUCCUSS','description' => 'Accommodation - Update Existing Accommodation - Success','module_name' => 'ED - Accommodation'],
            //-------------End of ED Accommodation -------------------//

            //-------Activity for ED - Extras -----------//
            ['code' => 'ED_EXTRAS_LISTING','description' => 'Extras - Listing All Extras','module_name' => 'ED - Extras'],
            ['code' => 'ED_SKIP_EXTRAS_SUCCESS','description' => 'Extras - Skip Extras ','module_name' => 'ED - Extras'],
            ['code' => 'ED_CREATE_EXTRAS_FAILURE','description' => 'Extras - Create New Extras - Failure','module_name' => 'ED - Extras'],
            ['code' => 'ED_CREATE_EXTRAS_SUCCESS','description' => 'Extras - Create New Extras - Success','module_name' => 'ED - Extras'],
            ['code' => 'ED_UPDATE_EXTRAS_FAILURE','description' => 'Extras - Update Existing Extras - Failure','module_name' => 'ED - Extras'],
            ['code' => 'ED_UPDATE_EXTRAS_SUCCUSS','description' => 'Extras - Update Existing Extras - Success','module_name' => 'ED - Extras'],
            ['code' => 'ED_DELETE_EXTRAS_SUCCUSS','description' => 'Extras - Delete Existing Extras - Success','module_name' => 'ED - Extras'],
            //-------------End of ED - Extras ------------------//

            //-------Activity for ED Talks ------------//
            ['code' => 'ED_TALKS_CHANNEL_LISTING','description' => 'Talks - Listing All Channels','module_name' => 'ED - Talks'],
            ['code' => 'ED_SKIP_TALKS_SUCCESS','description' => 'Talks - Skip Talks','module_name' => 'ED - Talks'],
            ['code' => 'ED_CREATE_TALKS_CHANNEL_FAILURE','description' => 'Talks - Create New Channel - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_CREATE_TALKS_CHANNEL_SUCCESS','description' => 'Talks - Create New Channel - Success','module_name' => 'ED - Talks'],
            ['code' => 'ED_UPDATE_TALKS_CHANNEL_FAILURE','description' => 'Talks - Update Existing Channel - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_UPDATE_TALKS_CHANNEL_SUCCESS','description' => 'Talks - Update Existing Channel - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_DELETE_TALKS_CHANNEL_SUCCESS','description' => 'Talks - Delete Existing Channel - Success','module_name' => 'ED - Talks'],
            ['code' => 'ED_TALKS_LISTING','description' => 'Talks - Listing All Talks ','module_name' => 'ED - Talks'],
            ['code' => 'ED_CREATE_TALKS_FAILURE','description' => 'Talks - Create New Talks - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_CREATE_TALKS_SUCCESS','description' => 'Talks - Create New Talks - Success','module_name' => 'ED - Talks'],
            ['code' => 'ED_UPDATE_SESSION_FAILURE','description' => 'Talks - Update Existing Talks - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_UPDATE_TALKS_SUCCUSS','description' => 'Talks - Update Existing Talks - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_DELETE_TALKS_SUCCUSS','description' => 'Talks - Delete Existing Talks - Success','module_name' => 'ED - Talks'],
            ['code' => 'ED_SESSION_LISTING','description' => 'Talks - Listing All Sessions','module_name' => 'ED - Talks'],
            ['code' => 'ED_ADD_TALKS_SESSION_FAILURE','description' => 'Talks - Create New Session - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_ADD_TALKS_SESSION_SUCCESS','description' => 'Talks - Create New Session - Success','module_name' => 'ED - Talks'],
            ['code' => 'ED_UPDATE_TALKS_SESSION_FAILURE','description' => 'Talks - Update Existing Session - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_UPDATE_TALKS_SESSION_SUCCUSS','description' => 'Talks - Update Existing Session - Failure','module_name' => 'ED - Talks'],
            ['code' => 'ED_DELETE_TALKS_SESSION_SUCCUSS','description' => 'Talks - Delete Existing Session - Success','module_name' => 'ED - Talks'],
            //-------------End of ED Talks  -------------------//

            //-------Activity for ED Fields ------------//
            ['code' => 'ED_PRIMARY_FIELDS_LISTING','description' => 'Fields - Listing Primary Fields','module_name' => 'ED - Fields'],
            ['code' => 'ED_CUSTOM_FIELDS_LISTING','description' => 'Fields - Listing Custom Fields','module_name' => 'ED - Fields'],
            ['code' => 'ED_ADD_CUSTOM_FIELDS_FAILURE','description' => 'Fields - Add New Custom Field - Failure','module_name' => 'ED - Fields'],
            ['code' => 'ED_ADD_CUSTOM_FIELDS_SUCCESS','description' => 'Fields - Add New Custom Field - Success','module_name' => 'ED - Fields'],
            ['code' => 'ED_DELETE_CUSTOM_FIELDS_SUCCESS','description' => 'Fields - Delete Existing Custom Field - Failure','module_name' => 'ED - Fields'],
            ['code' => 'ED_SAVE_PRIMARY_FIELDS_FAILURE','description' => 'Fields - Save Primary Field - Failure','module_name' => 'ED - Fields'],
            ['code' => 'ED_SAVE_PRIMARY_FIELDS_SUCCESS','description' => 'Fields - Save Primary Field - Success','module_name' => 'ED - Fields'],
            //-------------End of ED Fields -------------------//

            //-------Activity for ED URL Master ------------//
            ['code' => 'URL_DELETE','description' => 'URL Master - URL Delete - Success','module_name' => 'URL Master - Admin'],
            ['code' => 'URL_CREATE_FAILURE','description' => 'URL Master - Create New URL - Failure - URL is not validate, URL is duplicate, URL domain failure','module_name' => 'URL Master - Admin'],
            ['code' => 'URL_CREATE_SUCCESS','description' => 'URL Master - Create New URL - Success - URL validate, URL is unique, URL domain validate','module_name' => 'URL Master - Admin'],
            ['code' => 'URL_UPDATE_FAILURE','description' => 'URL Master - Update Existing URL - Failure -  URL is not validate, URL is duplicate, URL domain failure','module_name' => 'URL Master - Admin'],
            ['code' => 'URL_UPDATE_SUCCESS','description' => 'URL Master - Update Existing URL - Success - URL validate, URL is unique, URL domain validate','module_name' => 'URL Master - Admin'],
            //-------------End of ED URL Master -------------------//

            //-------Activity for ED Group Master ------------//
            ['code' => 'GROUP_DELETE','description' => 'Group Master - Group Delete - Success','module_name' => 'Group Master - Admin'],
            ['code' => 'GROUP_CREATE_FAILURE','description' => 'Group Master - Create New Group - Failure - Group is Duplicate','module_name' => 'Group Master - Admin'],
            ['code' => 'GROUP_CREATE_SUCCESS','description' => 'Group Master - Create New Group - Success - Group is Unique','module_name' => 'Group Master - Admin'],
            ['code' => 'GROUP_UPDATE_FAILURE','description' => 'Group Master - Update Existing Group - Failure - Group is Duplicate','module_name' => 'Group Master - Admin'],
            ['code' => 'GROUP_UPDATE_SUCCESS','description' => 'Group Master - Update Existing Group - Success - Group is Unique','module_name' => 'Group Master - Admin'],
            //-------------End of ED Group Master -------------------//

            //-------Activity for ED Catering Master ------------//
            ['code' => 'CATERING_DELETE','description' => 'Catering Master - Catering Delete - Success','module_name' => 'Catering Master - Admin'],
            ['code' => 'CATERING_CREATE_FAILURE','description' => 'Catering Master - Create New Catering - Failure - Catering Title is Duplicate','module_name' => 'Catering Master - Admin'],
            ['code' => 'CATERING_CREATE_SUCCESS','description' => 'Catering Master - Create New Catering - Success - Catering Title is Unique','module_name' => 'Catering Master - Admin'],
            ['code' => 'CATERING_UPDATE_FAILURE','description' => 'Catering Master - Update Existing Catering - Failure - Catering Title is Duplicate','module_name' => 'Catering Master - Admin'],
            ['code' => 'CATERING_UPDATE_SUCCESS','description' => 'Catering Master - Update Existing Catering - Success - Catering Title is Unique','module_name' => 'Catering Master - Admin'],
            //-------------End of ED Catering Master -------------------//

            //-------Activity for ED Accommodations Master - Admin ------------//
            ['code' => 'ACCOMMODATIONS_DELETE','description' => 'Accommodations Master - Accommodations Delete - Success','module_name' => 'Accommodations Master - Admin'],
            ['code' => 'ACCOMMODATIONS_CREATE_FAILURE','description' => 'Accommodations Master - Create New Accommodations - Failure - Accommodations Title is Duplicate','module_name' => 'Accommodations Master - Admin'],
            ['code' => 'ACCOMMODATIONS_CREATE_SUCCESS','description' => 'Accommodations Master - Create New Accommodations - Success - Accommodations Title is Unique','module_name' => 'Accommodations Master - Admin'],
            ['code' => 'ACCOMMODATIONS_UPDATE_FAILURE','description' => 'Accommodations Master - Update Existing Accommodations - Failure - Accommodations Title is Duplicate','module_name' => 'Accommodations Master - Admin'],
            ['code' => 'ACCOMMODATIONS_UPDATE_SUCCESS','description' => 'Accommodations Master - Update Existing Accommodations - Success - Accommodations Title is Unique','module_name' => 'Accommodations Master - Admin'],

            //-------------End of ED Accommodations Master - Admin -------------------//

            //-------Activity for ED Extras Master - Admin ------------//
            ['code' => 'EXTRAS_DELETE','description' => 'Extras Master - Extra Delete - Success','module_name' => 'Extras Master - Admin'],
            ['code' => 'EXTRAS_CREATE_FAILURE','description' => 'Extras Master - Create New Extras - Failure - Extras Title is Duplicate','module_name' => 'Extras Master - Admin'],
            ['code' => 'EXTRAS_CREATE_SUCCUSS','description' => 'Extras Master - Create New Extras - Success - Extras Title is Unique','module_name' => 'Extras Master - Admin'],
            ['code' => 'EXTRAS_UPDATE_FAILURE','description' => 'Extras Master - Update Existing Extras - Failure - Extras Title is Duplicate','module_name' => 'Extras Master - Admin'],
            ['code' => 'EXTRAS_UPDATE_SUCCESS','description' => 'Extras Master - Update Existing Extras - Success - Extras Title is Unique','module_name' => 'Extras Master - Admin'],

            //-------------End of ED Extras Master - Admin -------------------//

            //-------Activity for Booking Flow ------------//
            ['code' => 'ED_BOOKING_DELEGATE_FAILURE','description' => 'Booking - Delegate Failure - Student ID is invalid, Contact Number is invalid, Email is invalid','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_DELEGATE_SUCCESS','description' => 'Booking - Delegate Success - Delegate Details are Valid','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_PACKAGE_SELECT','description' => 'Booking - Package Selection - Packgae available for Booking','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_CATERING_SELECT','description' => 'Booking - Catering Selection -  Catering Group available for Booking','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_ACCOMMODATION_SELECT','description' => 'Booking - Accommodation Selection - Accommodation Group available for Booking','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_EXTRA_SELECT','description' => 'Booking - Extra Selection - Extra Activity / Requirement available for Booking','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_TALK_SELECT','description' => 'Booking - Talk Selection - Discussion Topics available for Booking','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_OTHER_INFORMATION','description' => 'Booking - Other Information Entry - Special requirement Request','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_DELIGATE_DETAIL_CONFIRMATION','description' => 'Booking - Confirm Deligate Details - Review Delegate Details - success','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_BOOKING_DETAIL_CONFIRMATION','description' => 'Booking - Confirm Booking Details - Confirmation of Booking - Success','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_PAYMENT_MODE_SELECT_ONLINE','description' => 'Booking - Choose Payment Mode and Go To Payment Gateway - Online','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_PAYMENT_MODE_SELECT','description' => 'Booking - Choose Payment Mode and Fill Details - Other ','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_ORDER_FAILURE','description' => 'Booking - Order Failure - Payment does not Fullfilled','module_name' => 'ED Booking Flow'],
            ['code' => 'ED_BOOKING_ORDER_SUCCESS','description' => 'Booking - Order Confirmation -  Payment Fullfilled and Details validation - success','module_name' => 'ED Booking Flow'],
            //-------------End of Booking Flow -------------------//

            //-------Activity for Study Tour ------------//
            ['code' => 'BSST_LOGIN_FAILURE','description' => 'Business School Study Tour - Login Failure','module_name' => 'Business School Study Tours'],
            ['code' => 'BSST_LOGIN_SUCCESS','description' => 'Business School Study Tour - Login Success','module_name' => 'Business School Study Tours'],
            ['code' => 'BSST_CONFIRM_DETAILS','description' => 'Business School Study Tour - Confirm Details','module_name' => 'Business School Study Tours'],
            ['code' => 'BSST_SELECT_STUDY_TOUR','description' => 'Business School Study Tour - Study Tour  selection','module_name' => 'Business School Study Tours'],
            ['code' => 'BSST_PAYMENT_INIT','description' => 'Business School Study Tour - Continue to payment','module_name' => 'Business School Study Tours'],
            ['code' => 'BSST_PAYMENT_SUCCESS','description' => 'Business School Study Tour - Payment Confirmation - Success','module_name' => 'Business School Study Tours'],
            ['code' => 'BSST_PAYMENT_FAILURE','description' => 'Business School Study Tour - Payment Confirmation - Failure','module_name' => 'Business School Study Tours'],
            ['code' => 'BSST_LOGOUT','description' => 'Business School Study Tour - Log out','module_name' => 'Business School Study Tours'],
            //-------------End of Study Tour -------------------//

            //-------Activity for Library Payments ------------//
            ['code' => 'LP_LOGIN_FAILURE','description' => 'Library Payments - Login Failure','module_name' => 'Library Payments'],
            ['code' => 'LP_LOGIN_SUCCESS','description' => 'Library Payments - Login Success','module_name' => 'Library Payments'],
            ['code' => 'LP_CONFIRM_DETAILS','description' => 'Library Payments - Confirm Details','module_name' => 'Library Payments'],
            ['code' => 'LP_SELECT_PAYMENTS','description' => 'Library Payments - Payments  selection','module_name' => 'Library Payments'],
            ['code' => 'LP_PAYMENT_INIT','description' => 'Library Payments - Continue to payment','module_name' => 'Library Payments'],
            ['code' => 'LP_PAYMENT_SUCCESS','description' => 'Library Payments - Payment Confirmation - Success','module_name' => 'Library Payments'],
            ['code' => 'LP_PAYMENT_FAILURE','description' => 'Library Payments - Payment Confirmation - Failure','module_name' => 'Library Payments'],
            ['code' => 'LP_LOGOUT','description' => 'Library Payments - Log out','module_name' => 'Library Payments'],
            //-------------End of Library Payments -------------------//

        ];

        foreach($activities as $data)
        {
            Activity::create([
               'code' => $data['code'],
               'description' => $data['description'],
               'module_name' =>$data['module_name']
            ]);
        }
    }
}
